<?php
    require_once("Login.php");
    $meeting_id = $_POST["id"];
    $meeting_name = $_POST["name"];
    $meeting_type = $_POST["category"];
    $meeting_datetime = $_POST["date"]." ".$_POST["time"].":00";
    $meeting_location = $_POST["location"];

    $number=$_POST["num"];
    $reason=$_POST["reason"];
    $explain=$_POST["explain"];

    $meeting_member=$_POST["member"];

    try{
        $qry = "INSERT INTO `meeting`(/*`Meeting_ID`,*/`Name`,`type`,`Date`,`location`) VALUES (/*$meeting_id,*/'$meeting_name','$meeting_type','$meeting_datetime','$meeting_location')";
        $result = mysqli_query($sql,$qry);
        $qry = "SELECT LAST_INSERT_ID()";
        $meeting_id = mysqli_query($sql,$qry);
        $result = mysqli_fetch_array($meeting_id,MYSQLI_NUM);
        $meeting_id = intval($result[0]);
        $qry = "UPDATE `agenda`SET`agenda_number`=$number,`proposer`=1,`Content`='$reason',`Description`='$explain' WHERE `Meeting_ID` = $meeting_id";
        $result = mysqli_query($sql,$qry);
        
        foreach($meeting_member as $value)
        {
            $qry="SELECT `Account_ID` FROM `account` WHERE `Name`='$value';";
            $result = mysqli_query($sql,$qry);
            $row = mysqli_fetch_assoc($result);
            $ID=$row['Account_ID'];
            
            $qry="INSERT INTO `attendee`(`Meeting_ID`,`Account_ID`) VALUES('$meeting_id','$ID')";
            mysqli_free_result($result);  
            $result = mysqli_query($sql,$qry);
                   
        }
        
        header("Location:會議記錄子系統.html");
    }
    catch (PDOException $e){
        die("新增失敗");
    }
    
?>