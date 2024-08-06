<?php
session_start();
include("../dbconn.php");


$message = '';
$style = '';
$currenttime=time();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($currenttime - $_SESSION["timeout"]) > 18000)
    {
        $message = "You can only request a new email every 5 hours.";
        $style = "danger";
    }
    else
    {
        $sql = "SELECT ResCode  FROM User WHERE Email = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION["dbEmail"]);
        $stmt->execute();
        $stmt->bind_result($dbCode);
        $stmt->fetch();

        $verification = $_POST["Verification_Code"];
        if ($dbCode==$verification) {
            header("Location: ChangePass.php");
            exit();
        } else {
            $message = "Invalid verification code!";
            $style = "danger";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="logIn.css">
    <link rel="icon" href="../Img/image.png" sizes="32x32 64x64 128x128" type="image/png" >
    <title>Verify Your Code</title>
</head>
<body>
<div class="pb-5">
        <div class="imgr">
            <img src="../Img/OIP-removebg-preview.png">
        </div>
        <div class="imgc">
            <img src="../Img/62f6d31b45aa26e8ff54f13d90dfd489.png">
        </div>
        <div class="imgl">
            <img src="../Img/شسشس-01.png">
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 22rem;">
            <div class="card-body text-center mb-3">
                <h3 class="card-title mb-5">Verify Your Code</h3>
                <form action="" method="post">
                <?php if (isset($_SESSION["Verification"])): ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            <?php echo $_SESSION["Verification"];
                            unset($_SESSION["Verification"]); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?php echo $style; ?> mt-3" role="alert">
                            <?php echo $message; 
                            $message='';?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group mb-2">
                        <input type="text" name="Verification_Code" class="form-control" placeholder="Verification Code" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
