<?php
//database connection
require '../db/db_connect.php';
require '../php/homepageGetData.php';


?>



<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="../css/HomeStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
    </style>
</head>
<body>
    <nav id="navbar">
        <ul>
        <li><a class="active" href="HomePage.php">Home</a></li>
        <li><a href="BookAppointment.php">Book Appointment</a></li>
        <li><a href="MedicalHistory.php">Medical History</a></li>
        <li><a href="Profile.php"><?php echo htmlspecialchars($patient_name); ?></a></li>
     <!--   <li><a href="SelectLoginType.php">Login</a></li> -->
        <li><a href="../php/Logout.php">Logout</a></li>
    </ul>

    <div class="hamburger-menu" id="hamburgerMenu" onclick="toggleDropdown()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dropdown-Content"  id="dropdownMenu">
        
            <a class="active" href="HomePage.php">Home</a>
            <a href="Profile.php">Profile</a>
            <a href="BookAppointment.php">Book Appointment</a>
            <a href="MedicalHistory.php">Medical History</a>
            <a href="../php/Logout.php">Logout</a>
        
    </div>
    </nav>

    <div class="main-container">
        <!-- Welcome message -->
        <div class="welcome-msg">
            <h1>Welcome, <?php echo $patient_name; ?>!</h1>
            <p>Here is your health overview for today</p>
        </div>
        <div class="cencel-apnt-success-error-msg">
            <?php if(isset($success)): ?>
                <h3><?php echo $success ?></h3>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <h3><?php echo $error ?></h3>
            <?php endif; ?>
        </div>
        <!-- Appointment Alert -->
         <div class="appoinments">
            <?php if(!empty($upcoming_appointments)): ?>
            <?php foreach($upcoming_appointments as $appointment): ?>
            <!--Appoinment card start -->
            <div class="appointment-alert">
                    <div class="appointment-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="appointment-details">
                        <h2>Upcoming Appointment</h2>
                    
                        <p>Appoinment ID: <?php echo $appointment['appointment_id']; ?> </p>
                        <p><?php echo $appointment['doctor_name']; ?> - <?php echo $appointment['doctor_specialty']; ?></p>
                        <p class="appointment-date"> Date: <?php echo $appointment['appointment_date']; ?> </p>
                    </div>
                    <button class="btn view-details" onclick="loadApntDetails(<?php echo $appointment['appointment_id'] ?>)">View Details</button>
                    <form method="POST">
                    <button type="button" class= "btn apnt-cencel-btn" name="cencel-appointmet" value="<?php echo $appointment['appointment_id']; ?>" onclick="confirmCencellation(this)">Cencel Appointment </button>
                    </form>
            </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-appointment">
                        <h2>No Upcoming Appointments</h2>
                        <p>You have no appointments scheduled. Book one now!</p>
                        <a href="BookAppointment.php" class="btn">Book Appointment</a>
                    </div>
                <?php endif; ?>
            
         </div>
        
    </div>


    <div id="appointmentModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2>Appointment Details</h2>
            </div>
            <div id="modalDetails">
                <!-- Appointment details will be loaded here via AJAX -->
                
            </div>
        </div>
    </div>


    <!-- javascript validation starts here -->
    <script src="../js/hamburgerMenu.js"> </script>
    <script>
        function loadApntDetails(appointmentId){
            document.getElementById('appointmentModal').style.display = 'block';

            var apntDetails = new XMLHttpRequest();
            apntDetails.open('GET', '../php/getAppointmentDetails.php?appointment_id=' + appointmentId, true);
            
            apntDetails.onload = function() {
            if (apntDetails.status === 200) {
                // Success - display the HTML response
                document.getElementById('modalDetails').innerHTML = apntDetails.responseText;
            } else {
                // Error
                document.getElementById('modalDetails').innerHTML = '<div class="error">Error loading details. Please try again.</div>';
            }
        };

        apntDetails.send();
    }

    function closeModal() {
    document.getElementById('appointmentModal').style.display = 'none';
    }

    function confirmCencellation(button){
        var confirmation = confirm("Are you sure you want to cencel this appoinment?");

        if(confirmation){
            button.type = 'submit';
            button.closest('form').submit();
        }
    }
    </script>
</body>
</html>