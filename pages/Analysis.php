<?php
session_start();
include("dbconn.php");

    
// nbrIntervention
        $sql = 'SELECT COUNT(*) AS nbr FROM Intervention WHERE UserID=' . $_SESSION["ID"] . ';';
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nbrIntervention = $row['nbr'];
        
// nbrMaintenance
$sql = "SELECT COUNT(*) as nbr FROM Intervention WHERE UserID=" . $_SESSION["ID"] . " AND Type LIKE 'Maintenance';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nbrMaintenance = $row['nbr'];
// nbrSecurity
$sql = "SELECT COUNT(*) as nbr FROM Intervention WHERE UserID=" . $_SESSION["ID"] . " AND Type LIKE 'Security';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nbrSecurity = $row['nbr'];
// nbrSupport
$sql = "SELECT COUNT(*) as nbr FROM Intervention WHERE UserID=" . $_SESSION["ID"] . " AND Type LIKE 'Support';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nbrSupport = $row['nbr'];



//table ++++++++RapportType
    if(isset($_POST["Date"]) && !empty($_POST["Date"]))
        {
            $Date = $_POST["Date"];

            $sql="SELECT  Reference,Division,Status,TypeOfWork,InterventionID  FROM Intervention
                WHERE UserID=? AND Date=?
                ORDER BY InterventionID DESC;";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("is",$_SESSION["ID"],$Date);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analysis Form</title>
    <!--============================================ CSS ==============================================================
    ==============================================================================================================-->
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

        .input-group-text {
            background-color: #495057;
            color: #ffffff;
            border: 1px solid #6c757d;
        }

        .card-icon {
            font-size: 24px;
        }
        
        .iconBox {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            background-color: aliceblue;
            border-radius: 50%;
        }
        .card-icon
        {
            color: black;
            width: 30px;
            height: 30px;
        }
        .card:hover { 
            /* jquery */
            transform: scale(1.05);
            transition: transform 0.3s;
        }


        
        .Intervention {
            margin-top: 40px;
            
        }

        .table {
            border-radius: 10px;
        }

        .conntainer {
            font-family: "Montserrat", sans-serif;
        }

        .table {
            border-radius: 5px;
            overflow: hidden;
        }

        .table th,.table td {
            padding: 16px;
        }
    </style>
</head>
<!--============================================ HTML ==============================================================
    ==============================================================================================================-->
<body>
    <div id="Analysis">
        <div class="header text-center">
            <h2>Analysis</h2>
        </div>

        <div class="container d-flex flex-column align-items-center">
            <form action="" method="post" class="w-100">
                <input type="hidden" name="form_type" value="Analysis">
                <div class="form-group mb-3">
                    <label for="dateInput">Date :</label>
                    <input type="date" class="form-control" id="dateInput" name="Date" placeholder="" required>
                </div>
                <div class="d-grid gap-2 col-7 mx-auto">
                    <button type="submit" class="btn btn-danger btn-lg">Submit</button>
                </div>
            </form>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card bg-info text-light text-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="iconBox mb-2">
                            <ion-icon name="receipt-outline" class="card-icon"></ion-icon>
                        </div>
                        <h4 class="card-title">Interventions</h4>
                        <h2 class="card-subtitle"><?php echo $nbrIntervention ; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card bg-success text-light text-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="iconBox mb-2">
                            <ion-icon name="construct-outline" class="mr-2 card-icon"></ion-icon>
                        </div>
                        <h4 class="card-title">Maintenance</h4>
                        <h2 class="card-subtitle"><?php echo $nbrMaintenance ; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card bg-danger text-light text-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="iconBox mb-2">
                            <ion-icon name="lock-closed-outline" class="mr-2 card-icon"></ion-icon>
                        </div>
                        <h4 class="card-title">Security</h4>
                        <h2 class="card-subtitle"><?php echo $nbrSecurity ; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card bg-warning text-light text-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="iconBox mb-2">
                            <ion-icon name="people-outline" class="mr-2 card-icon"></ion-icon>
                        </div>
                        <h4 class="card-title">Support</h4>
                        <h2 class="card-subtitle"><?php echo $nbrSupport ; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="Intervention">
            <div class="tableheader">
                <h2>Intervention</h2>
            </div>
            <div>
                <table class="table table-hover ">
                <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Division</th>
                            <th>Status</th>
                            <th>Type Of Work</th>
                            <th>Rapport</th>
                        </tr>
                    </thead>
                    <tbody>

            <?php
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $status = ($row["Status"] === "Completed") ? "text-primary fs-5" : "text-danger fs-5";
                    $ID= $row['InterventionID'];
                    echo "<tr>
                            <td>{$row['Reference']}</td>
                            <td>{$row['Division']}</td>
                            <td>{$row['TypeOfWork']}</td>
                            <td><span class=\"$status\">{$row['Status']}</span></td>
                            <td>
                                <div class='row justify-content-center w-100'>
                                    <div class='col-md-3'>
                                        <form action='pages/View.php' method='GET' target='_blank' >
                                            <input type='hidden' name='ID' value='$ID'>
                                            <button type='submit' class='btn btn-warning'>View</button>
                                        </form>
                                    </div>
                                    <div class='col-md-3'>
                                        <form action='pages/Download.php' method='GET'>
                                            <input type='hidden' name='ID' value='$ID'>
                                            <button type='submit' class='btn btn-info'>Download</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                          </tr>";
                        
                }
            } else {
                echo "<tr><td colspan='5'>No recent interventions found.</td></tr>";
            }
            ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
    });

    </script>
</body>

</html>
