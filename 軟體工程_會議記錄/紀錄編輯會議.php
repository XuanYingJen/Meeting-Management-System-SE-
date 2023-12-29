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
    <table align="center" border="1" width="600" cellpadding="2">
        <?php
            require_once("Login.php");
            $qry = "SELECT `Date`,`Name`,`Meeting_ID` FROM `meeting` ORDER BY `Date` DESC";
            $result = mysqli_query($sql,$qry);
            if(!$result = mysqli_query($sql,$qry)){
                echo "Failed.\n";
                echo "Error:" . mysqli_error($sql);
            }
            else {
                if(mysqli_num_rows($result)>0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $datas[] = $row;
                    }
                }
            }
            if(!empty($datas)):
        ?>
        <tr>
            <td>會議編號</td>
            <td>日期</td>
            <td>會議名稱</td>
            <td>刪除會議</td>
        </tr>
        <?php foreach ($datas as $key => $row):?>
        <tr>
            <td><?php echo $row['Meeting_ID']; ?></td>
            <td><?php echo $row['Date']; ?></td>
            <td><a href="紀錄編輯會議2.php?meeting_id=<?php echo $row['Meeting_ID']; ?>"><?php echo $row['Name']; ?></a></td>
            <td><a href="DeleteMeeting.php?meeting_id=<?php echo $row['Meeting_ID']; ?>">刪除</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>