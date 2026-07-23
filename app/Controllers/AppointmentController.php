<?php
require_once __DIR__ . '/../Models/PatientModel.php';
require_once __DIR__ . '/../Models/DoctorModel.php';
require_once __DIR__ . '/../Models/AppointmentModel.php';

class AppointmentController {
    private $conn;
    private $patientModel;
    private $doctorModel;
    private $appointmentModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->patientModel     = new PatientModel($conn);
        $this->doctorModel      = new DoctorModel($conn);
        $this->appointmentModel = new AppointmentModel($conn);
    }

    public function bookAppointment() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: ../index.php");
            exit();
        }

        $patient_name    = $_SESSION['username'];
        $doctors         = [];
        $search_name     = '';
        $search_specialty = '';

        $patient_id = $this->patientModel->getIdByUsername($patient_name);

        // Booking submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_booking'])) {
            $doctor_name      = $_POST['doctor_name'];
            $doctor_id        = $_POST['doctor_id'];
            $doctor_specialty = $_POST['doctor_specialty'];
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
            $symptoms         = $_POST['symptoms'];

            if (!empty($doctor_name) && !empty($appointment_date) && !empty($appointment_time) && !empty($symptoms)) {
                $booking_result = $this->appointmentModel->create($patient_name, $patient_id, $doctor_name, $doctor_id, $doctor_specialty, $appointment_date, $appointment_time, $symptoms);
                if ($booking_result === true) {
                    echo "<script>alert('Appointment booked successfully!');</script>";
                } else {
                    echo "<script>alert('Error booking appointment: " . $this->conn->error . "');</script>";
                }
            }
        }

        // Search
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
            $search_name      = $_POST['search_name'];
            $search_specialty = $_POST['search_specialty'];
            $doctors = $this->doctorModel->search($search_name, $search_specialty);
        } else {
            $doctors = $this->doctorModel->getAll();
        }

        return compact('patient_name', 'doctors', 'search_name', 'search_specialty');
    }

    public function getDetails() {
        if (isset($_GET['appointment_id'])) {
            $appoint_id = $_GET['appointment_id'];
            $details = $this->appointmentModel->getById($appoint_id);
            if ($details) {
                echo '<p>Patient Name: '     . $details['patient_name']    . '</p>';
                echo '<p>Doctor Name: '      . $details['doctor_name']     . '</p>';
                echo '<p>Doctor Speciality: '. $details['doctor_specialty']. '</p>';
                echo '<p>Appointment Date: ' . $details['appointment_date']. '</p>';
                echo '<p>Appointment time: ' . $details['appointment_time']. '</p>';
                echo '<p>Symptoms: '         . $details['symptoms']        . '</p>';
            } else {
                echo "<p>No appointment found</p>";
            }
        }
    }
}
