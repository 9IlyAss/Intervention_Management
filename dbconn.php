<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if (!$conn) 
    die("Connection failed: " . $conn->connect_error);


$db = $conn->query("SHOW DATABASES LIKE 'Intervention_Managment'");
if ($db->num_rows == 0) 
    {
    $sql = "CREATE DATABASE Intervention_Managment";
    $conn->query($sql);
    }
    $conn->select_db("Intervention_Managment");

    
$table = $conn->query("SHOW TABLES LIKE 'Intervention'");
if ($table->num_rows == 0) 
{
    $sql = "CREATE TABLE Intervention (
        InterventionID int AUTO_INCREMENT PRIMARY KEY,
        Type varchar(70),
        Date date DEFAULT CURDATE(),
        Reference varchar(50),
        Division varchar(50),
        Status varchar(70),
        Deatil varchar(255),
        TypeOfWork varchar(70),
        Rapport LONGBLOB )";
}

$table = $conn->query("SHOW TABLES LIKE 'Client'");
if ($table->num_rows == 0) 
{
    $sql = "CREATE TABLE Cleint (
        CleintID int AUTO_INCREMENT PRIMARY KEY,
        Name varchar(50),
        Email varchar(70),
        Password varchar(80)";
}

$conn->close();
?>
