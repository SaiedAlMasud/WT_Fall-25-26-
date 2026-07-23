<?php
require_once __DIR__ . '/../../app/Config/db.php';
require_once __DIR__ . '/../../app/Controllers/PatientController.php';

$patientController = new PatientController($conn);
$data = $patientController->home();
extract($data);

require __DIR__ . '/../../app/Views/HomePage.php';
