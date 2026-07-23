<?php
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Models/PatientModel.php';
require_once __DIR__ . '/../Models/DoctorModel.php';

class AuthController {
    private $conn;
    private $userModel;
    private $patientModel;
    private $doctorModel;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->userModel   = new UserModel($conn);
        $this->patientModel = new PatientModel($conn);
        $this->doctorModel  = new DoctorModel($conn);
    }

    // ── Login ────────────────────────────────────────────────────
    public function login() {
        session_start();

        if (isset($_SESSION['username'])) {
            header("Location: views/HomePage.php");
            exit();
        }

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isset($_POST['remember'])) {
                setcookie('remember_me', $username, time() + 60, '/');
            } else {
                setcookie('remember_me', '', time() - 3600, '/');
            }

            $user = $this->userModel->findByUsername($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['user_name'];
                    header("Location: views/HomePage.php");
                    exit();
                } else {
                    $error = "Invalid username or password.";
                }
            } else {
                $error = "User not found";
            }
        }

        return $error;
    }

    // ── Logout ───────────────────────────────────────────────────
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        if (isset($_COOKIE['remember_me'])) {
            setcookie('remember_me', '', time() - 3600, '/');
        }
        header("Location: ../index.php");
        exit();
    }

    // ── Register ─────────────────────────────────────────────────
    public function register() {
        $name = $email = $dob = $bloodgroup = $weight = $address = $password = $gender = $user = $profile_image_path = "";
        $success = $errormsg = "";
        $has_error = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $dob        = $_POST['dob'];
            $bloodgroup = $_POST['bloodgroup'];
            $weight     = $_POST['weight'];
            $address    = $_POST['address'];
            $password   = $_POST['password'];
            $gender     = $_POST['gender'];
            $user       = $_POST['user'];
            $terms      = isset($_POST['terms']);

            // Image upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $image      = $_FILES['profile_image'];
                $image_name = $image['name'];
                $image_temp = $image['tmp_name'];
                $image_type = $image['type'];

                if ($image_type != "image/jpeg" && $image_type != "image/png" && $image_type != "image/jpg") {
                    $errormsg = "Only JPG, PNG and GIF files are allowed.";
                    $has_error = true;
                } else {
                    $upload_dir = __DIR__ . '/../../public/uploads/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    $target_path = $upload_dir . $image_name;
                    if (move_uploaded_file($image_temp, $target_path)) {
                        $profile_image_path = 'uploads/' . $image_name;
                    } else {
                        $errormsg = "Failed to upload image.";
                        $has_error = true;
                    }
                }
            }

            // Validation
            if (!$has_error) {
                if (empty($name) || empty($email) || empty($dob) || empty($bloodgroup) || empty($weight) || empty($address) || empty($password) || empty($gender) || empty($user) || !$terms || empty($profile_image_path)) {
                    $errormsg = "All fields are required";
                    $has_error = true;
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errormsg = "Enter valid email address (e.g., anything@example.com)";
                    $has_error = true;
                } elseif (strlen($password) < 8) {
                    $errormsg = "Password must be at least 8 characters long";
                    $has_error = true;
                } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $password)) {
                    $errormsg = "Password must be at least 8 characters with uppercase, lowercase, and number";
                    $has_error = true;
                }
            }

            if (!$has_error) {
                if ($this->userModel->usernameExists($name)) {
                    $errormsg = "Username or Email already exists";
                    $has_error = true;
                } else {
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                    if ($user === "patient") {
                        $this->patientModel->create($name, $email, $dob, $gender, $bloodgroup, $weight, $address, $profile_image_path);
                        $this->userModel->createUser($name, $email, $hashPassword, $user);
                        $success = "Registration Complete you can do login";
                    } elseif ($user === "doctor") {
                        $this->doctorModel->create($name, $dob, $gender, $bloodgroup, $weight, $address, $profile_image_path);
                        $this->userModel->createUser($name, $email, $hashPassword, $user);
                        $success = "Registration Complete you can do login";
                    }
                }
            }
        }

        return ['success' => $success, 'errormsg' => $errormsg];
    }
}
