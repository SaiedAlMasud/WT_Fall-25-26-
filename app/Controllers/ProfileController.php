<?php
require_once __DIR__ . '/../Models/PatientModel.php';
require_once __DIR__ . '/../Models/UserModel.php';

class ProfileController {
    private $conn;
    private $patientModel;
    private $userModel;

    public function __construct($conn) {
        $this->conn         = $conn;
        $this->patientModel = new PatientModel($conn);
        $this->userModel    = new UserModel($conn);
    }

    public function profile() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: ../index.php");
            exit();
        }

        $username        = $_SESSION['username'];
        $patient_name    = $patient_id = $patient_email = $patient_dob = "";
        $patient_gender  = $patient_address = $patient_bloodgroup = "";
        $patient_weight  = $patient_img = "";
        $success_msg     = $error_msg = "";

        // Get profile data
        $user = $this->patientModel->getByUsername($username);
        if ($user) {
            $patient_name      = $user['user_name'];
            $patient_id        = $user['user_id'];
            $patient_email     = $user['user_email'];
            $patient_dob       = $user['dob'];
            $patient_gender    = $user['gender'];
            $patient_address   = $user['address'];
            $patient_bloodgroup = $user['blood_group'];
            $patient_weight    = $user['weight'];
            $patient_img       = $user['photo'];
        }

        // Update profile
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
            $new_email      = $_POST['email'];
            $new_bloodgroup = $_POST['bloodgroup'];
            $new_gender     = $_POST['gender'];
            $new_dob        = $_POST['dob'];
            $new_address    = $_POST['address'];

            $p1 = $this->patientModel->updateProfile($new_email, $new_bloodgroup, $new_gender, $new_dob, $new_address, $username);
            $p2 = $this->userModel->updateEmail($new_email, $username);

            if ($p1 && $p2) {
                $success_msg       = "Profile updated successfully!";
                $patient_email     = $new_email;
                $patient_bloodgroup = $new_bloodgroup;
                $patient_gender    = $new_gender;
                $patient_dob       = $new_dob;
                $patient_address   = $new_address;
            } else {
                $error_msg = "Error updating profile. Please try again.";
            }
        }

        // Change password
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
            $current_password     = $_POST['current_password'];
            $new_password         = $_POST['new_password'];
            $confirm_new_password = $_POST['confirm_new_password'];

            $userAccount = $this->userModel->findByUsername($username);

            if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
                $error_msg = "All password fields are required.";
            } elseif (!$userAccount || !password_verify($current_password, $userAccount['password'])) {
                $error_msg = "Current password is incorrect.";
            } elseif ($new_password !== $confirm_new_password) {
                $error_msg = "New password and confirm password do not match.";
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $new_password)) {
                $error_msg = "Password must be at least 8 characters with uppercase, lowercase, and number.";
            } else {
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

                if ($this->userModel->updatePassword($username, $hashedPassword)) {
                    $success_msg = "Password changed successfully!";
                } else {
                    $error_msg = "Error changing password. Please try again.";
                }
            }
        }

        return compact(
            'patient_name', 'patient_id', 'patient_email', 'patient_dob',
            'patient_gender', 'patient_address', 'patient_bloodgroup',
            'patient_weight', 'patient_img', 'success_msg', 'error_msg'
        );
    }
}
