<?php
session_start();
include "database.php";

$error = "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="post">
    Username:<br>
    <input type="text" name="username" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
    <br>
    <a href="forgot_password.php">Forgot Password?</a>
</form>

<?php
if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare query (username only)
    $stmt = $conn->prepare(
        "SELECT accountID, password, role FROM vendoraccount WHERE accountID = ?"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {

            // Store session data
            $_SESSION['username'] = $row['accountID'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($row['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: registration.php");
            }
            exit();

        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

</body>
</html>
