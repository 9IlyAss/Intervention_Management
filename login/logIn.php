<?php
session_start();
include("/dbonn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email=$_POST["Email"];
    $Password=$_POST["Password"];
    
    $sql="SELECT Name,Email,Password FROM User WHERE Email= ? ;";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$Email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows===0)
        {
            echo "<script>
                $(document).ready(function() {
                    $('.form-group:first').before('<div class=\"alert alert-danger\" role=\"alert\">The Email doesn\'t Exist!</div>');
                });
              </script>";
            $stmt->close();
            exit();
        }
    else
        {
            $stmt->bind_result($dbName, $dbEmail, $dbPassword);
            $stmt->fetch();
            if($Password != $dbPassword)
                {
                    echo "<script>
                            $(document).ready(function() {
                                $('.form-group:first').before('<div class=\"alert alert-danger\" role=\"alert\">The Password is Incorrect !</div>');
                            });
                        </script>";

                    exit();
                }
            else
                {
                    $_SESSION["Email"] = $Email;
                    $_SESSION["Name"] = $dbName;
                    header("Location: /index.php");
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
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="/Img/BSRIQZ-01.png">
    
    <title>Login</title>
</head>
<body>
    
    <div class="img ml-4">
        <img src="/Img/OIP-removebg-preview.png">
    </div>
    
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 22rem;">
            <div class="card-body text-center">
                <h3 class="card-title mb-5">Login</h3>
                <form action="" method="post">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Email" name="Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="Password" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="ForgetPass.html" class="small">Forgotten password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                </form>
                <div class="mt-3">
                    <p>Don't have an account? <a href="SignUp.html">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="/jquery/jquery-3.7.1.min.js"></script>
    
</body>
</html>
