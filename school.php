<!DOCTYPE html>
<html>
<head>
    
</head>
<body style="background: tomato;">
    <h1>Registration Form</h1>
    <form action="testing.php" method="post">
    <div style="display: grid; grid-template-columns: 1fr 1fr;">
        <label for="TpNumber" style="text-align:center">Tp Number</label>
        <input type="text" id="TpNumber" name="TpNumber" placeholder="tpxxxxx">
    </div>
    <div style="display: grid; grid-template-columns: 1fr 1fr;">
        <label for="email" style="text-align:center">email</label>
        <input type="text" id="email" name="email">
    </div>
    <div style="display: grid; grid-template-columns: 1fr 1fr;">
        <label for="Tel" style="text-align:center">Tel</label>
        <input type="text" id="Tel" name="TpNumber">
    </div>
    <div style="display: grid; grid-template-columns: 1fr 1fr;">
        <label for="gender" style="text-align:center">Gender</label>
        <div>
            <div>
            <input type="radio" name="gender" id="Male" value="Male">
            <label for="Male">Male</label>
            </div>
            <div>
            <input type="radio" name="gender" id="Female" value="Female">
            <label for="Female">Female</label>
            </div>
        </div>
    </div>
        
    <div>
        <label for="Country">Country</label>
        <select>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            <option>Malaysia</option>
            z<option>Malaysia</option>
        </select>
    </div>
        
    <div>
        <button type="submit">Submit</button>
    </div>
    </form>
</body>
<!--    muted playsinline-->
</html>