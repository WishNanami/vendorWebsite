<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include "database.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

// Protect page (admin only)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$message = "";
$messageType = ""; // success | error

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $vendorType = trim($_POST['vendor_type']);

    // Allowed roles and vendor types
    $allowedRoles = ['admin', 'vendor'];
    $allowedVendorTypes = ['Civil Contractor', 'Supplier', 'TMP Contractor', 'General Contractor'];

    if (empty($email)) {
        $message = "Email is required.";
        $messageType = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $messageType = "error";
    } elseif (empty($role) || !in_array($role, $allowedRoles)) {
        $message = "Please select a valid role.";
        $messageType = "error";
    } elseif ($role === 'vendor' && (empty($vendorType) || !in_array($vendorType, $allowedVendorTypes))) {
        $message = "Please select a valid vendor type.";
        $messageType = "error";
    } else {
        // Check if email already exists
        $checkStmt = $conn->prepare("SELECT accountID FROM vendoraccount WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $message = "This email is already registered.";
            $messageType = "error";
        } else {
            // Generate setup token
            $setupToken = bin2hex(random_bytes(32));
            $tokenExpiry = date("Y-m-d H:i:s", strtotime("+24 hours"));
            
            // Create temporary account with setup token
            $tempAccountID = "PENDING_" . bin2hex(random_bytes(4));
            
            // For admin accounts, vendor_type is NULL; for vendors, store the type
            $storeVendorType = ($role === 'vendor') ? $vendorType : NULL;
            
            $stmt = $conn->prepare(
                "INSERT INTO vendoraccount (accountID, email, role, vendor_type, reset_token, reset_expiry) VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("ssssss", $tempAccountID, $email, $role, $storeVendorType, $setupToken, $tokenExpiry);

            if ($stmt->execute()) {
                // Send setup email
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
                    $mail->Subject = 'Complete Your Account Setup';
                    
                    $setupLink = "http://localhost/vendorWebsite/VendorSetup.php?token=" . urlencode($setupToken);
                    
                    $mail->Body = "
                        <h2>Welcome to the Vendor System</h2><br><br>
                        You have been invited to create an account.<br><br>
                        Please click the link below to set up your account:<br>
                        <a href='" . htmlspecialchars($setupLink) . "'>Complete Your Account Setup</a><br><br>
                        This link will expire in 24 hours.<br><br>
                        If you did not request this, please ignore this email.<br><br>
                        Regards,<br>
                        Vendor System Team
                    ";

                    $mail->send();

                    $message = "Setup link has been sent to " . htmlspecialchars($email) . ". Please check your email to complete account setup.";
                    $messageType = "success";
                } catch (Exception $e) {
                    // Account was created but email failed
                    $message = "Account invitation created but failed to send email. Error: " . $mail->ErrorInfo;
                    $messageType = "error";
                }
            } else {
                $message = "Error creating account invitation. Please try again.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        :root {
            --primary-color: #059669;
            --primary-hover: #047857;
            --bg-gradient: linear-gradient(135deg, #064e3b, #065f46);
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

        .create-card {
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .create-card h2 {
            margin: 0 0 10px;
            font-size: 24px;
            color: var(--text-main);
        }

        .create-card p {
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

        input, select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
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

        .message {
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid;
        }

        .success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
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

        #vendorTypeDiv {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<script>
function toggleVendorType() {
    const roleSelect = document.getElementById('roleSelect');
    const vendorTypeDiv = document.getElementById('vendorTypeDiv');
    const vendorTypeSelect = document.getElementById('vendorTypeSelect');
    
    if (roleSelect.value === 'vendor') {
        vendorTypeDiv.style.display = 'block';
        vendorTypeSelect.required = true;
    } else {
        vendorTypeDiv.style.display = 'none';
        vendorTypeSelect.required = false;
        vendorTypeSelect.value = '';
    }
}

// Run toggle function when page loads to check for cached form values
window.addEventListener('load', function() {
    toggleVendorType();
});
</script>

<div class="create-card">
    <h2>Create Account</h2>
    <p>Set up a new vendor or admin account</p>

    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="post" id="createAccountForm">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter email address" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" id="roleSelect" required onchange="toggleVendorType()">
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="vendor">Vendor</option>
            </select>
        </div>

        <div id="vendorTypeDiv" style="display:none;">
            <div class="form-group">
                <label>Vendor Type</label>
                <select name="vendor_type" id="vendorTypeSelect">
                    <option value="">-- Select Vendor Type --</option>
                    <option value="Civil Contractor">Civil Contractor</option>
                    <option value="Supplier">Supplier</option>
                    <option value="TMP Contractor">TMP Contractor</option>
                    <option value="General Contractor">General Contractor</option>
                </select>
            </div>
        </div>

        <button type="submit">Send Setup Link</button>
    </form>

    <div class="links">
        <a href="admin.php">← Back to Admin Panel</a>
    </div>
</div>

</body>
</html>
