<?php
session_start();
if (!isset($_SESSION['accountID'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['accountID']; ?> 🎉</h1>
    <p>You are logged in successfully.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
