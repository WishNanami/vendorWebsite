<?php
session_start();
include "database.php";

// Protect page (admin only)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accountID = trim($_POST['accountID']);
    $password  = $_POST['password'];
    $role      = $_POST['role'];

    // Allow only valid roles
    $allowedRoles = ['admin', 'vendor'];

    if (empty($accountID) || empty($password) || empty($role)) {
        $message = "All fields are required.";
    } elseif (!in_array($role, $allowedRoles)) {
        $message = "Invalid role selected.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO vendoraccount (accountID, password, role) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $accountID, $hashedPassword, $role);

        if ($stmt->execute()) {
            $message = ucfirst($role) . " account created successfully!";
        } else {
            $message = "Error: Account ID may already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <style>
        form {
            max-width: 400px;
            background: #f5f5f5;
            padding: 20px;
            margin: 40px auto;
            border-radius: 8px;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .msg {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Create Account</h2>

<form method="post">
    <label>Account ID</label>
    <input type="text" name="accountID" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
        <option value="">-- Select Role --</option>
        <option value="vendor">Vendor</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Create Account</button>

    <p class="msg"><?php echo $message; ?></p>
</form>

<p style="text-align:center;">
    <a href="admin.php">← Back to Admin Panel</a>
</p>

</body>
</html>
