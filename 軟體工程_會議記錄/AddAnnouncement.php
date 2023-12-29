<?php
    require_once("Login.php");
    $meeting_id=$_GET["meeting_id"];
    $announcement_no=$_POST["no"];
    $content=$_POST["content"];
    $exist_qry="SELECT * FROM `announcement` WHERE `announcement_number`= $announcement_no  AND `Meeting_ID` = $meeting_id";
    $result=mysqli_query($sql,$exist_qry);
    if(mysqli_num_rows($result)>0){
        $update_qry="UPDATE `announcement` SET `content`='$content' WHERE `announcement_number`= $announcement_no AND `Meeting_ID` = $meeting_id";
        mysqli_query($sql,$update_qry);
    }
    else{
        $insert_qry="INSERT INTO `announcement` VALUES ($announcement_no,$meeting_id,'$content');";
        mysqli_query($sql,$insert_qry);
    }
    header("Location: 紀錄編輯會議2.php?meeting_id= $meeting_id");
?>