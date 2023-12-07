<?php
include 'db.php'; 
 $ipAddress = $_GET['ipAddress'];
  $sql = "SELECT current_page FROM visitors WHERE ip_address='$ipAddress'";
  $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //
                        
                         $current_page = $row['current_page'];
                         echo $current_page.'.php';
                         
                         
                    }
                }
                
?>