<?php
    require_once("Login.php");
    session_start();
    $meeting_id=$_GET["meeting_id"];
    $agenda_no=$_POST["no"];
    $reason=$_POST["reason"];
    $explain=$_POST["explain"];
    $resolution_content=$_POST["resolution_content"];
    $exist_qry="SELECT * FROM `agenda` WHERE `agenda_number`= $agenda_no AND `Meeting_ID` = $meeting_id";
    $result=mysqli_query($sql,$exist_qry);
    if(mysqli_num_rows($result)>0){
        $update_qry="UPDATE `agenda` SET `Content`='$reason',`Description`='$explain',`Decision`='$resolution_content' WHERE `agenda_number`= $agenda_no AND `Meeting_ID` = $meeting_id;";
        mysqli_query($sql,$update_qry);
    }
    else{
        $insert_qry="INSERT INTO `agenda` VALUES ($meeting_id,'$reason',1,'$explain',$agenda_no,'$resolution_content');";
        mysqli_query($sql,$insert_qry);
    }
    header("Location: 紀錄編輯會議2.php?meeting_id= $meeting_id");
?>