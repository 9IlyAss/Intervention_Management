<?php
include("../dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$type=$_POST["Maintenance"];
$Div=$_POST["Div"];
$Ref=$_POST["Ref"];

$typeWork="";
$Work=$_POST["Work"];
$Date=$_POST["Date"];
$Details=$_POST["Details"];

$rapport = $_FILES["rapport"];
$rapportType = mime_content_type($rapport["tmp_name"]);
$rapportData = addslashes(file_get_contents($rapport["tmp_name"]));
// if ($rapport["size"] > 500000) {
//     echo "Sorry, your file is too large";
// }
$sql="INSERT INTO Intervention (Type,Date,Reference,Division,Status,Detail,TypeOfWork,Rapport,RapportType)
       VALUES (?,?,?,?,?,?,?,?);"
$stmt=$conn->prepare($sql);
$stmt->bind_param("sssssssbs",$type,$Date,$Ref,$Div,$Work,$Details,$typeWork,$rapportData,$rapportType);
$stmt->execute();
$stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .header {
            margin-top: 14px;
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


        .woty {
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
    <div id="Security">
        <div class="header text-center">
            <h2>Security</h2>
        </div>

        <div class="container d-flex flex-column align-items-center">
            <form action="" method="post" class="w-100" enctype="multipart/form-data">
                <input type="hidden" name="form_type" value="Security">

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
                        <label class="btn woty btn-outline-success" for="completedRadio">Completed</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="Work" id="progressRadio" value="WorkProgress" onclick="inprogress()">
                        <label class="btn woty btn-outline-primary" for="progressRadio">In Progress</label>
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <label class="pb-2">Details :</label>
                    <div class="col-md-8"> <!-- Adjusted width here -->
                            <textarea class="form-control" name="Details" placeholder="" id="textarea"></textarea>
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
    <script ></script>
</body>

</html>
