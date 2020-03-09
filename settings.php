<?php

function displayDevices(){
    // Connect to DB
    include("connect-db.php");

    // Get Data
    if ($result = $mysqli->query("SELECT * FROM devices ORDER BY ID"))
    {
            echo "<h4 style='text-align: center;'>Temperature Devices</h4>";
            echo "<table class='table table-sm' style='margin: 0px auto; text-align: center; table-layout: auto; width: auto;'>";
            echo "<tr><th>Name</th><th>Shortcode</th><th>Location</th><th><a href='#' data-toggle='modal' data-target='#addModal' data-dismiss='modal'><i class='fas fa-plus' style='color: green; padding-top: 3px;'></i></a></th></tr>";
        // Display Data
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_object())
            {
                echo "<tr>";
                echo "<td>" . $row->Name . "</td>";
                echo "<td>" . $row->Campus . "</td>";
                echo "<td>" . $row->Location . "</td>";
                echo "<td><a href='index.php?dev-id=" . $row->ID . "&dev-name=" . $row->Name . "'><i class='fas fa-times' style='color: red; padding-top: 3px;'></i></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else
            {
            echo "</table>";
            echo "No devices available.";
            }
    }
    else
    {
        echo "Error: " . $mysqli->error;
    }
        
    // Close Connection
    $mysqli->close();
}

function displayLocations(){
    // Connect to DB
    include("connect-db.php");

    // Get Data
    if ($result = $mysqli->query("SELECT * FROM locations ORDER BY ID"))
    {
            echo "<h4 style='text-align: center;'>Device Locations</h4>";
            echo "<table class='table table-sm' style='margin: 0px auto; text-align: center; table-layout: auto; width: auto;'>";
            echo "<tr><th>Name</th><th>Shortcode</th><th><a href='#' data-toggle='modal' data-target='#locModal' data-dismiss='modal'><i class='fas fa-plus' style='color: green; padding-top: 3px;'></i></a></th></tr>";
        // Display Data
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_object())
            {
                echo "<tr>";
                echo "<td>" . $row->NAME . "</td>";
                echo "<td>" . $row->SHORTCODE . "</td>";
                echo "<td><a href='index.php?loc-id=" . $row->ID . "'><i class='fas fa-times' style='color: red; padding-top: 3px;'></i></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else
            {
            echo "</table>";
            echo "<p style='text-align: center;'>No locations available.</p>";
            }
    }
    else
    {
        echo "Error: " . $mysqli->error;
    }
        
    // Close Connection
    $mysqli->close();
}

function displayAlarms(){
    // Connect to DB
    include("connect-db.php");

    // Get Data
    if ($result = $mysqli->query("SELECT * FROM alarms ORDER BY ID"))
    {
            echo "<h4 style='text-align: center;'>Temperature Alarms</h4>";
            echo "<table class='table table-sm' style='margin: 0px auto; text-align: center; table-layout: auto; width: auto;'>";
            echo "<tr><th>Email</th><th>Temperature</th><th><a href='#' data-toggle='modal' data-target='#alarmModal' data-dismiss='modal'><i class='fas fa-plus' style='color: green; padding-top: 3px;'></i></a></th></tr>";
        // Display Data
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_object())
            {
                echo "<tr>";
                echo "<td>" . $row->EMAIL . "</td>";
                echo "<td>" . $row->TEMP . "</td>";
                echo "<td><a href='index.php?temp-id=" . $row->ID . "'><i class='fas fa-times' style='color: red; padding-top: 3px;'></i></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else
            {
            echo "</table>";
            echo "<p style='text-align: center;'>No alarms available.</p>";
            }
    }
    else
    {
        echo "Error: " . $mysqli->error;
    }
        
    // Close Connection
    $mysqli->close();
}

// Form Function
function renderForm($name = "", $error = "", $id = "") {

    echo "<form action='' method='post'>";
    echo "<div class='form-group'>";

    echo "<label>Name</label>"; 
    echo "<input type='text' class='form-control' name='name' style='margin-bottom: 5px;'/>";
    echo "<label>Campus</label>"; 
    echo "<input type='text' class='form-control' name='campus' style='margin-bottom: 5px;'/>";
    echo "<label>Location</label>"; 
    echo "<input type='text' class='form-control' name='location' style='margin-bottom: 5px;'/>";
    echo "<button type='submit' name='adddevice' class='btn btn-primary' style='float: right;'>Add</button>";
    echo "</div>";
    echo "</form>";

}

// Form Function
function renderAlarmForm($email = "", $temp = "", $error = "", $id = "") {

    echo "<form action='' method='post'>";
    echo "<div class='form-group'>";

    echo "<label>Email</label>"; 
    echo "<input type='text' class='form-control' name='email' style='margin-bottom: 5px;'/>";
    echo "<label>Temp</label>"; 
    echo "<input type='text' class='form-control' name='temp' style='margin-bottom: 5px;'/>";
    echo "<button type='submit' name='addalarm' class='btn btn-primary' style='float: right;'>Add</button>";
    echo "</div>";
    echo "</form>";

}

// Form Function
function renderLocForm($email = "", $temp = "", $error = "", $id = "") {

    echo "<form action='' method='post'>";
    echo "<div class='form-group'>";

    echo "<label>Name</label>"; 
    echo "<input type='text' class='form-control' name='name' style='margin-bottom: 5px;'/>";
    echo "<label>Shortcode</label>"; 
    echo "<input type='text' class='form-control' name='shortcode' style='margin-bottom: 5px;'/>";
    echo "<button type='submit' name='addloc' class='btn btn-primary' style='float: right;'>Add</button>";
    echo "</div>";
    echo "</form>";

}

