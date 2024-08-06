<?php
session_start();
include("../dbconn.php");

$message = '';
$style = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['dbEmail'];
    $newPassword = $_POST["New_Password"];
    $confirmPassword = $_POST["Confirm_Password"];

    if ($newPassword === $confirmPassword) {
        $sql = "UPDATE User SET Password = ? WHERE Email = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();
        $_SESSION['message'] = "Password updated successfully! ";
        header("Location: logIn.php");

    } else {
        $message = "Passwords do not match!";
        $style = "danger";
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

    <title>Reset Password</title>
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
            <div class="card-body text-center mb-5">
                <h3 class="card-title mb-3">Reset Your Password</h3>
                <form action="" method="post">
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?php echo $style; ?> mt-3" role="alert">
                            <?php echo $message; 
                            $message=''?>
                        </div>
                    <?php endif; ?>
                        
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" placeholder="New Password" name="New_Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm_Password" required>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="acceptChange" required>
                        <label class="form-check-label" for="acceptChange">I Accept The Change Of Password</label>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block mt-3">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
