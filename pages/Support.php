<?php
session_start();
include("C:/xampp/htdocs/project/Intervention_Managment/dbconn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $type=$_POST["form_type"];
        $Div=$_POST["Div"];
        $Ref=$_POST["Ref"];

        $typeWork="---";
        $Work=$_POST["Work"];
        $Date=$_POST["Date"];
        $Details=$_POST['Details'];

        $rapport = $_FILES["rapport"];
        $rapportType = $rapport['type'];
        $rapportData = file_get_contents($rapport["tmp_name"]);

        $array=['image/jpeg', 'image/png', 'application/pdf'];
        if ($rapport["size"] > 1048576) //1mb
            {
                $_SESSION["failed"]="Data upload failed (your file is too large).";
            }
        else if(!in_array($rapportType,$array))
            {
                $_SESSION["failed"]="Data upload failed (only JPG, JPEG, PNG files are allowed.).";
            }
        else 
            {
                $sql="INSERT INTO Intervention (UserID,Type,Date,Reference,Division,Status,Detail,TypeOfWork,Rapport,RapportType)
                    VALUES (?,?,?,?,?,?,?,?,?,?);";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("isssssssss",$_SESSION['ID'],$type,$Date,$Ref,$Div,$Work,$Details,$typeWork,$rapportData,$rapportType);
                $stmt->execute();
                $stmt->close();
                $_SESSION["success"]="Data has been successfully submitted";
            }
        header("Location: ../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
<!--============================================ CSS ==============================================================
    ==============================================================================================================-->
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
<!--============================================ HTML ==============================================================
    ==============================================================================================================-->
<body>
    <div id="Support">
        <div class="header text-center">
            <h2>Support</h2>
        </div>

        <div class="container d-flex flex-column align-items-center">
            <form action="pages/Support.php" method="post" class="w-100 " enctype="multipart/form-data">
                <input type="hidden" name="form_type" value="Support">

                <div class="form-group mb-3">
                    <label for="refInput">Ref :</label>
                    <input type="text" class="form-control" id="refInput" name="Ref" placeholder="" required>
                </div>

                <div class="form-group mb-3">
                    <label for="divSerInput">Div/Ser :</label>
                    <input type="text" class="form-control" id="divSerInput" name="Div" placeholder="" required>
                </div>
                <div class="form-group mb-3">
                    <label for="dateInput">Date :</label>
                    <input type="date" class="form-control" id="dateInput" name="Date" placeholder="" required>
                </div>

                <div class="row justify-content-center mb-3">
                    <label class="pb-2">The Work :</label>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="Work" id="completedRadio" value="Completed" onclick="done()" checked>
                        <label class="btn woty btn-outline-success" for="completedRadio">Completed</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="btn-check" name="Work" id="progressRadio" value="InProgress" onclick="inprogress()">
                        <label class="btn woty btn-outline-primary" for="progressRadio">In Progress</label>
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <label class="pb-2">Details :</label>
                    <div class="col-md-8"> 
                            <textarea class="form-control" name="Details" placeholder="" id="textarea"></textarea>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="rapportInput" name="rapport">
                    <label class="input-group-text" for="rapportInput" required>Upload the Rapport</label>
                </div>

                <div class="d-grid gap-2 col-7 mx-auto">
                    <button type="submit" class="btn btn-danger btn-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>

    </script>
</body>

</html>
