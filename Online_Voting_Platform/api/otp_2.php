<?php
    session_start();
    $otp = $_POST['otp'];
    if($otp==$_SESSION['otp']){
        echo '
        <script src="sweetalert.min.js"></script>
        <body>
            <script>
                swal("Varification Successful", "Now your registration process is started", "success"); 
            </script>
        </body>';
        include "registration.html";
    }else{
        echo '
        <script src="sweetalert.min.js"></script>
        <body>
            <script>
                swal("OTP not match", "Please enter OTP No. again", "error"); 
            </script>
        </body>';
        include "otp.php";
    }
?>
