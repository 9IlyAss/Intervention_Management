<?php
include("../dbconn.php");
session_start();

// nbrIntervention
        $sql = "SELECT COUNT(*) as nbr FROM Intervention";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nbrIntervention = $row['nbr'];
        
// nbrAccount
        $sql = "SELECT COUNT(*) as nbr FROM User ;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nbrAccount = $row['nbr'];
//table ++++++++RapportType
        $sql="SELECT  Reference,Division,Status,TypeOfWork,Rapport,RapportType FROM Intervention
                WHERE UserID=? 
                ORDER BY InterventionID DESC LIMIT 5;";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("i",$_SESSION["ID"]);
        $stmt->execute();
        $result = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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

        /* ======================= Cards ====================== */
        .card {
            flex-direction: row;
            border-radius: 40px 40px 40px 40px;
        
            /* jquery */
            
        
        }
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }
        .iconBox {
            margin: 10px 10px 10px 10px;
            padding: 15px 8px 0px 12px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: aliceblue;
        }

        .card-icon {
            font-size: 50px;
        }

        .card-subtitle {

            padding-left: 10px;
            font-weight: bold;
        }

        /*============================================table=============================================*/

        



        .Recentintervention {
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

    <!--============================================ HTML ==============================================================
    ==============================================================================================================-->


    <div id="Home" class="container">
        <div class="header text-center .d-{flex} text-light">
            <h1>Welcome back <?php echo $_SESSION["Name"] ; ?></h1>
        </div>
        <?php if(isset($_SESSION["success"])): ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success !! </strong> Data uploaded successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
        <?php unset($_SESSION["success"]); ?>
        <?php endif; ?>
        
        <?php if(isset($_SESSION["failed"])): ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success !! </strong> Data uploaded successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
        <?php unset($_SESSION["success"]); ?>
        <?php endif; ?>



        <!-- ======================================== Cards ===========================================================
    =========================================================================================================== -->

        <div class="row justify-content-around">
            <div class="card col-md-5 bg-primary" style="width: 20rem;">
                <div class="iconBox">
                    <ion-icon name="receipt-outline" class="card-icon"></ion-icon>
                </div>
                <div class="card-body text-light">
                    <h4 class="card-title">Interventions</h4>
                    <h2 class="card-subtitle"><?php echo $nbrIntervention ; ?></h2>
                </div>
            </div>

            <div class="card col-md-5 bg-danger" style="width: 19rem;">
                <div class="iconBox ">
                    <ion-icon name="people-outline" class="card-icon"></ion-icon>
                </div>
                <div class="card-body text-light">
                    <h4 class="card-title">Accounts</h4>
                    <h2 class="card-subtitle"><?php echo $nbrAccount ; ?></h2>
                </div>
            </div>
        </div>


        <!-- ======================================== Tabel ===========================================================
    =========================================================================================================== -->
        <div class="Recentintervention">
            <div class="tableheader">
                <h2>Recent Intervention</h2>
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
                while ($row = $result->fetch_assoc())
            {
                $status = ($row["Status"] === "Completed") ? "text-primary fs-5" : "text-danger fs-5";
                echo "<tr>                        
                        <td>{$row['Reference']} </td>
                        <td> {$row['Division']} </td>
                        <td>{$row['TypeOfWork']} </td>
                        <td><span class=\"$status\">{$row['Status']}</span></td>
                        <td> <form action='Download.php' method='post'>
                                <input type='hidden' name='rapport' value='{$row['Rapport']}'>
                                <input type='hidden' name='rapporttype' value='{$row['RapportType']}'>
                                <button type='submit' class='btn btn-warning'>Download</button>
                            </form>
                        </td>
                        </tr>";
            }
            ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--============================================ JS ==============================================================
    ==============================================================================================================-->

</body>

</html>