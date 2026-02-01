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
            box-sizing: border-box;
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

<h2 style="text-align:center;">Create Account</h2>

<form method="post" id="createAccountForm">
    <label>Email Address</label>
    <input type="email" name="email" required>

    <label>Role</label>
    <select name="role" id="roleSelect" required onchange="toggleVendorType()">
        <option value="">-- Select Role --</option>
        <option value="admin">Admin</option>
        <option value="vendor">Vendor</option>
    </select>

    <div id="vendorTypeDiv" style="display:none;">
        <label>Vendor Type</label>
        <select name="vendor_type" id="vendorTypeSelect">
            <option value="">-- Select Vendor Type --</option>
            <option value="Civil Contractor">Civil Contractor</option>
            <option value="Supplier">Supplier</option>
            <option value="TMP Contractor">TMP Contractor</option>
            <option value="General Contractor">General Contractor</option>
        </select>
    </div>

    <button type="submit">Send Setup Link</button>

    <?php if ($message): ?>
        <p class="msg <?php echo $messageType; ?>"><?php echo $message; ?></p>
    <?php endif; ?>
</form>

<p style="text-align:center;">
    <a href="admin.php">← Back to Admin Panel</a>
</p>

</body>
</html>
