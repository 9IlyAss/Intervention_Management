<?php

include("../dbconn.php");

$InterventionID =$_GET['ID'];

$sql = "SELECT Rapport, RapportType FROM Intervention WHERE InterventionID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $InterventionID);
$stmt->execute();
$stmt->bind_result($rapport, $rapportType);
$stmt->fetch();
$stmt->close();

$TWD = '/';
$type = explode($TWD, $rapportType);
$type = end($type);

header("Content-Type: " . $rapportType);
header('Content-Disposition: attachment; filename="InterventionNum' . $InterventionID . '.' . $type . '"');
echo $rapport;
?>
