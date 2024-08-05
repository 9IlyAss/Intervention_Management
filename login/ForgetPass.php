<?php
session_start();
include("../dbconn.php");
require __DIR__ . '/../Mail/vendor/autoload.php';
use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;


$message = '';
$style = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];

    $sql = "SELECT Email FROM User WHERE Email=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        $message = "The Email Doesn't Exist!";
        $style = "danger";
    } else {
        $verificationCode = rand(100000, 999999);
        $_SESSION["Email"]=$email;
        $sql = "UPDATE User SET ResCode = ? WHERE Email = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $verificationCode, $email);
        $stmt->execute();
        $message = "Verification code sent successfully!";
        $style = "success";
        

        $sql = "SELECT Name,ResCode  FROM User WHERE Email = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($dbname,$dbCod);
        $stmt->fetch();

        $mailersend = new MailerSend(['api_key' => 'mlsn.5d2f6963a75fc0638f0fccaa5566e9f2f43778ccfb6b94d549720a6ffbcaae92']);
        $personalization = [
            new Personalization($email, [
                    'name' => $dbname,
                    'password' => $dbCod,
                    'account_name' => 'Intervention Managment Support',
                    'support_email' => 'ilyassovitche1234@gmail.com'
            ])
        ];
        
        $recipients = [
            new Recipient($email, $dbname),
        ];
        
        $emailParams = (new EmailParams())
            ->setFrom('info@trial-3vz9dlewppplkj50.mlsender.net')
            ->setFromName('Intervention Managment Support')
            ->setRecipients($recipients)
            ->setSubject('Verification Code')
            ->setTemplateId('3z0vklorwypl7qrx')
            ->setPersonalization($personalization);
        
        $mailersend->email->send($emailParams);
        $_SESSION["dbEmail"]=$email;
        $_SESSION["timeout"]=time();
        header("Location: ResetPass.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 22rem;">
            <div class="card-body text-center mb-3">
                <h3 class="card-title mb-5">Forgot Password</h3>
                <form action="" method="post">
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?php echo $style; ?> mt-3" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group mb-2">
                        <input type="email" class="form-control" name="Email" placeholder="Email" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block mt-3">Send Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
