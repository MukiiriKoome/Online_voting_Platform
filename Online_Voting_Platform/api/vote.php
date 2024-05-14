<?php
    session_start();
    include("connect.php");

    $votes=$_POST['gvotes'];
    $total_votes=$votes+1;
    $gid=$_POST['gid'];
    $uid=$_SESSION['userdata']['id'];

    $sql="UPDATE user_data set votes ='$total_votes' where id='$gid'";
    $update_votes=mysqli_query($conn,$sql);
    $sql1="UPDATE user_data set status=1 where id='$uid'";
    $update_user_status=mysqli_query($conn,$sql1);

    if($update_votes and $update_user_status){
        
        $groups = mysqli_query($conn, "SELECT * from user_data where role=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
        $_SESSION['groupsdata'] = $groupsdata;
        $_SESSION['userdata']['status'] =1;
        echo "
        <script>
            window.location='welcome.php';
        </script>";

    }
    else{
        header("location:login.php");
    }

?>