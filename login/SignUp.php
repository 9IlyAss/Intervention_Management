<?php
session_start();
include("../dbconn.php");

$message = '';
$style = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $ConfirmPassword = $_POST["Confirmpassword"];
    
    if ($Password != $ConfirmPassword) {
        $message = "Passwords do not match!";
        $style = "danger";
    } else {
        $sql = "SELECT Email FROM User WHERE Email=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = "The Email Already Exists!";
            $style = "danger";
        } else {
            $sql = "INSERT INTO User (Name, Email, Password,ResCode) VALUES (?, ?, ?, 99999);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $Name, $email, $Password);
            $stmt->execute();
            $message = "You have successfully signed up! <a href='login.php' class='alert-link'>Click here to log in</a>";
            $style = "warning";
        }
        $stmt->close();
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
    <title>Sign Up</title>
    <style>
        .imgc {
            width: 100px;
            height: auto;
            right: 46%;
        }
        .c{
            padding-bottom:63px;
        }
    </style>
</head>
<body>
    
<div class="c">
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
                <h3 class="card-title mb-5">Sign Up</h3>
                <form action="" method="post">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $style; ?> mt-3" role="alert">
                        <?php echo $message; ?>
                        <?php
                        $message= '';
                        $style = '';
                        ?>
                    </div>
                <?php endif; ?>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Name" name="Name" required>
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
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </div>
                
            </div>
        </div>
    </div>
    <script src="../jquery/jquery-3.7.1.min.js"></script>
</body>
</html>
