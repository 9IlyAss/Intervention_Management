<?php
    
include("../dbconn.php");

    $InterventionID = $_GET['ID'];

$sql = "SELECT Rapport, RapportType FROM Intervention WHERE InterventionID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $InterventionID);
$stmt->execute();
$stmt->bind_result($rapport, $rapportType);
$stmt->fetch();
$stmt->close();

header("Content-type: " . $rapportType);
echo $rapport;
    
?>
