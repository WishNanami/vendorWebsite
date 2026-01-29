<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "database.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

$message = "";
?>

<h2>Forgot Password</h2>

<form method="post">
    Enter your username:<br>
    <input type="text" name="username" required><br><br>
    <button type="submit" name="reset">Send Reset Link</button>
</form>

<?php
if (isset($_POST['reset'])) {

    $username = trim($_POST['username']);

    $stmt = $conn->prepare(
        "SELECT email FROM vendoraccount WHERE accountID = ?"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();
        $email = $user['email'];

        // Generate token
        $token  = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $update = $conn->prepare(
            "UPDATE vendoraccount
            SET reset_token = ?, reset_expiry = ?
            WHERE accountID = ?"
        );

        if (!$update) {
            die("Prepare failed: " . $conn->error);
        }

        $update->bind_param("sss", $token, $expiry, $username);
        $update->execute();

        if ($update->affected_rows !== 1) {
            die("Update failed: username not found or no row updated");
        }
        echo "DEBUG TOKEN: $token<br>";

        // Check what MySQL thinks NOW() is
        $result = $conn->query("SELECT NOW() as now_time");
        $row = $result->fetch_assoc();
        echo "DEBUG NOW(): " . $row['now_time'] . "<br>";

        // Check token row in database
        $stmt_check = $conn->prepare("SELECT accountID, reset_expiry FROM vendoraccount WHERE reset_token=?");
        $stmt_check->bind_param("s", $token);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        echo "DEBUG DB reset_expiry: " . $row_check['reset_expiry'] . "<br>";

        // exit;


        $resetLink = "http://localhost/vendor_information/reset_password.php?token=$token";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'youremail@gmail.com';// your email
            $mail->Password   = 'App password'; // app password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('youremail@gmail.com', 'Vendor System');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body = "
                Hello <b>$username</b>,<br><br>
                Click the link below to reset your password:<br>
                <a href='$resetLink'>$resetLink</a><br><br>
                This link expires in 1 hour.
            ";

            $mail->send();
            $message = "Reset link has been sent to your email.";

        } catch (Exception $e) {
            $message = "Email failed: {$mail->ErrorInfo}";
        }

    } else {
        $message = "Username not found.";
    }
}
?>

<p><?php echo $message; ?></p>
