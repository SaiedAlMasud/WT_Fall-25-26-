<?php
require_once __DIR__ . '/../../app/Config/db.php';
require_once __DIR__ . '/../../app/Models/DoctorModel.php';

session_start();
if (!isset($_SESSION['username'])) {
    echo '<p class="doctor-profile-error">Please login to view doctor profile.</p>';
    exit();
}

if (!isset($_GET['doctor_id']) || empty($_GET['doctor_id'])) {
    echo '<p class="doctor-profile-error">Doctor not found.</p>';
    exit();
}

$doctorModel = new DoctorModel($conn);
$doctor = $doctorModel->getDoctorById((int)$_GET['doctor_id']);

if (!$doctor) {
    echo '<p class="doctor-profile-error">Doctor not found.</p>';
    exit();
}

$doctorName = $doctor['user_name'];
$specialization = $doctor['specilization'];
$doctorId = $doctor['user_id'];
$photo = !empty($doctor['photo']) ? '../uploads/' . $doctor['photo'] : '';
?>

<div class="doctor-profile">
    <div class="doctor-profile-photo">
        <?php if (!empty($photo)): ?>
            <img src="<?php echo htmlspecialchars($photo); ?>" alt="<?php echo htmlspecialchars($doctorName); ?>">
        <?php else: ?>
            <i class="fas fa-user-md"></i>
        <?php endif; ?>
    </div>

    <div class="doctor-profile-info">
        <h3>Dr. <?php echo htmlspecialchars($doctorName); ?></h3>
        <p><strong>Specialization:</strong> <?php echo htmlspecialchars($specialization); ?></p>
        <p><strong>Available Days:</strong> <?php echo htmlspecialchars($doctor['availability_day']); ?></p>
        <p><strong>Available Time:</strong> <?php echo htmlspecialchars($doctor['availability_time_start']); ?> to <?php echo htmlspecialchars($doctor['availability_time_end']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($doctor['gender']); ?></p>

        <button class="book-appointment-btn profile-book-btn" onclick='closeDoctorProfileModal(); OpenModal(<?php echo json_encode($doctorName); ?>, <?php echo json_encode($specialization); ?>, <?php echo json_encode($doctorId); ?>)'>Book Appointment</button>
    </div>
</div>
