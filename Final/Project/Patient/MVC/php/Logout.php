<?php
//session created
session_start();
//Destroying session
session_unset();
session_destroy();
//delete cookie data
if(isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, '/');
}

header("Location: /WT_Fall-25-26-/Final/Project/index.php");
exit();
?>