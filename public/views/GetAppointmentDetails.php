<?php
require_once __DIR__ . '/../../app/Config/db.php';
require_once __DIR__ . '/../../app/Controllers/AppointmentController.php';

$appointmentController = new AppointmentController($conn);
$appointmentController->getDetails();
