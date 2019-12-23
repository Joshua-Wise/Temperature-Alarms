<?php
    // Server Connection Information
    $servername = "localhost";
    $username = "root";
    $password = "T3mp12";
    $dbname = "temp";
    $table = str_replace("-","_",$_GET["table"]);

    // Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }  
    
    // Get Rows from Database
    $sql = "SELECT * FROM devices WHERE Name = '$table'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Table Found, Storing Temperature. <br>";
            storeData($row["Location"], $row["Campus"]);
        }
    } else {
        return "err";
    }

    //Close Connection
    $conn->close();
    
function storeData($location, $campus){
    // Variable Storage
    date_default_timezone_set('America/Chicago');
    $date = date("m/d/Y");
    $time = date('g:i:s A');
    // $temp = $_GET["temp"];
    $temp = substr($_GET["temp"],0,-2);
    $table = str_replace("-","_",$_GET["table"]);
    
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

    $sql = "INSERT INTO $table (CAMPUS, LOCATION, DATE, TIME, TEMP)
    VALUES ('$campus','$location','$date','$time','$temp')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //Close Connection
    $conn->close();

    // Alarm
    alarm($table, $campus, $location, $time, $temp);
}

function alarm($table, $campus, $location, $time, $temp){
        
    // Server Connection Information
    $servername = "localhost";
    $username = "root";
    $password = "T3mp12";
    $dbname = "temp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    // Get Rows from Database
    $sql = "SELECT * FROM alarms ORDER BY ID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $alarmtemp = $row["TEMP"];
            $alarmemail = $row["EMAIL"];
            if ($temp >= $alarmtemp){
                alarmmsg($table, $campus, $location, $time, $temp, $alarmemail);
            }
        }
    } else {
        return "err";
    }

    $conn->close();
    
}

function alarmmsg($table, $campus, $location, $time, $temp, $email){
    require_once 'vendor/autoload.php';

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp-relay.gmail.com', 25))
      ->setUsername('')
      ->setPassword('')
    ;

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $body = 'Device: ' . $table . '<br>' . 'Campus: ' . $campus . '<br>' . 'Location: ' . $location . '<br>' . 'Time: ' . $time . '<br>' . 'Temperature: ' . $temp;

    $message = (new Swift_Message('High Temperature Reported'))
      ->setFrom(['' => 'Temperature Alarm'])
      ->setTo([$email])
      ->setBody($body)
      ->setContentType('text/html')
    ;

    // Send the message
    $mailer->send($message);
}

?>