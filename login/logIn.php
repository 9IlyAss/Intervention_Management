<?php
session_start();
include("../dbconn.php");

$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email=$_POST["Email"];
    $Password=$_POST["Password"];
    
    $sql="SELECT Name,Email,Password,UserID FROM User WHERE Email= ? ;";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$Email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows===0)
        {
            $message="The Email doesn't Exist!";
        }
    else
        {
            $stmt->bind_result($dbName, $dbEmail, $dbPassword,$dbUserID);
            $stmt->fetch();
            if($Password != $dbPassword)
                {
                    $message="The Password is Incorrect !";
                    
                }
            else
                {
                    $_SESSION["Email"] = $dbEmail;
                    $_SESSION["Name"] = $dbName;
                    $_SESSION["ID"]=$dbUserID;
                    header("Location: ../index.php");
                    exit();
                }
            
        }
        $stmt->close();
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
    <style>
        
    </style>
    <title>Login</title>
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
            <div class="card-body text-center">
                <h3 class="card-title mb-5">Login</h3>
                <?php if (!empty($_SESSION['message']) ): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['message'];
                            unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($message) ): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $message; ?>
                        <?php $message= ''; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post" autocomplete="off">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Email" name="Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="Password" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="ForgetPass.php" class="small">Forgotten password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                </form>
                <div class="mt-3">
                    <p>Don't have an account? <a href="SignUp.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="/jquery/jquery-3.7.1.min.js"></script>
    
</body>
</html>
