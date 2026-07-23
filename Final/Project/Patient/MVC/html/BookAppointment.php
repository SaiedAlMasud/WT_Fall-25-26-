<?php
//database connection
require '../db/db_connect.php';
//session created
session_start();

if(!isset($_SESSION['username'])){
    header("Location: /WT_Fall-25-26-/Final/Project/index.php");
    exit();
}

require '../php/bookingConfirmation.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="../css/BookAppointmentStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
    </style>
</head>
<body>
    <nav id="navbar">
        <ul>
        <li><a  href="HomePage.php">Home</a></li>
        <li><a class="active" href="BookAppointment.php">Book Appointment</a></li>
        <li><a href="MedicalHistory.php">Medical History</a></li>
        <li><a href="Profile.php"><?php echo htmlspecialchars($patient_name); ?></a></li>
        <li><a href="../php/Logout.php">Logout</a></li>
    </ul>

    <div class="hamburger-menu" id="hamburgerMenu" onclick="toggleDropdown()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="dropdown-Content"  id="dropdownMenu">
        
            <a href="HomePage.php">Home</a>
            <a href="Profile.php">Profile</a>
            <a class="active" href="BookAppointment.php">Book Appointment</a>
            <a href="MedicalHistory.php">Medical History</a>
            <a href="../php/Logout.php">Logout</a>
        
    </div>
    </nav>
    <div>
        <h2 class="main-heading">
            Find Doctors And Book Appointment
        </h2>
    </div>
    <!--search section-->
    <form method="post" action="">
        <div class="search-section">
            <div class="search-input">
                <i class="fas fa-search"></i>
                <input class="search-box" name="search_name" type="text" placeholder="Search by doctor name" >
            </div>
            <div class="search-input">
                <i class="fas fa-user-md"></i>
                <select name="search_specialty" class="specialist-dropdown">
                    <option value="" selected>Select Specialist</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Neurologist">Neurologist</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Psychiatrist">Psychiatrist</option>
                    <option value="Surgeon">Surgeon</option>
                    <option value="Medicine">Medicine</option>
                </select>
            </div>
            <button type="submit" name="search" class="search-btn">Search</button>
        </div>
    </form>
<!--doctor list section-->
    <div class="doctor-lists">
        <?php if(empty($doctors)): ?>
            <div class="no-doctors">
                <p>No doctors available at the moment.</p>
                <p>Please check back later.</p>
            </div>
        <?php else: ?>
        <!--Available doctor CARDs -->
        <?php foreach ($doctors as $doctor): ?>
        <div class="doctor-card">
            <div class="doctor-img">
                <?php if (!empty($doctor['photo'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($doctor['photo']); ?>" alt="<?php echo htmlspecialchars($doctor['user_name']); ?>">
                <?php endif; ?>
            </div>
            <div class="doctor-info">
                <h3 class="doctor-name">Dr. <?php echo htmlspecialchars($doctor['user_name']); ?></h3>
                <p class="doctor-specialty">Specialization: <?php echo htmlspecialchars($doctor['specilization']); ?></p>
                <p class="doctor-availability">Available: <?php echo htmlspecialchars($doctor['availability_day']); ?></p>
                <p><?php echo htmlspecialchars($doctor['availability_time_start']); ?> to <?php echo htmlspecialchars($doctor['availability_time_end']); ?></p>
                <button class="book-appointment-btn" onclick="OpenModal('<?php echo $doctor['user_name']; ?>', 
                                                     '<?php echo $doctor['specilization']; ?>',
                                                     '<?php echo $doctor['user_id'] ?? ''; ?>')">Book Appointment</button>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!--booking modal-->
    <dialog id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeBookingModal()">&times;</span>
            <h2>Book Appointment</h2>
    <!--show error if any error occurs-->

    <!--book appoinment modal-->
            <form method="post" action="">
                <input type="text" name="doctor_name" id="modalDoctorName" readonly>
                <input type="text" name="doctor_id" id="modalDoctorId" readonly>
                <input type="text" name="doctor_specialty" id="modalDoctorSpecialty" readonly>
                
                <div class="form-group">
                    <label for="patientName">Patient Name</label>
                    <input type="text" id="patientName" value="<?php echo htmlspecialchars($patient_name); ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="doctorInfo">Doctor</label>
                    <input type="text" id="doctorInfo" readonly>
                </div>
                
                <div class="form-group">
                    <label for="appointment_date">Appointment Date </label>
                    <input type="date" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <div class="form-group">
                    <label for="appointment_time">Appointment Time *</label>
                    <select id="appointment_time" name="appointment_time" required>
                        <option value="">Select Time Slot</option>
                        <option value="09:00 AM">09:00 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="11:00 AM">11:00 AM</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="02:00 PM">02:00 PM</option>
                        <option value="03:00 PM">03:00 PM</option>
                        <option value="04:00 PM">04:00 PM</option>
                        <option value="05:00 PM">05:00 PM</option>
                        <option value="06:00 PM">06:00 PM</option>
                        <option value="07:00 PM">07:00 PM</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="symptoms">Symptoms (Optional)</label>
                    <textarea id="symptoms" name="symptoms" placeholder="Describe your symptoms"></textarea>
                </div>
                
                <button type="submit" name="confirm_booking" class="submit-btn">Confirm Appointment</button>
            </form>
        </div>
    </dialog>

<!-- hamburger menu js code -->
    <script src="../js/hamburgerMenu.js"> </script>
    <script src="../js/getBookingModal.js">  </script>


</body>
</html>