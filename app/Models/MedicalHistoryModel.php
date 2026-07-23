<?php
class MedicalHistoryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $medical_historys = [];
        $sql = "SELECT * FROM medicalhistory ORDER BY appointment_date ASC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medical_historys[] = $row;
            }
        }
        return $medical_historys;
    }
}
