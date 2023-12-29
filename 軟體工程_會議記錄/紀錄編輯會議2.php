<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"></meta>
    <title>高雄大學資訊工程系會議管理系統</title>
    <link rel="stylesheet" href="上方工具及標題.css" href="會議資料.css"/>
</head>
<body>
    <header class="home">
        <img src="CSIE.jpg" width="50" height="50" style="float: left;">
        <h1><a href="首頁.php">&nbsp高雄大學資訊工程系會議管理系統</a></h1>
    </header>
    <nav>
        <ul class="flex-nav">
            <li><a href="新增會議.php">新增會議</a></li>
            <li><a href="紀錄編輯會議.php">紀錄/編輯會議</a></li>
            <li><a href="歸檔.html">歸檔</a></li>
        </ul>
    </nav>
    <br>
    <?php 
            require_once("Login.php");
            $meeting_id=$_GET["meeting_id"]; 
    ?>
    <form action="RecordMeeting.php?meeting_id=<?php echo $meeting_id ?>" method="post">
        <?php
                $meeting_qry="SELECT * FROM `meeting` WHERE `Meeting_ID`= $meeting_id";
                $meeting_result = mysqli_query($sql,$meeting_qry);
                $meeting=mysqli_fetch_assoc($meeting_result);

                $discussion_qry="SELECT * FROM `agenda` WHERE `Meeting_ID`= $meeting_id";
                $discussion_result = mysqli_query($sql,$discussion_qry);
                $discussion=mysqli_fetch_assoc($discussion_result);
                
                $report_qry="SELECT * FROM `announcement` WHERE `Meeting_ID`=$meeting_id";
                $report_result = mysqli_query($sql,$report_qry);
                $report=mysqli_fetch_assoc($report_result);

        ?>
        <p>主席&nbsp&nbsp<input type="text" name=chairman value=<?php echo $meeting["Chairperson"]?>></p>
        <p>紀錄人員&nbsp&nbsp<input type="text" style="width:130px;" name=recoder value=<?php  echo $meeting["note_taker"]?>></p>
        <p>出席人員：</p>
        <?php
            $member = "SELECT `Name` FROM `account` NATURAL JOIN `attendee`WHERE `Meeting_ID` = $meeting_id";
            if(!$result = mysqli_query($sql,$member)){
                echo "Failed.\n";
                echo "Error:" . mysqli_error($sql);
            }
            else{
                if (mysqli_num_rows($result)>0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $datas[] = $row;
                    }
                }
                mysqli_free_result($result);
            }
        ?>
        <?php if(!empty($datas)): ?>
            <?php foreach ($datas as $key => $row) :?>
                <input type="checkbox" name="member[]"value="<?php echo $row['Name']?>"><?php echo $row['Name']?>
                <?php if(($key+1)%5==0&&$key>1):?></br>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else:  ?>
            <?php echo "查無資料";?>
        <?php endif; ?>
        <p>主席致詞</p><textarea style="width:600px;height:200px;" name=chairman_speech><?php  echo $meeting["chairperson_speech"]?></textarea>
        <hr/>


        <h2><a href="新增臨時動議.php?meeting_id=<?php echo $meeting_id; ?> &extempore_number=0">新增臨時動議</a></h2>
            
            <?php 
            // $qry = "SELECT `extempore_number` FROM `extempore` WHERE `Meeting_ID`=$meeting_id";
            // $result = mysqli_query($sql,$qry);
            // if(!$result == mysqli_query($sql,$qry)){
            //     echo "Failed.\n";
            //     echo "Error:" . mysqli_error($sql);
            // }
            // else {
            //     if(mysqli_num_rows($result)>0){
            //         while ($row = mysqli_fetch_assoc($result)) {
            //             $datas[] = $row;
                      
            //         }
            //     }
            // }
            // if(!empty($datas)):
            //     foreach ($datas as $key => $value):?>
                    <!-- <h2><a href="新增臨時動議.php?meeting_id=<?php //echo $meeting_id; ?> & extempore_number=<?php //echo $value['extempore_number'];?>"><?php //echo $value['extempore_number'];?></a></h2> -->
                <?php //endforeach;?>
            <?php //endif;?>
            
        <hr/>


        <h2><a href="新增報告事項.php?meeting_id=<?php echo $meeting_id; ?> & announcement_number=0">新增報告事項</a></h2>
            <?php 
                // $qry = "SELECT `announcement_number` FROM `announcement` WHERE `Meeting_ID`=$meeting_id";
                // $result = mysqli_query($sql,$qry);
                // if(!$result == mysqli_query($sql,$qry)){
                //     echo "Failed.\n";
                //     echo "Error:" . mysqli_error($sql);
                // }
                // else {
                //     if(mysqli_num_rows($result)>0){
                //         while ($row = mysqli_fetch_assoc($result)) {
                //             $datas[] = $row;
                //         }
                //     }
                // }
                // if(!empty($datas)):
                //     foreach ($datas as $key => $row):?>
                        <!-- <h2><a href="新增報告事項.php?meeting_id=<?php //echo $meeting_id; ?> & announcement_number=<?php //echo $row['announcement_number'];?>"><?php //echo $row['announcement_number'];?></a></h2> -->
                    <?php //endforeach;?>
                <?php //endif;?>
        <hr/>


        <h2><a href="新增討論事項.php?meeting_id=<?php echo $meeting_id; ?> & agenda_number=0">新增討論事項</a></h2>
        <?php 
            // $qry = "SELECT `agenda_number` FROM `agenda` WHERE `Meeting_ID`=$meeting_id";
            // $result = mysqli_query($sql,$qry);
            // if(!$result == mysqli_query($sql,$qry)){
            //     echo "Failed.\n";
            //     echo "Error:" . mysqli_error($sql);
            // }
            // else {
            //     if(mysqli_num_rows($result)>0){
            //         while ($row = mysqli_fetch_assoc($result)) {
            //             $datas[] = $row;
            //         }
            //     }
            // }
            // if(!empty($datas)):
            //     foreach ($datas as $key => $row):?>
                    <!-- <h2><a href="新增討論事項.php?meeting_id=<?php //echo $meeting_id; ?> & agenda_number=<?php //echo $row['agenda_number'];?>"><?php //echo $row['agenda_number'];?></a></h2> -->
                <?php //endforeach;?>
            <?php //endif;?>
        <hr/>


        <h2>決議事項追蹤資料：</h2>
            <p>決議事項</p><textarea style="width:600px;height:200px;" name=resolutions><?php  echo $meeting["Description/Decision"]?></textarea>
        <button type ="submit">儲存</button>
    </form>
</body>
    
</html>