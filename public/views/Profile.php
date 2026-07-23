<?php
require_once __DIR__ . '/../../app/Config/db.php';
require_once __DIR__ . '/../../app/Controllers/ProfileController.php';

$profileController = new ProfileController($conn);
$data = $profileController->profile();
extract($data);

require __DIR__ . '/../../app/Views/Profile.php';
