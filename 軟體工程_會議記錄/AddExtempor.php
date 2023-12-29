<?php
    require_once("Login.php");
    session_start();
    $meeting_id=$_GET["meeting_id"];
    $discussion_no=$_POST["no"];
    $reason=$_POST["reason"];
    $explain=$_POST["explain"];
    $resolution_content=$_POST["resolution_content"];
    $exist_qry="SELECT * FROM `extempore` WHERE `extempore_number`= $discussion_no AND `Meeting_ID` = $meeting_id";
    $result=mysqli_query($sql,$exist_qry);
    if(mysqli_num_rows($result)>0){
        $update_qry="UPDATE `extempore` SET `content`='$reason',`description`='$explain',`decision`='$resolution_content' WHERE `extempore_number`= $discussion_no AND `Meeting_ID` = $meeting_id;";
        mysqli_query($sql,$update_qry);
    }
    else{
        $insert_qry="INSERT INTO `extempore` VALUES ($discussion_no,$meeting_id,'$reason','$explain','$resolution_content',1);";
        mysqli_query($sql,$insert_qry);
    }
    header("Location: 紀錄編輯會議2.php?meeting_id= $meeting_id");
?>