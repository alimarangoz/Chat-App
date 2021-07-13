<?php
    session_start();
    require_once "config.php";
    $sql = mysqli_query($conn,"select * from users");
    $output = "";
    if(mysqli_num_rows($sql) == 1){
        $output = "No users are available to chat";
    }else if(mysqli_num_rows($sql) > 0){
        include "data.php";
    }
echo $output;

?>
