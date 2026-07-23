<?php
class PatientModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM patient WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->num_rows === 1 ? $result->fetch_assoc() : null;
        $stmt->close();
        return $user;
    }

    public function getIdByUsername($username) {
        $sql = "SELECT user_id FROM patient WHERE user_name = '$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['user_id'];
        }
        return null;
    }

    public function create($name, $email, $dob, $gender, $bloodgroup, $weight, $address, $profile_image_path) {
        $sql = "INSERT INTO patient (user_name, user_email, dob, gender, blood_group, weight, address, photo) VALUES ('$name', '$email', '$dob', '$gender', '$bloodgroup', '$weight', '$address', '$profile_image_path')";
        return $this->conn->query($sql);
    }

    public function updateProfile($new_email, $new_bloodgroup, $new_gender, $new_dob, $new_address, $username) {
        $stmt = $this->conn->prepare("UPDATE patient SET user_email = ?, blood_group = ?, gender = ?, dob = ?, address = ? WHERE user_name = ?");
        $stmt->bind_param("ssssss", $new_email, $new_bloodgroup, $new_gender, $new_dob, $new_address, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
