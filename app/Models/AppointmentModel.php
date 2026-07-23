<?php
class AppointmentModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUpcoming($patient_id, $current_date) {
        $upcoming = [];
        $sql = "SELECT * FROM appointments WHERE patient_id = '$patient_id' AND appointment_date >= '$current_date' ORDER BY appointment_date ASC, appointment_time ASC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $upcoming[] = $row;
            }
        }
        return $upcoming;
    }

    public function getById($appointment_id) {
        $sql = "SELECT * FROM appointments WHERE appointment_id = '$appointment_id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function create($patient_name, $patient_id, $doctor_name, $doctor_id, $doctor_specialty, $appointment_date, $appointment_time, $symptoms) {
        $sql = "INSERT INTO appointments (patient_name, patient_id, doctor_name, doctor_id, doctor_specialty, appointment_date, appointment_time, symptoms) VALUES ('$patient_name', '$patient_id', '$doctor_name', '$doctor_id', '$doctor_specialty', '$appointment_date', '$appointment_time', '$symptoms')";
        return $this->conn->query($sql);
    }

    public function delete($appointment_id) {
        $sql = "DELETE FROM appointments WHERE appointment_id = '$appointment_id'";
        return $this->conn->query($sql);
    }
}
