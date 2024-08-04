<?php
    include("../dbconn.php");
    session_start(); 
    session_destroy();
    header("Location: ../login/logIn.php"); 
?>
