<?php
include("/dbconn.php");

$type=$_POST["rapporttype"];
$Data=$_POST["rapport"];

    header("Content-type : $type");
    echo $Data;

?>