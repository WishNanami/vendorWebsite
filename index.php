<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f3f3; }
        .login-box {
            width: 300px; margin: 100px auto; padding: 20px;
            background: white; border-radius: 8px; box-shadow: 0 0 10px #ccc;
        }
        input { width: 92%; padding: 10px; margin: 5px 0; }
        button { width: 100%; padding: 10px; background: blue; color: white; border: none; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <input type="text" name="accountID" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>