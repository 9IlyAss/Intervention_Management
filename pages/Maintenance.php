<?php
include("../dbconn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$type=$_POST["form_type"];
$Div=$_POST["Div"];
$Ref=$_POST["Ref"];

$typeWork=$_POST["typeWork"];
$Work=$_POST["Work"];
$Date=$_POST["Date"];
$Details="";

$rapport = $_FILES["rapport"];
$rapportType = getimagesize($rapport['tmp_name']);
$rapportData = addslashes(file_get_contents($rapport["tmp_name"]));
// if ($rapport["size"] > 500000) {
//     echo "Sorry, your file is too large";
// }
$sql="INSERT INTO Intervention (Type,Date,Reference,Division,Status,Detail,TypeOfWork,Rapport,RapportType)
       VALUES (?,?,?,?,?,?,?,?,?);";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sssssssbs",$type,$Date,$Ref,$Div,$Work,$Details,$typeWork,$rapportData,$rapportType['mine']);
$stmt->execute();
$stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            
        }

        .header {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 3rem;
            font-weight: 700;
            color: #ffffff;
        }

        .container {
            background-color: #343a40;
            border-radius: 8px;
            padding: 30px;
        }

        .form-group label {
            font-weight: 500;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #495057;
            color: #ffffff;
            border: 1px solid #6c757d;
        }

        .woty{
            padding: 8px 16px;
        }

        .input-group-text {
            background-color: #495057;
            color: #ffffff;
            border: 1px solid #6c757d;
            
        }

        .row label {
            font-weight: 500;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div id="Maintenance">
        <div class="header text-center">
            <h2>Maintenance</h2>
        </div>

        <div class="container d-flex flex-column align-items-center">
            <form action="pages/Maintenance.php" method="post" class="w-100" enctype="multipart/form-data">

                <input type="hidden" name="form_type"  value="Maintenance">

                <div class="form-group mb-3">
                    <label for="refInput">Ref :</label>
                    <input type="text" class="form-control" id="refInput" name="Ref" placeholder="">
                </div>

                <div class="form-group mb-3">
                    <label for="divSerInput">Div/Ser :</label>
                    <input type="text" class="form-control" id="divSerInput" name="Div" placeholder="">
                </div>
                <div class="form-group mb-3">
                    <label for="dateInput">Date :</label>
                    <input type="date" class="form-control" id="dateInput" name="Date" placeholder="">
                </div>

                <div class="row justify-content-center mb-3">
                    <label class="pb-2">The Work :</label>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="Work" id="completedRadio" value="WorkCompleted" onclick="done()" checked>
                        <label class="btn woty btn-outline-success " for="completedRadio">Completed</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="Work" id="progressRadio" value="WorkProgress" onclick="inprogress()">
                        <label class="btn woty btn-outline-primary" for="progressRadio">In Progress</label>
                    </div>
                </div>
                

                <div class="row justify-content-center mb-4">
                    <label class="pb-2">Type :</label>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="typeWork" id="Softwareradio" value="Software">
                        <label class="btn woty btn-outline-warning" for="Softwareradio">Software</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="typeWork" id="Hardwareradio" value="Hardware">
                        <label class="btn woty btn-outline-warning" for="Hardwareradio">Hardware</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="typeWork" id="networkRadio" value="Network">
                        <label class="btn woty btn-outline-warning" for="networkRadio">Network</label>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="rapportInput" name="rapport">
                    <label class="input-group-text" for="rapportInput">Upload the Rapport</label>
                </div>
                    
                
                <div class="d-grid gap-2 col-7 mx-auto">
                    <button type="submit" class="btn btn-danger btn-lg">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script >

    </script>


</body>

</html>
