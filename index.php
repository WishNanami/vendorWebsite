<?php
session_start();
include "database.php";

// 1. Logic to handle the login attempt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyID = $_POST['AccountID'] ?? '';
    $password  = $_POST['accountPassword'] ?? '';

    $stmt = $conn->prepare("SELECT accountID, password, role, email FROM vendoraccount WHERE accountID = ?");
    $stmt->bind_param("s", $companyID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Success: Secure the session and redirect
            session_regenerate_id(true);
            $_SESSION['accountID'] = $user['accountID'];
            $_SESSION['role']      = $user['role'];
            // store email and a display name for vendor pages
            $_SESSION['email']     = $user['email'] ?? '';
            $_SESSION['username']  = $user['accountID'];

            $location = ($user['role'] === 'admin') ? "admin.php" : "VendorHomepage.php";
            header("Location: $location");
            exit();
        }
    }

    // Failure: Set session error and redirect back to this page
    $_SESSION['error_msg'] = "Invalid Account ID or Password.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// 2. Capture the error message if it exists, then clear it immediately
$display_error = $_SESSION['error_msg'] ?? "";
unset($_SESSION['error_msg']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Portal | Login</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-gradient: linear-gradient(135deg, #1a387e, #183055);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-gradient);
            font-family: 'Inter', -apple-system, sans-serif;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .login-card h2 {
            margin: 0 0 10px;
            font-size: 24px;
            color: var(--text-main);
        }

        .login-card p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box; /* Fixes width issues */
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        button {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            border: none;
            color: white;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        button:hover {
            background: var(--primary-hover);
        }

        .error-box {
            background: #fef2f2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
        }

        .links {
            margin-top: 25px;
            font-size: 13px;
        }

        .links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Vendor System</h2>
    <p>Secure login for registered vendors</p>

    <?php if ($display_error): ?>
        <div class="error-box">
            <?php echo $display_error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Account ID</label>
            <input type="text" name="AccountID" placeholder="Enter Account ID" required>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="accountPassword" placeholder="Enter your password" required>
        </div>

        <button type="submit">Log In to Dashboard</button>
    </form>

    <div class="links">
        <a href="forgot_password.php">Forgot Password?</a>
    </div>
</div>

</body>
</html>