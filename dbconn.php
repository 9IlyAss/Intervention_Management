<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if (!$conn) 
    die("Connection failed: " . $conn->connect_error);


    $sql = "CREATE DATABASE IF NOT EXISTS Intervention_Managment";
    $conn->query($sql);
    $conn->select_db("Intervention_Managment");


    $sql = "CREATE TABLE  IF NOT EXISTS User (
            UserID int AUTO_INCREMENT PRIMARY KEY,
            Name varchar(50),
            Email varchar(70),
            Password varchar(80),
            ResCode int )";
    $conn->query($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS Intervention (
        UserID int,
        InterventionID int AUTO_INCREMENT PRIMARY KEY,
        Type varchar(70),
        Date date ,
        Reference varchar(50),
        Division varchar(50),
        Status varchar(70),
        Detail varchar(255),
        TypeOfWork varchar(70),
        Rapport LONGBLOB,
        RapportType VARCHAR (70),
        FOREIGN KEY (UserID) REFERENCES User(UserID));";
    $conn->query($sql);


?>
