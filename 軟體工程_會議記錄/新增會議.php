<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <title>高雄大學資訊工程系會議管理系統</title>
        <link rel="stylesheet" href="上方工具及標題.css"/>
        <link rel="stylesheet" href="新增會議.css"/>
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
        </nav>
        </br>
        <form action="AddMeeting.php" method="post" >
            <table  style="border:3px rgb(115, 115, 115) solid;" border="1" align="center" width="600" cellpadding=2>
                <tr><td class="name">會議編號</td><td><input type="text" name="id"/></td></tr>
                <tr><td class="name">會議名稱</td><td><input type="text" name="name"/></td></tr>
                <tr><td class="name">會議種類</td>
                    <td><select name="category">
                            <option value="系務會議">系務會議</option>
                            <option value="系教評會">系教評會</option>
                            <option value="系課程委員會">系課程委員會</option>
                            <option value="招生暨學生事務委員會">招生暨學生事務委員會</option>
                            <option value="系發展委員會">系發展委員會</option>
                    </select> </td>
                </tr>
                <tr><td class="name">開會時間</td><td><input type="date" name="date"/>&nbsp&nbsp<input type="time" name="time"/></td></tr>
                <tr><td class="name">開會地點</td><td><input type="text" name="location"/></td></tr>
                <tr><td class="name">討論事項</td>
                    <td>提案編號<input type="text" name="num"/>
                        案由<input type="text" name="reason"/>
                        說明<input type="text" name="explain"/>
                    </td>
                </tr>
                <tr><td class="name">相關檔案</td><td><input type="file" ></td>
                <tr><td class="name">與會人員</td>
                    <td>
                        <?php
                            require_once("Login.php");
                            $member = "SELECT `Name` FROM `account`";
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
                                <?php if(($key+1)%4==0&&$key>1):?>
                                    </br>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else:  ?>
                        <?php echo "查無資料";?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            </br>
            <center><button type="submit" position = "center">新增會議</button></center>
        </form>
        
    </body>
</html>