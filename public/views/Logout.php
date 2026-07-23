<?php
require_once __DIR__ . '/../../app/Controllers/AuthController.php';

// conn not needed for logout, pass null
$authController = new AuthController(null);
$authController->logout();
