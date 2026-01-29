<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor Information</title>
    <link rel="stylesheet" href="VendorUpdateStyle.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Update Vendor information</h2>
                <p>pick a date</p>
            </div>
            
            <form action="VendorUpdatePage.php" method="post">
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="NewRegistration" name="NewRegistration">
                        <label for="NewRegistration">Company Registration NO. (new)</label>
                        <span class="focus-border"></span>
                    </div>
                    <button type="button" class="login-btn btn" onclick="SearchRegistration()">
                        <span class="btn-text">Confirm</span>
                        <span class="btn-loader"></span>
                    </button>
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <select id="AvailableTimes" name="AvailableTimes">
                            <option value="">-- please enter your Company Registration --</option>
                        </select>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <button type="submit" class="login-btn btn">
                    <span class="btn-text">Search</span>
                    <span class="btn-loader"></span>
                </button>
            </form>
        </div>
    </div>

    <script src="../../shared/js/form-utils.js"></script>
    <script src="VendorUpdateScript.js"></script>
</body>
</html>