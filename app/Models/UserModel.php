<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function findByUsername($username) {
        $stmt = $this->conn->prepare("SELECT user_name, password FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->num_rows === 1 ? $result->fetch_assoc() : null;
        $stmt->close();
        return $user;
    }

    public function usernameExists($name) {
        $result = $this->conn->query("SELECT * FROM users WHERE user_name='$name'");
        return $result->num_rows > 0;
    }

    public function createUser($name, $email, $hashPassword, $user) {
        $sql = "INSERT INTO users (user_name, email, password, user_type) VALUES ('$name', '$email', '$hashPassword', '$user')";
        return $this->conn->query($sql);
    }

    public function updateEmail($new_email, $username) {
        $stmt = $this->conn->prepare("UPDATE users SET email = ? WHERE user_name = ?");
        $stmt->bind_param("ss", $new_email, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updatePassword($username, $hashedPassword) {
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE user_name = ?");
        $stmt->bind_param("ss", $hashedPassword, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
