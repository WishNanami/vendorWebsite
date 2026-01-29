<?php
include "database.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

$token = $_POST['token'] ?? $_GET['token'] ?? "";
$message = "";

if (!$token) {
    die("Invalid reset link.");
}

// DEBUG
echo "DEBUG TOKEN: $token<br>";
$result = $conn->query("SELECT NOW() as now_time");
$row = $result->fetch_assoc();
echo "DEBUG NOW(): " . $row['now_time'] . "<br>";

if (isset($_POST['update'])) {
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "SELECT accountID, reset_expiry FROM vendoraccount
         WHERE reset_token = ? AND reset_expiry > NOW()"
    );
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        echo "DEBUG DB reset_expiry: " . $row['reset_expiry'] . "<br>";

        $update = $conn->prepare(
            "UPDATE vendoraccount
             SET password=?, reset_token=NULL, reset_expiry=NULL
             WHERE accountID=?"
        );
        $update->bind_param("ss", $newPassword, $row['accountID']);
        $update->execute();

        $message = "Password updated successfully. <a href='login.php'>Login</a>";

    } else {
        $message = "Invalid or expired reset link.";
    }
}
?>

<h2>Reset Password</h2>

<form method="post">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

    New Password:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="update">Update Password</button>
</form>

<p><?php echo $message; ?></p>
