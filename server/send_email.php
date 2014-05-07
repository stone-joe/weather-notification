<?php

$con = mysqli_connect("mysql8.000webhost.com","a5581071_cities","weather156!","a5581071_cities");
if ( !$con ){
    echo "Could not create connection!";
    exit;
}
else {
    // Get all emails from the database and send them the current weather
    $sql = "SELECT `Email` FROM `users`";
    $result = mysqli_query($con,$sql);
    if ( !$result ){
        echo mysqli_error($con);
        exit;
    }
    else {
        $weather = json_decode(file_get_contents("weather.json"),true);
        $headers = "From: notify@weather.com\r\n";
        $headers .= "Reply-To:DO_NOT_REPLY\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";    
        $subject = "Daily Weather Notification";
        $message = file_get_contents("email.html");
        $message = str_replace("CURRENT_TEMP",$weather[0]."&deg;F",$message);
        $message = str_replace("HIGH_TEMP",$weather[1]."&deg;F",$message);
        $message = str_replace("LOW_TEMP",$weather[2]."&deg;F",$message);
        $message = str_replace("HUMIDITY",$weather[3]."%",$message);
        $message = str_replace("PRECIP_AMT",$weather[4]." inches", $message);
        $message = str_replace("WIND_SPD",$weather[5]." mph",$message);
        $message = str_replace("WIND_GUST",$weather[6]." mph",$message);
        while ( $row = mysqli_fetch_array($result) ){
            mail($row['Email'],$subject,$message,$headers);
        }
    }
}

mysqli_close($con);
?>