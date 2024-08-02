<?php

include("../dbconn.php");

$rapport = $_POST['rapport'];
$rapportType = $_POST['rapporttype'];
$InterventionID=$_POST['InterventionID'];
// Decode the base64-encoded file content
$sql = "SELECT * FROM `Intervention` WHERE InterventionID='$InterventionID' LIMIT 1";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows === 0) {
    die("File does not exist.");
}

$row = $result->fetch_object();
if (!$row) {
    die("Error fetching object.");
}

// Set headers and output file
header("Content-type: " . $row->RapportType);
echo $row->Rapport;
?>
