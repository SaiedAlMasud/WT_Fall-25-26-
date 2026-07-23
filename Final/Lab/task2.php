<?php
    $email="";
    $errormsg= "";

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Lab Task 1</title>
    <style>
        div {
            border: 2px solid black;
            width: 250px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <form action="task2.php" method="post">
        <div>
            <h3>Email</h3>
            <input type="text" name="email">
            <hr>
            <input type="submit" name="submit">
        </div>
    </form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $email= trim($_POST["email"]);

        if(empty($email)){
            echo "Email cannot be empty";
        }
        elseif(!preg_match("/^[a-zA-Z0-9]+@gmail\.com$/", $email)){
            echo "Enter valid email address";
        }
        else{
            echo "Valid Email";

        }
    }
?>