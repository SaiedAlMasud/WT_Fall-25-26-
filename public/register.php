<?php
require_once __DIR__ . '/../app/Config/db.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

$authController = new AuthController($conn);
$result  = $authController->register();
$success  = $result['success'];
$errormsg = $result['errormsg'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="assets/css/RegisterPageStyle.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" name="name" placeholder="Name" id="name">
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" id="email">
            </div>
            <div class="input-box">
                <input type="date" name="dob" id="dob">
            </div>
            <div class="input-box">
                <input type="text" name="bloodgroup" id="bloodgroup" placeholder="Blood Group">
            </div>
            <div class="input-box">
                <input type="number" name="weight" id="weight" placeholder="Weight (in kg)">
            </div>
            <div class="input-box">
                <input type="text" name="address" id="address" placeholder="Address">
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" id="password">
            </div>
            <div class="gender">
                <p style="font-size: 16px;">Select Gender :</p>
                <input type="radio" name="gender" id="male" value="male"><label>Male</label>
                <input type="radio" name="gender" id="female" value="female"><label>Female</label>
            </div>
            <div class="reg-as">
                <p style="font-size: 16px;">Register As :</p>
                <input type="radio" name="user" id="patient" value="patient"><label>Patient</label>
                <input type="radio" name="user" id="doctor" value="doctor"><label>Doctor</label>
            </div>
            <div class="input-box-photo">
                <input type="file" name="profile_image" id="photo">
            </div><br>
            <div class="terms-conditions">
                <label><input type="checkbox" name="terms" id="terms">I accept the terms and conditions</label>
            </div>
            <?php
                if (!empty($errormsg)) { echo '<div class="error-msg">' . $errormsg . '</div>'; }
                if (!empty($success))  { echo '<div class="success-msg">' . $success . '</div>'; }
            ?><br>
            <button type="submit" class="btn">Register</button>
            <div id="loginButtonContainer"></div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var success = document.querySelector('.success-msg');
            var loginButtonContainer = document.getElementById('loginButtonContainer');

            var loginbtn = document.createElement('a');
            loginbtn.href = "index.php";
            loginbtn.textContent = "Login";
            loginbtn.className = "btn";
            loginbtn.style.display = "block";
            loginbtn.style.textAlign = "center";
            loginbtn.style.marginTop = "10px";
            loginbtn.style.textDecoration = "none";

            if (success) {
                loginButtonContainer.appendChild(loginbtn);
            }
        });
    </script>
</body>
</html>