// Process Form Data for New Device
if (isset($_POST['adddevice']))
{
    // Connect to DB
    include("connect-db.php");
    // Get Data
    $name = htmlentities($_POST['name'], ENT_QUOTES);
    $campus = htmlentities($_POST['campus'], ENT_QUOTES);
    $location = htmlentities($_POST['location'], ENT_QUOTES);
    // Verify Contents
    if ($name == '' || $campus == '' || $location == '')
        {
            // If empty, error
            $error = 'Error, name field cannot be empty.';
            renderForm($name, $error);
        }
    else
    {
        // insert the new record into the database
        if ($stmt = $mysqli->prepare("INSERT INTO devices (Name, Campus, Location) VALUES (?, ?, ?)"))
        {
            $stmt->bind_param('sss', $name, $campus, $location);
            $stmt->execute();
            $stmt->close();
        }
        else
        {
            echo "ERROR: Could not prepare SQL statement.";
        }

        // Redirect Index
        header("Location: admin.php");
    }
    
    // Close Connection
    $mysqli->close();
    
    //Create Table
    createTable($name);
}

// Process Form Data for New Alarm
if (isset($_POST['addalarm']))
{
    // Connect to DB
    include("connect-db.php");
    // Get Data
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $temp = htmlentities($_POST['temp'], ENT_QUOTES);
    // Verify Contents
    if ($email == '' || $temp == '')
        {
            // If empty, error
            $error = 'Error, fields cannot be empty.';
        }
    else
    {
        // insert the new record into the database
        if ($stmt = $mysqli->prepare("INSERT INTO alarms (EMAIL, TEMP) VALUES (?, ?)"))
        {
            $stmt->bind_param('ss', $email, $temp);
            $stmt->execute();
            $stmt->close();
        }
        else
        {
            echo "ERROR: Could not prepare SQL statement.";
        }

        // Redirect Index
        header("Location: admin.php");
    }
    
    // Close Connection
    $mysqli->close();
}

// Process Form Data for New Location
if (isset($_POST['addloc']))
{
    // Connect to DB
    include("connect-db.php");
    // Get Data
    $name = htmlentities($_POST['name'], ENT_QUOTES);
    $shortcode = htmlentities($_POST['shortcode'], ENT_QUOTES);
    // Verify Contents
    if (name == '' || $shortcode == '')
        {
            // If empty, error
            $error = 'Error, fields cannot be empty.';
        }
    else
    {
        // insert the new record into the database
        if ($stmt = $mysqli->prepare("INSERT INTO locations (name, shortcode) VALUES (?, ?)"))
        {
            $stmt->bind_param('ss', $name, $shortcode);
            $stmt->execute();
            $stmt->close();
        }
        else
        {
            echo "ERROR: Could not prepare SQL statement.";
        }

        // Redirect Index
        header("Location: admin.php");
    }
    
    // Close Connection
    $mysqli->close();
}

// Delete Device Record by ID
if (isset($_GET['dev-id']) && is_numeric($_GET['dev-id']) && isset($_GET['dev-name']))
{
    // Connect to DB
    include("connect-db.php");

    // Get ID
    $id = $_GET['dev-id'];
    $name = $_GET['dev-name'];
    
    // Remove Record
    if ($stmt = $mysqli->prepare("DELETE FROM devices WHERE ID = ? LIMIT 1"))
    {
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
        echo "ERROR: could not prepare SQL statement.";
    }

    // Close Connection
    $mysqli->close();

    // Clear Table
    clearTable($name);
    
    // Reload Index
    header("Location: admin.php");
}

// Delete Alarm Record by ID
if (isset($_GET['temp-id']) && is_numeric($_GET['temp-id']))
{
    // Connect to DB
    include("connect-db.php");

    // Get ID
    $id = $_GET['temp-id'];

    // Remove Record
    if ($stmt = $mysqli->prepare("DELETE FROM alarms WHERE ID = ? LIMIT 1"))
    {
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
        echo "ERROR: could not prepare SQL statement.";
    }

    // Close Connection
    $mysqli->close();

    // Reload Index
    header("Location: admin.php");
}

// Delete Location Record by ID
if (isset($_GET['loc-id']) && is_numeric($_GET['loc-id']))
{
    // Connect to DB
    include("connect-db.php");

    // Get ID
    $id = $_GET['loc-id'];

    // Remove Record
    if ($stmt = $mysqli->prepare("DELETE FROM locations WHERE ID = ? LIMIT 1"))
    {
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
        echo "ERROR: could not prepare SQL statement.";
    }

    // Close Connection
    $mysqli->close();

    // Reload Index
    header("Location: admin.php");
}

// Create Table for Device
function createTable($table){
    // Server Connection Information
    $servername = "localhost";
    $username = "root";
    $password = "T3mp12";
    $dbname = "temp";
    
    // Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }  

    $sql = "CREATE TABLE IF NOT EXISTS `$table` (`ID` int(11) NOT NULL AUTO_INCREMENT, `CAMPUS` varchar(20) NOT NULL, `LOCATION` varchar(20) NOT NULL, `DATE` varchar(20) NOT NULL, `TIME` varchar(20) NOT NULL, `TEMP` int(20) NOT NULL, PRIMARY KEY (`ID`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8";

    if ($conn->query($sql) === TRUE) {
        // echo "New Table Created. <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //Close Connection
    $conn->close();
}

// Clear Table for Device
function clearTable($table){
    // Server Connection Information
    $servername = "localhost";
    $username = "root";
    $password = "T3mp12";
    $dbname = "temp";
    
    // Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }  

    $sql = "TRUNCATE TABLE $table";

    if ($conn->query($sql) === TRUE) {
        // echo "New Table Created. <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //Close Connection
    $conn->close();
}
?>

