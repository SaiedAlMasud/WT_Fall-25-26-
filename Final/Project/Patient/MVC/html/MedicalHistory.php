<?php
//database connection
require '../db/db_connect.php';
require '../php/medicalHistoryGetData.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Medical History</title>
    <link rel="stylesheet" href="../css/MedicalHistoryStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
    </style>
</head>
<body>
    <nav id="navbar">
        <ul>
        <li><a href="HomePage.php">Home</a></li>
        <li><a href="BookAppointment.php">Book Appointment</a></li>
        <li><a class="active" href="MedicalHistory.php">Medical History</a></li>
        <li><a href="Profile.php"><?php echo $_SESSION['username'] ?></a></li>
        <li><a href="../php/Logout.php">Logout</a></li>
    </ul>

    <div class="hamburger-menu" id="hamburgerMenu" onclick="toggleDropdown()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dropdown-Content"  id="dropdownMenu">
        
            <a href="HomePage.php">Home</a>
            <a href="Profile.php">Profile</a>
            <a href="BookAppointment.php">Book Appointment</a>
            <a class="active" href="MedicalHistory.php">Medical History</a>
            <a href="#">Logout</a>
        
    </div>
    </nav>
    <!--main heading-->
    <div>
        <h2 class="main-heading">
            Medical History
        </h2>
    </div>
    <!--medical history details-->
    <div class="history-details">
        <?php if(empty($medical_historys)): ?>
            <div class="no-history">
                <h1>No medical history found at this moment.</h1>
            </div>
        <!--Available medical history details -->
        <?php else: ?>
        
        <table>
            <tr>
                <th>Date</th>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Prescriptions</th>
            </tr>
        <?php foreach ($medical_historys as $history): ?>
            <tr>
                <td><?php echo $history['appointment_date'] ?></td>
                <td><?php echo $history['doctor_name'] ?></td>
                <td><?php echo $history['diagnosis'] ?></td>
                <td><?php echo $history['prescriptions'] ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </table>
        
    </div>

<!-- hamburger menu js code -->
    <script src="../js/hamburgerMenu.js"> </script>

</body>
</html>