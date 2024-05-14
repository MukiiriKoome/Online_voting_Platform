<?php
session_start();
if ($_SESSION['loggedin'] == false) {
    header("location:login.html");
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
if ($_SESSION['userdata']['status'] == 0) {
    $status = '<b style="color:red">Not Voted</b>';
} else {
    $status = '<b style="color:green">Voted</b>';
    $receiver=$userdata['mail'];
    $subject="Thanks for Voting";
    $body="Thanks to giving your valuable vote and time";
    $sender="From:amarnathjnp2002@gmail.com";
    mail($receiver,$subject,$body,$sender);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Voting System</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stylewel.css">
    <style>
        
    </style>
</head>

<body>
    <img src="../picture/OVM_3.png" alt="Online Voting Machine" class="ovm"><br>
    <button class="btn"><a href="login.html">Back</a></button>
    <button class="btn" id="logout"><a href="logout.php"> logout</a></button>
    <h1>Online Voting System</h1><br><br>
    <hr>
    <div id="profile">
        <center><img src="upload/<?php echo $userdata['photo']; ?>" height="150px"></center>
        Name:<b><?php echo $userdata['name']; ?></b>
        Mobile:<b><?php echo $userdata['mobile']; ?></b>
        Address:<b><?php echo $userdata['address']; ?></b>
        Status:<b><?php echo $status; ?></b>
    </div>
    <div id="group">
        <?php
        if ($_SESSION['loggedin'] == true) {
            for ($i = 0; $i < count($groupsdata); $i++) {
        ?>
            <div class="gcontainer">
                <img src="upload/<?php echo $groupsdata[$i]['photo']; ?>" height="125px">
                Group Name: <b><?php echo $groupsdata[$i]['name']; ?></b>
                Votes: <b><?php echo $groupsdata[$i]['votes'] ?></b>
                <form action="vote.php" method="POST">
                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                    <?php
                    if ($_SESSION['userdata']['status'] == 0) {
                    ?>
                        <input type="submit" value="vote" id="votebtn" name="votebtn">
                    <?php
                    } else {
                        echo '
                            <script src="sweetalert.min.js"></script>
                            <body>
                                <script>
                                    swal("Thanks for Voting!", "Now you can Logout!", "success"); 
                                </script>
                            </body>'
                    ?>
                        <button disabled type="submit" name="votebtn" id="voted">Voted</button>
                    <?php
                    }
                    ?>
                </form>
                <hr>
            </div>
        <?php
            }
        }
        ?>
    </div>

</body>

</html>