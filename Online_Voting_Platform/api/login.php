<?php
session_start();
include("connect.php");
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];
$aadhar = $_POST['aadhar'];
$sql = " SELECT * FROM user_data where mobile='$mobile' and role='$role' and aadhar='$aadhar'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
$login = false;
if ($num > 0){
    $userdata = mysqli_fetch_array($result);
    if(password_verify($password, $userdata['password'])){
          $groups = mysqli_query($conn, "SELECT * from user_data where role=2");
          $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
          $_SESSION['groupsdata'] = $groupsdata;
          $_SESSION['userdata'] = $userdata;
          $_SESSION['loggedin'] = true;
          header("location:welcome.php");
        }else{
            echo '
          <script src="sweetalert.min.js"></script>
          <body>
              <script>
                  swal("Invalid Password!", "Please Check Your Password!", "info"); 
              </script>
          </body>';
          include "login.html";
        }
} 
else {
    echo '
          <script src="sweetalert.min.js"></script>
          <body>
              <script>
                  swal("Invalid Crendentials!", "Please Check Mobile No. and Password!", "info"); 
              </script>
          </body>';
          include "login.html";
    }
