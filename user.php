<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'vendor') {
    header("Location: index.php");
    exit();
}
?>

<h1>User Page</h1>
<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
<a href="logout.php">Logout</a>
