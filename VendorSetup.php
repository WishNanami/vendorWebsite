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
$tokenValid = false;
$setupToken = "";

// Check if token exists in URL
if (isset($_GET['token'])) {
    $setupToken = trim($_GET['token']);
    
    // Validate token against database
    $stmt = $conn->prepare(
        "SELECT accountID, email FROM vendoraccount 
         WHERE reset_token = ? AND reset_expiry > NOW() AND accountID LIKE 'PENDING_%'"
    );
    $stmt->bind_param("s", $setupToken);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $tokenValid = true;
    } else {
        $message = "Invalid or expired setup link. Please request a new account invitation.";
        $messageType = "error";
    }
}

// Get role and vendor type from token
$userRole = '';
$userVendorType = '';
if ($tokenValid) {
    $stmt = $conn->prepare(
        "SELECT role, vendor_type FROM vendoraccount 
         WHERE reset_token = ? AND reset_expiry > NOW()"
    );
    $stmt->bind_param("s", $setupToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $userRole = $row['role'];
    $userVendorType = $row['vendor_type'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && $tokenValid) {
    $accountID = trim($_POST['accountID']);
    $password  = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Get the email from the valid token
    $stmt = $conn->prepare(
        "SELECT email FROM vendoraccount 
         WHERE reset_token = ? AND reset_expiry > NOW()"
    );
    $stmt->bind_param("s", $setupToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $email = $row['email'];
    
    // Validation
    if (empty($accountID) || empty($password) || empty($confirmPassword)) {
        $message = "All fields are required.";
        $messageType = "error";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
        $messageType = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters long.";
        $messageType = "error";
    } else {
        // Check if account ID already exists
        $checkStmt = $conn->prepare("SELECT accountID FROM vendoraccount WHERE accountID = ? AND accountID NOT LIKE 'PENDING_%'");
        $checkStmt->bind_param("s", $accountID);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        
        if ($checkResult->num_rows > 0) {
            $message = "Account ID already exists. Please choose a different one.";
            $messageType = "error";
        } else {
            // Hash password and update account
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $updateStmt = $conn->prepare(
                "UPDATE vendoraccount 
                 SET accountID = ?, password = ?, reset_token = NULL, reset_expiry = NULL
                 WHERE email = ? AND reset_token = ?"
            );
            $updateStmt->bind_param("ssss", $accountID, $hashedPassword, $email, $setupToken);
            
            if ($updateStmt->execute()) {
                $message = "Account setup completed successfully! You can now login with your account ID and password.";
                $messageType = "success";
                $tokenValid = false; // Hide form after successful setup
            } else {
                $message = "Error setting up account. Please try again.";
                $messageType = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Account Setup</title>
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
            width: 450px;
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
            box-sizing: border-box;
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
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            color: green;
            background: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .error {
            color: red;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
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
    <h2>Vendor Account Setup</h2>
    
    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if ($tokenValid): ?>
        <p>Complete your account setup below.</p>

        <form method="post">
            <input type="text" name="accountID" placeholder="Account ID (Username)" required>
            
            <input type="password" name="password" placeholder="Password (min 6 characters)" required>
            
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
            
            <button type="submit">Complete Setup</button>
        </form>
    <?php else: ?>
        <p>Please use the setup link sent to your email to create your account.</p>
        
        <div class="links">
            <a href="index.php">← Back to Login</a>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
