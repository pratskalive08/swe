<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['logval']);
unset($_SESSION['rest']);
unset($_SESSION['Admin']);
session_unset();;

echo 'Logout successful :)';
session_destroy();

header('Location: login.php'); 
?>