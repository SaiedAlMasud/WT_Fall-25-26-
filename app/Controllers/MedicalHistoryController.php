<?php
require_once __DIR__ . '/../Models/MedicalHistoryModel.php';

class MedicalHistoryController {
    private $conn;
    private $medicalHistoryModel;

    public function __construct($conn) {
        $this->conn               = $conn;
        $this->medicalHistoryModel = new MedicalHistoryModel($conn);
    }

    public function history() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: ../index.php");
            exit();
        }

        $medical_historys = $this->medicalHistoryModel->getAll();

        return compact('medical_historys');
    }
}
