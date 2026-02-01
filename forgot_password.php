<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "database.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

$message = "";
$messageType = ""; // success | error
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>

<style>
    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background: #fff;
        width: 380px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        text-align: center;
    }

    .card h2 {
        margin-bottom: 10px;
        color: #333;
    }

    .card p {
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .card input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .card button {
        width: 100%;
        padding: 12px;
        background: #2a5298;
        border: none;
        color: white;
        font-size: 15px;
        border-radius: 6px;
        cursor: pointer;
    }

    .card button:hover {
        background: #1e3c72;
    }

    .message {
        margin-bottom: 15px;
        font-size: 14px;
    }

    .success {
        color: green;
    }

    .error {
        color: red;
    }

    .links {
        margin-top: 20px;
        font-size: 13px;
    }

    .links a {
        color: #2a5298;
        text-decoration: none;
    }

    .links a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>

<div class="card">
    <h2>Forgot Password</h2>
    <p>Enter your email and company registration number to receive a password reset link.</p>

    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="number" name="newCompanyRegistration" placeholder="Company Registration Number" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <button type="submit" name="reset">Send Reset Link</button>
    </form>

    <div class="links">
        <a href="index.php">← Back to Login</a>
    </div>
</div>

</body>
</html>

<?php
if (isset($_POST['reset'])) {

    $newCompanyRegistration = trim($_POST['newCompanyRegistration']);
    $email = trim($_POST['email']);
    
    // Validate all fields are not empty
    if (empty($newCompanyRegistration) || empty($email)) {
        $message = "Please fill in all fields.";
        $messageType = "error";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        $message = "Please enter a valid email address.";
        $messageType = "error";
    } else {
        // Validate that company registration and email match in registrationform
        $stmt = $conn->prepare(
            "SELECT rf.NewCompanyRegistration, va.accountID FROM registrationform rf 
             INNER JOIN vendoraccount va ON rf.NewCompanyRegistration = va.accountID 
             WHERE rf.NewCompanyRegistration = ? AND rf.email = ?"
        );
        $stmt->bind_param("is", $newCompanyRegistration, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $accountID = $row['accountID'];
            
            // Generate reset token
            $token  = bin2hex(random_bytes(32));
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Update vendoraccount with reset token and expiry
            $update = $conn->prepare(
                "UPDATE vendoraccount
                 SET reset_token = ?, reset_expiry = ?
                 WHERE accountID = ?"
            );
            $update->bind_param("sss", $token, $expiry, $accountID);
            $update->execute();

            // Create reset link with token
            $resetLink = "http://localhost/Vendor_Website/reset_password.php?token=" . urlencode($token);

            // Send email via PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = '3superdreams@gmail.com';
                $mail->Password   = 'czlz zywn klxn wguw';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('3superdreams@gmail.com', 'Vendor System');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "
                    Hello <b>" . htmlspecialchars($accountID) . "</b>,<br><br>
                    We received a request to reset your password.<br><br>
                    <a href='" . htmlspecialchars($resetLink) . "'>Click here to reset your password</a><br><br>
                    This link will expire in 1 hour.<br><br>
                    If you did not request this, please ignore this email.
                ";

                $mail->send();

                $message = "Reset link has been sent to your email.";
                $messageType = "success";

            } catch (Exception $e) {
                $message = "Failed to send email. Please try again.";
                $messageType = "error";
            }
        } else {
            $message = "Invalid company registration number or email. Please check your details and try again.";
            $messageType = "error";
        }
    }
}
?>
