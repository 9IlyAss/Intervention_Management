<?php
include("/dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST["Email"];
    $Name=$_POST["Name"];
    $Password=$_POST["Password"];
    $ConfirmPassword=$_POST["Confirmpassword"];
    
    if($Password!=$ConfirmPassword)
        {
            echo "<script>
                        $(document).ready(function() {
                            $('.form-group:first').before('<div class=\"alert alert-danger\" role=\"alert\">Passwords do not match !</div>');
                        });
                    </script>";
            exit();
        }
    $sql="SELECT Email FROM User Where Email=? ;";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
        if($stmt->num_rows>0)
            {
                echo "<script>
                        $(document).ready(function() {
                            $('.form-group:first').before('<div class=\"alert alert-danger\" role=\"alert\">The Email Alredy Exist !</div>');
                        });
                    </script>";
                $stmt->close();
                exit();
            }
            else
            {
                $sql="INSERT INTO User (Name,Email,Password) VALUES (?, ?, ?);";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("sss",$Name,$email,$Password);
                $stmt->execute();
                    echo "<script>
                        $(document).ready(function() {
                            $('.form-group:first').before('<div class=\"alert alert-success\" role=\"alert\" >You have successfully signed up! <a href=\"login.php\" class=\"alert-link\">Click here to log in</a></div>');
                        });
                    </script>";
                $stmt->close();
            }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <title>Sign Up</title>
</head>
<body>
    
    <div class="img ml-4">
        <img src="/Img/OIP-removebg-preview.png">
    </div>
    
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 22rem;">
            <div class="card-body text-center">
                <h3 class="card-title mb-5">Sign Up</h3>
                <form action="" method="post">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Name"  name="Name" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="email" class="form-control" placeholder="Email" name="Email" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" placeholder="Password" name="Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="Confirmpassword" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
                </form>
                <div class="mt-3">
                    <p>Already have an account? <a href="login.html">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="/jquery/jquery-3.7.1.min.js"></script>
    <script>
        
    </script>
</body>
</html>
