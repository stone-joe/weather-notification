<?php

if ( !isset($_GET['email']) || $_GET['email'] == '' ){
    echo "Email is required";
    exit;
}
else {
    $con = mysqli_connect("mysql8.000webhost.com","a5581071_cities","weather156!","a5581071_cities");
    if ( !$con ){
        echo "Could not create connection!";
        exit;
    }
    $email = mysqli_real_escape_string($con,strip_tags($_GET['email']));
    $check = "SELECT `ID` FROM `users` WHERE `Email`='".$email."'";
    $result = mysqli_query($con,$check);
    if ( !$result ){
        echo mysqli_error($con);
        exit;
    }
    else {
        if ( mysqli_num_rows($result) == 0 ){
            // Insert them into the database
            $insert = "INSERT INTO `users` (`Email`) VALUES ('$email')";
            $result = mysqli_query($con,$insert);
            if ( !$result ){
                echo mysqli_error($con);
                exit;
            }
            else {
                echo "Email saved";
            }
        }
    }
}
mysqli_close($con);
?>