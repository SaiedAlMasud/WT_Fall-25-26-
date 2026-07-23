<?php
//database connection
require '../db/db_connect.php';
require '../php/profileGetdata.php';
require '../php/update_db_EditedData.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="../css/ProfileStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
    </style>
</head>
<body>
    <nav id="navbar">
        <ul>
        <li><a href="HomePage.php">Home</a></li>
        <li><a href="BookAppointment.php">Book Appointment</a></li>
        <li><a href="MedicalHistory.php">Medical History</a></li>
        <li><a class="active" href="Profile.php"><?php echo htmlspecialchars($patient_name); ?></a></li>
        <li><a href="../php/Logout.php">Logout</a></li>
    </ul>

    <div class="hamburger-menu" id="hamburgerMenu" onclick="toggleDropdown()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dropdown-Content"  id="dropdownMenu">
        
            <a href="HomePage.php">Home</a>
            <a class="active" href="Profile.php">Profile</a>
            <a href="BookAppointment.php">Book Appointment</a>
            <a href="MedicalHistory.php">Medical History</a>
            <a href="../php/Logout.php">Logout</a>
        
    </div>
    </nav>
     <div class="profile-container">
    <!-- Profile Header -->
        <div class="profile-header">
            <i class="fas fa-user"><h2>My Profile</h2></i>
        </div>

    <!-- Profiles info with photo -->
   
        <div class="profile-photo-section">
            <div class="profile-photo">
                <img src="<?php echo htmlspecialchars($patient_img); ?>" alt="Profile Photo">
            </div>
            <p>Patient ID: <?php echo htmlspecialchars($patient_id); ?></p>
            
        </div>


        <!-- Main Profile Info -->
        <form action="" method="POST">
            <div class="profile-info">

            
                <div class="info-form">
                    <label for="name"> Full Name</label>
                    <div class="info-box">
                        <span><?php echo htmlspecialchars($patient_name); ?></span>
                    </div>
                </div>

                <div class="info-form">
                    <label for="email"> Email</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_email); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="email" name="email" value="<?php echo htmlspecialchars($patient_email); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="number"> Blood Group</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_bloodgroup); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="text" name="bloodgroup" value="<?php echo htmlspecialchars($patient_bloodgroup); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="gender"> Gender</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_gender); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="text" name="gender" value="<?php echo htmlspecialchars($patient_gender); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="dob"> Date of Birth</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_dob); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="date" name="dob" value="<?php echo htmlspecialchars($patient_dob); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="address"> Address</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_address); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="text" name="address" value="<?php echo htmlspecialchars($patient_address); ?>">
                    </div>
                </div> 
            </div>

            <div class="btn-container">
                <div class="btn-section">
                    <button class="edit-profile" id="editBtn" type="button">Edit Profile</button>
                </div>
                <div class="btn-section" id="saveBtn" style="display:none;">
                    <button class="save-profile" type="submit" name="update_profile">Save Changes</button>
                </div>
                <div class="btn-section">
                    <button class="logout"><a href="../php/Logout.php">Logout</a></button>
                </div>
            </div> 

        </form>
         <!-- Success/Error Messages -->
        <?php if(isset($success_msg)): ?>
            <div class="alert success">
                <?php echo htmlspecialchars($success_msg); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($error_msg)): ?>
            <div class="alert error">
                <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>
    </div>

<!-- hamburger menu js code -->
    <script src="../js/hamburgerMenu.js"> </script>
<!-- js code for edit info -->
    <script src="../js/EditInfo.js"> </script>


</body>
</html>