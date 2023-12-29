<?php
    require_once("Login.php");
    session_start();       
    $meeting_id=$_GET["meeting_id"];
    $meeting_member=$_POST["member"];
    $chairman=$_POST["chairman"];
    $recoder=$_POST["recoder"];
    $chairman_speech=$_POST["chairman_speech"];
    $resolutions=$_POST["resolutions"];


    #出席人員
    foreach($meeting_member as $value)
        {
            $qry="SELECT `Account_ID` FROM `account` WHERE `Name`='$value';";
            $result = mysqli_query($sql,$qry);
            $row = mysqli_fetch_assoc($result);
            $ID=$row['Account_ID'];
            
            $qry="UPDATE `attendee` SET `Absence`= 1 WHERE `Meeting_ID` = $meeting_id AND `Account_ID` = $ID";
            mysqli_free_result($result);  
            $result = mysqli_query($sql,$qry);
                   
        }
    #會議記錄
    $meeting_qry="UPDATE `meeting` SET `chairperson`='$chairman',`note_taker`='$recoder',`chairperson_speech`='$chairman_speech' WHERE `Meeting_ID`= $meeting_id";
    mysqli_query($sql,$meeting_qry);

    #決議事項追蹤資料
    $track_info_exist_qry="SELECT * FROM `meeting` WHERE `Meeting_ID`=$meeting_id";
    $track_info_exist=mysqli_query($sql,$track_info_exist_qry);
    if(mysqli_num_rows($track_info_exist)>0){
        $report_update_qry="UPDATE `meeting` SET `Description/Decision`='$resolutions' WHERE `Meeting_ID`=$meeting_id";
        mysqli_query($sql,$report_update_qry);
    }
    else{
        $report_insert_qry="INSERT INTO `meeting`(`Description/Decision`) VALUES ('$resolutions');";
        mysqli_query($sql,$report_insert_qry);
    }

    header("Location: 會議記錄子系統.html");
?>