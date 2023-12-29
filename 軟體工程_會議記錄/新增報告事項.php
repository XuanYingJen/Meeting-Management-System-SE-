<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="上方工具及標題.css"/>
    </head>
    <body>
    <?php $meeting_id=$_GET["meeting_id"]; ?>
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
        
        <form action="AddAnnouncement.php?meeting_id=<?php echo $meeting_id; ?>" method="post">
            <?php 
                require_once("Login.php");
                $announcement_number = $_GET["announcement_number"];
                $meeting_announcement="SELECT * FROM `announcement` WHERE `Meeting_ID`= $meeting_id AND `announcement_number` = $announcement_number";
                $meeting_result = mysqli_query($sql,$meeting_announcement);
                $result=mysqli_fetch_assoc($meeting_result);
            ?>
            <p>報告事項編號&nbsp&nbsp<input type="text" style="width:50px;" name=no value = <?php if($announcement_number != 0) echo $announcement_number; ?>></p>
            <p>報告內容</p>
            <textarea style="width:600px;height:200px;" name=content><?php if($announcement_number != 0) echo $result["content"]; ?></textarea>
            <input type ="button" onclick="location.href='紀錄編輯會議2.php?meeting_id=<?php echo $meeting_id; ?>'" value="返回"></input> 
           <button type ="submit">儲存</button>
        </form>

        
    </body>
</html>