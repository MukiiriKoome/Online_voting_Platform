<?php
    session_start();
    $otp=rand(10000,99999);
    $_SESSION['otp']=$otp;
    $email=$_POST['email'];
    $receiver="$email";
    $subject="Message through localhost";
    $body="your otp no. is $otp";
    $sender="From:amarnathjnp2002@gmail.com";
    if(mail($receiver,$subject,$body,$sender)){
        //echo "Email sent successfully to $receiver";
    }else{
        echo "Sorry , failed while sending mail";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify otp</title>
    <link rel="stylesheet" href="../css/style_otp.css">
</head>
<body>
<img src="../picture/OVM_7.png" alt="Online Voting Machine" class="ovm">
    <br><br><br><br><h1>Online Voting System</h1>
    <center><form action="otp_2.php" method="post">
        <input type="number" name="otp" placeholder="Enter your 5 digit OTP code"><br><br>
        <input type="submit" id="btn" value="Varify OTP">
    </form></center>
</body>
</html>
