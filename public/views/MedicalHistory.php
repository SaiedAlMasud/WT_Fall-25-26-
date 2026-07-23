<?php
require_once __DIR__ . '/../../app/Config/db.php';
require_once __DIR__ . '/../../app/Controllers/MedicalHistoryController.php';

$medicalHistoryController = new MedicalHistoryController($conn);
$data = $medicalHistoryController->history();
extract($data);

require __DIR__ . '/../../app/Views/MedicalHistory.php';
