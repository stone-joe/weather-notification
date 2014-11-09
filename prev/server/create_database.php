<?php

$con = mysqli_connect("server","user","pass","db");
if ( !$con ){
    echo "Could not create connection!";
    exit;
}

$files = glob("./codes/*.txt");
$count = 0;
for ( $i = 0, $n = count($files); $i < $n; $i++ ){
    $data = explode("\n",file_get_contents($files[$i]));
    for ( $j = 0, $m = count($data); $j < $m; $j++ ){
        $geo = explode("|",$data[$j]);
        // We need 1 - city, 8 - state, 12 - lat, 13 - lon
        // Check for existence
        if ( $geo[13] == "" || $geo[12] == "" || $geo[8] == "" || $geo[1] == "" )
            continue;
        $sql = "SELECT `City_ID` FROM `cities` WHERE `Min_Lat` = " 
            . $geo[12] . " AND `Min_Lon` = " . $geo[13];
        $sql = mysqli_real_escape_string($con, $sql);
        $result = mysqli_query($con,$sql);
        if ( !$result ){
            echo "Error! " . mysqli_error($con);
            exit;
        }
        else {
            if ( mysqli_num_rows($result) == 0 ){
                // It doesn't exist...insert it!
                $city = str_replace("'","\'",$geo[1]);
                $insert = "INSERT INTO `cities` (`Min_Lat`,`Min_Lon`,`Name`) VALUES (" . $geo[12] . ", " . $geo[13] . ", '".$city.",".$geo[8]."')";
//                $insert = mysqli_real_escape_string($con,$insert);
                $result_in = mysqli_query($con,$insert);
                if ( !$result_in ){
                    echo "Error!: " . mysqli_error($con);
                    exit;
                }
            }
        }
    }
    $count++;
    echo "$count file: ". $files[$i]."inserted!<br/>";
}
mysqli_close($con);

?>