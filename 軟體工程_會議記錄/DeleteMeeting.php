<?php 
    require_once("Login.php");
    $meeting_id=$_GET["meeting_id"];
    $qry="DELETE FROM `agenda` WHERE `Meeting_ID`= $meeting_id";
    mysqli_query($sql,$qry);
    $qry="DELETE FROM `announcement` WHERE `Meeting_ID`= $meeting_id";
    mysqli_query($sql,$qry);
    $qry="DELETE FROM `extempore` WHERE `Meeting_ID`= $meeting_id";
    mysqli_query($sql,$qry);
    $qry="DELETE FROM `attendee` WHERE `Meeting_ID`= $meeting_id";
    mysqli_query($sql,$qry);
    $qry="DELETE FROM `Meeting` WHERE `Meeting_ID`= $meeting_id";
    mysqli_query($sql,$qry);

    header("Location: 紀錄編輯會議.php");
?>