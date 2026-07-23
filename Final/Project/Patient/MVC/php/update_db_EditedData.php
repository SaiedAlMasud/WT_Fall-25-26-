<?php
//edit profile info update in database
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])){
    //get the edited data from the form
    $new_email = $_POST['email'];
    $new_bloodgroup = $_POST['bloodgroup'];
    $new_gender = $_POST['gender'];
    $new_dob = $_POST['dob'];
    $new_address = $_POST['address'];

    //then run query to update the data in database
    $update_stmt = $conn->prepare("UPDATE patient SET user_email = ?, blood_group = ?, gender = ?, dob = ?, address = ? WHERE user_name = ?");
    $update_stmt->bind_param("ssssss", $new_email, $new_bloodgroup, $new_gender, $new_dob, $new_address, $username);

    $update_user_stmt = $conn -> prepare("UPDATE users SET email = ? WHERE user_name = ?");
    $update_user_stmt -> bind_param("ss", $new_email, $username);

    if($update_stmt->execute() && $update_user_stmt -> execute()){
        $success_msg = "Profile updated successfully!";

        //change the variable data to updated data to show in the profile page
        $patient_email = $new_email;
        $patient_bloodgroup = $new_bloodgroup;
        $patient_gender = $new_gender;
        $patient_dob = $new_dob;
        $patient_address = $new_address;
    }
    else{
        $error_msg = "Error updating profile. Please try again.";
    }

    $update_stmt->close();
    $update_user_stmt -> close();
}

?>