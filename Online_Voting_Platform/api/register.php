<?php
session_start();
include("connect.php");
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];
$aadhar = $_POST['aadhar'];
$mail = $_POST['mail'];
$dob = $_POST['dob'];
$sql = " SELECT * FROM user_data where aadhar='$aadhar'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    echo '
        <script src="sweetalert.min.js"></script>
        <body>
            <script>
                swal("User Already Exist!", "You have to register again!", "error"); 
            </script>
        </body>';
    include "registration.html";
} else if ($dob >= 2004) {
    echo '
        <script src="sweetalert.min.js"></script>
        <body>
            <script>
                swal("NOT allowed", "You are not 18 years old", "error"); 
            </script>
        </body>';
    include "registration.html";
} 
else {
    if ($password == $cpassword) {
    $hashpass = password_hash($password, PASSWORD_DEFAULT);
    move_uploaded_file($tmp_name, "upload/$image");
    $sql = "INSERT INTO `user_data` (`name`, `mobile`, `password`, `address`, `photo`, `role`, `status`, `votes`,`aadhar`,`mail`) VALUES ('$name', '$mobile', '$hashpass', '$address', '$image', '$role', 0, 0,'$aadhar','$mail')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '
                <script src="sweetalert.min.js"></script>
                <body>
                    <script>
                        swal("Registration Successful!", "Now you can Login!", "success"); 
                    </script>
                </body>';
        include "login.html";
        $receiver = $mail;
        $subject = "Registration Successful";
        if ($role == 1) {
            $body = "Thanks,$name You has registered as a Voter";
        } else if ($role == 2) {
            $body = "Thanks,$name You has registered as a Group/Party";
        }
        $sender = "From:amarnathjnp2002@gmail.com";
        mail($receiver, $subject, $body, $sender);
    }
}
    else {
        echo '
            <script src="sweetalert.min.js"></script>
            <body>
                <script>
                    swal("Password do not match", "", "warning"); 
                </script>
            </body>';
        include "registration.html";
    }
}
