<?php
require_once __DIR__ . '/../../app/Config/db.php';
require_once __DIR__ . '/../../app/Controllers/AppointmentController.php';

$appointmentController = new AppointmentController($conn);
$data = $appointmentController->bookAppointment();
extract($data);

require __DIR__ . '/../../app/Views/BookAppointment.php';
