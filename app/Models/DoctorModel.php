<?php
class DoctorModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $doctors = [];
        $result = $this->conn->query("SELECT * FROM doctor ORDER BY user_name ASC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row;
            }
        }
        return $doctors;
    }

    public function search($search_name, $search_specialty) {
        $doctors = [];
        $sql = "SELECT * FROM doctor WHERE 1=1";
        if (!empty($search_name)) {
            $sql .= " AND user_name LIKE '%$search_name%'";
        }
        if (!empty($search_specialty)) {
            $sql .= " AND specilization = '$search_specialty'";
        }
        $sql .= " ORDER BY user_name ASC";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row;
            }
        }
        return $doctors;
    }

    public function getDoctorById($doctor_id) {
        $stmt = $this->conn->prepare("SELECT * FROM doctor WHERE user_id = ?");
        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->num_rows === 1 ? $result->fetch_assoc() : null;
        $stmt->close();
        return $doctor;
    }

    public function create($name, $dob, $gender, $bloodgroup, $weight, $address, $profile_image_path) {
        $sql = "INSERT INTO doctor (user_name, dob, gender, blood_group, weight, address, photo) VALUES ('$name', '$dob', '$gender', '$bloodgroup', '$weight', '$address', '$profile_image_path')";
        return $this->conn->query($sql);
    }
}
