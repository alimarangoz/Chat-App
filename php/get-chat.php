<?php
session_start();

if(isset($_SESSION["unique_id"])){
    require_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn,$_POST["outgoing_id"]);
    $incoming_id = mysqli_real_escape_string($conn,$_POST["incoming_id"]);

    $output = "";

    $sql = "select * from messages where (outgoing_msg_id = {$outgoing_id} and incoming_msg_id = {$incoming_id})
            or (outgoing_msg_id = {$incoming_id} and incoming_msg_id = {$outgoing_id}) order by msg_id desc";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){ //Sender
                $output = '<div class="chat outgoing">
                <div class="details">
                    <p>'.$row['msg'].'</p>
                </div>
            </div>';
            }else{ //Receiver
                $output = '<div class="chat incoming">
                <img src="php/image/img.png" alt="">
                <div class="details">
                    <p>'.$row['msg'].'</p>
                </div>
            </div>';
            }
        }
        echo $output;
    }
}else{
    header("location:../login.php");
}

?>
