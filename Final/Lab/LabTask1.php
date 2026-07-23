<?php
    $name="";
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
    <form action="LabTask1.php" method="post">
        <div>
            <h3>Name</h3>
            <input type="text" name="name">
            <hr>
            <input type="submit" name="submit">
        </div>
    </form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name= trim($_POST["name"]);

        if(empty($name)){
            echo "Name cannot be empty";
        }
        elseif(str_word_count($name)< 2){
            echo "Name must have atleast 2 character";
        }
        elseif (!preg_match("/^[a-zA-Z]/", $name)) {
        echo "Name must start with a letter.";
        }
        elseif(!preg_match("/^[a-zA-Z .-]+$/", $name)){
            echo "Name can contain a-z, A-Z, period, dash only";
        }
        else{
            echo "Valid Name";
        }
    }
?>