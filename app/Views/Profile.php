<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="../assets/css/ProfileStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav id="navbar">
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="BookAppointment.php">Book Appointment</a></li>
            <li><a href="MedicalHistory.php">Medical History</a></li>
            <li><a class="active" href="Profile.php"><?php echo htmlspecialchars($patient_name); ?></a></li>
            <li><a href="Logout.php">Logout</a></li>
        </ul>

        <div class="hamburger-menu" id="hamburgerMenu" onclick="toggleDropdown()">
            <i class="fas fa-bars"></i>
        </div>

        <div class="dropdown-Content" id="dropdownMenu">
            <a href="HomePage.php">Home</a>
            <a class="active" href="Profile.php">Profile</a>
            <a href="BookAppointment.php">Book Appointment</a>
            <a href="MedicalHistory.php">Medical History</a>
            <a href="Logout.php">Logout</a>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-header">
            <i class="fas fa-user"><h2>My Profile</h2></i>
        </div>

        <div class="profile-photo-section">
            <div class="profile-photo">
                <img src="../uploads/<?php echo htmlspecialchars($patient_img); ?>" alt="Profile Photo">
            </div>
            <p>Patient ID: <?php echo htmlspecialchars($patient_id); ?></p>
        </div>

        <form action="" method="POST">
            <div class="profile-info">

                <div class="info-form">
                    <label for="name">Full Name</label>
                    <div class="info-box">
                        <span><?php echo htmlspecialchars($patient_name); ?></span>
                    </div>
                </div>

                <div class="info-form">
                    <label for="email">Email</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_email); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="email" name="email" value="<?php echo htmlspecialchars($patient_email); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="number">Blood Group</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_bloodgroup); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="text" name="bloodgroup" value="<?php echo htmlspecialchars($patient_bloodgroup); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="gender">Gender</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_gender); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="text" name="gender" value="<?php echo htmlspecialchars($patient_gender); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="dob">Date of Birth</label>
                    <div class="info-box view-mode">
                        <span><?php echo htmlspecialchars($patient_dob); ?></span>
                    </div>
                    <div class="info-box edit-mode" style="display:none;">
                        <input type="date" name="dob" value="<?php echo htmlspecialchars($patient_dob); ?>">
                    </div>
                </div>

                <div class="info-form">
                    <label for="address">Address</label>
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
                    <button class="logout"><a href="Logout.php">Logout</a></button>
                </div>
            </div>
        </form>

        <details class="change-password-section"<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) ? ' open' : ''; ?>>
            <summary>
                <span><i class="fas fa-lock"></i> Change Password</span>
                <i class="fas fa-chevron-down"></i>
            </summary>

            <form action="" method="POST" class="change-password-form">
                <div class="profile-info password-info">
                    <div class="info-form">
                        <label for="current_password">Current Password</label>
                        <div class="info-box password-box">
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="info-form">
                        <label for="new_password">New Password</label>
                        <div class="info-box password-box">
                            <input type="password" id="new_password" name="new_password" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="info-form">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <div class="info-box password-box">
                            <input type="password" id="confirm_new_password" name="confirm_new_password" autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <div class="btn-container password-btn-container">
                    <div class="btn-section">
                        <button class="save-profile" type="submit" name="change_password">Update Password</button>
                    </div>
                </div>
            </form>
        </details>

        <?php if (!empty($success_msg)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success_msg); ?></div>
        <?php endif; ?>
        <?php if (!empty($error_msg)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>
    </div>

    <script src="../assets/js/hamburgerMenu.js"></script>
    <script src="../assets/js/EditInfo.js"></script>
</body>
</html>
