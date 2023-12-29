<?php 
        $db_server = '127.0.0.1';
        $db_name='MMS_DB';
        $db_user = 'root';
        $db_password = '';    
        
        $sql = mysqli_connect($db_server,$db_user,$db_password,$db_name,3306);

        if($sql -> connect_errno){
            echo "Failed to make MySQL connection.\n";
            exit;
        } 
?>