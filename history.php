<html>
<head>
    <title>Sensor History</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.10.0.custom.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
          $(function() {
            $( "#datepicker" ).datepicker({
                onSelect: function (selectedDate) {
                    var getTable = "<?php echo $_GET["table"]; ?>";
                    window.location.href="http://10.56.64.66/history.php?table="+getTable+"&date="+selectedDate; 
                }
            });            
          });
    </script>
</head>
<body>
<div class="jumbotron jumbotron-fluid bg-light" style="margin-bottom: 0px; padding-bottom: 10px; text-align: center;">
    <h1 style="display:inline; margin-left: 20px; float: left;"><a href="index.php"><i class="fas fa-chevron-left"></i></a></h1>
    <h1 style="display:inline; padding-right: 1em;">Sensor History</h1>
    <p style="text-align: center; padding-bottom: 0px; margin-bottom: 0px;"><?php displayinfo();?></p>
    <p style="text-align: center;"><input type="text" id="datepicker" value="<?php echo $_GET["date"]; ?>" style="text-align: center; border: none; background: none; color: black; font-size: 14px;"></p>
</div>
<div class="content" style="padding-top: 20px;">
    <?php displaytable();?>
</div>
<?php
    
    function displaytable() { 
        $servername = "localhost";
        $username = "root";
        $password = "T3mp12";
        $dbname = "temp";

        //Get Variables
        $table = $_GET["table"];
        $date = $_GET["date"];    

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT date, time, temp FROM $table WHERE date = '$date'";
        $result = $conn->query($sql);    

        if ($result->num_rows > 0) {
            echo "<table class='table table-hover table-sm' style='margin: 0px auto; text-align: center; table-layout: auto; width: auto;'><tr class='bg-primary' style='color: white;'><th>Time</th><th>Temperature</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["time"]."</td><td>".$row["temp"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center'>No data available for $date</p>";
        }
        $conn->close();
    }
    
    function displayinfo() { 
        $servername = "localhost";
        $username = "root";
        $password = "T3mp12";
        $dbname = "temp";

        //Get Variables
        $table = $_GET["table"];
        $date = $_GET["date"];    

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT location, campus FROM devices WHERE name = '$table' LIMIT 1";
        $result = $conn->query($sql);    

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            print "Location: " . $row["location"]." | ";
            print "Campus: " . $row["campus"] . "<br>";
        }
        } else {
            echo "Data Unavailable";
        }
        $conn->close();
    }
    
    function displaydate() { 
        $servername = "localhost";
        $username = "root";
        $password = "T3mp12";
        $dbname = "temp";

        //Get Variables
        $table = $_GET["table"];
        $date = $_GET["date"];    

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT location, campus FROM devices WHERE name = '$table' LIMIT 1";
        $result = $conn->query($sql);    

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            print $date;
        }
        } else {
            echo "Data Unavailable";
        }
        $conn->close();
    }
    
    function tableName() { 

        //Get Variables
        $table = $_GET["table"];
   
        print $table;
    }
?>
</body>
</html>

