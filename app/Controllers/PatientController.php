<?php
require_once __DIR__ . '/../Models/PatientModel.php';
require_once __DIR__ . '/../Models/AppointmentModel.php';

class PatientController {
    private $conn;
    private $patientModel;
    private $appointmentModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->patientModel     = new PatientModel($conn);
        $this->appointmentModel = new AppointmentModel($conn);
    }

    public function home() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: ../index.php");
            exit();
        }

        $success = $error = "";

        // Cancel appointment
        if (isset($_POST['cencel-appointmet'])) {
            $cencel_appointment_id = $_POST['cencel-appointmet'];
            if ($this->appointmentModel->delete($cencel_appointment_id) === true) {
                $success = "Appointment cencelled successfully";
            } else {
                $error = "Error cancelling appointment: " . $this->conn->error;
            }
        }

        $patient_name = $_SESSION['username'];
        $current_date = date('Y-m-d');
        $patient_id   = $this->patientModel->getIdByUsername($patient_name);
        $upcoming_appointments = $patient_id ? $this->appointmentModel->getUpcoming($patient_id, $current_date) : [];

        return compact('patient_name', 'upcoming_appointments', 'success', 'error');
    }
}
