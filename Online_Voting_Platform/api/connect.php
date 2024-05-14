<?php
    $server="localhost";
    $username="root";
    $password="";
    $database="users2";
    $conn=mysqli_connect($server,$username,$password,$database);
    if($conn){
        //echo "connection successfully";
    }
    else{
        echo "Connection failed due to".mysqli_connect_error($conn);
        die("Connection failed");
    }

?>