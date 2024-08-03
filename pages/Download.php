<?php

include("../dbconn.php");

$InterventionID=$_GET['ID'];
$sql = "SELECT * FROM `Intervention` WHERE InterventionID='$InterventionID' ";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    die("File does not exist.");
}

$row = $result->fetch_object();
header("Content-type: " . $row->RapportType);
echo $row->Rapport;
?>
