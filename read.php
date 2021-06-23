<?php
    // Variable Storage
    date_default_timezone_set('America/Chicago');

    function gettemp($table) { 

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
        // Get Row from Database
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["TEMP"];
            }
        } else {
            return "err";
        }

        $conn->close();
    }

    function gettime($table) { 

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
        // Get Row from Database
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return substr($row["TIME"], 0, -6) . ' ' . substr($row["TIME"], -2);
            }
        } else {
            return "err";
        }

        $conn->close();
    }

    function pulldate($table) { 

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
        // Get Row from Database
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["DATE"];
            }
        } else {
            return "err";
        }

        $conn->close();
    }

    function getloc($table) { 

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
        // Get Row from Database
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["LOCATION"];
            }
        } else {
            return "err";
        }

        $conn->close();
    }

    function getcampus($table) { 

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
        // Get Row from Database
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["CAMPUS"];
            }
        } else {
            return "err";
        }

        $conn->close();
    }

    function tempmod($filter){
        // Server Connection Information
        $servername = "localhost";
        $username = "root";
        $password = "T3mp12";
        $dbname = "temp";

        // Row Counter
        $i = 0;
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check Connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        // Get Row from Database
        $sql = "SELECT * FROM devices ORDER BY CAMPUS, LOCATION";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                if (getcampus($row["Name"]) == $filter){
                
                    if ($i == 0){
                        print "<div class='row'>";
                    }

                    print "<div class='col-sm " . getcampus($row["Name"]) . "'>";
                        print "<div class='card' style='width: 250px; margin-top: 40px;'>";
                            print "<div class='card-header'>";
                                print "<p align='center' style='margin-bottom: 0; float: left;'><strong>" . getcampus($row["Name"]) . "</strong></p>";
                                print "<p align='center' style='margin-bottom: 0; float: right;'><strong>" . getloc($row["Name"]) . "</strong></p>";
                            print "</div>";
                            print "<div class='card-body'>";
                                print "<h1 class='card-text' align='center' style=' font-size: 72px;'>";
                                    print gettemp($row["Name"]) . "&#176;";
                                print "</h1>";
                            print "</div>";
                            print "<div class='card-footer text-muted'>";
                                print "<span style='font-size: 12px; style=float: left; display: inline-block; padding-top:7px;'>";
                                    print pulldate($row["Name"]) . " " . gettime($row["Name"]);
                                print "</span>";
                                print "<a href='history.php?table=" . $row["Name"] . "&date=" . date("m/d/Y") . "' class='btn btn-primary btn-sm' style='float: right; margin: 0px;'>History</a>";
                            print "</div>";
                        print "</div>";
                    print "</div>";

                    $i++;

                    if ($i == 4){
                        print "</div>";
                        $i = 0;
                    }
                }
                
                if ($filter == ""){
                
                    if ($i == 0){
                        print "<div class='row'>";
                    }

                    print "<div class='col-sm " . getcampus($row["Name"]) . "'>";
                        print "<div class='card' style='width: 250px; margin-top: 40px;'>";
                            print "<div class='card-header'>";
                                print "<p align='center' style='margin-bottom: 0; float: left;'><strong>" . getcampus($row["Name"]) . "</strong></p>";
                                print "<p align='center' style='margin-bottom: 0; float: right;'><strong>" . getloc($row["Name"]) . "</strong></p>";
                            print "</div>";
                            print "<div class='card-body'>";
                                print "<h1 class='card-text' align='center' style=' font-size: 72px;'>";
                                    print gettemp($row["Name"]) . "&#176;";
                                print "</h1>";
                            print "</div>";
                            print "<div class='card-footer text-muted'>";
                                print "<span style='font-size: 12px; style=float: left; display: inline-block; padding-top:7px;'>";
                                    print pulldate($row["Name"]) . " " . gettime($row["Name"]);
                                print "</span>";
                                print "<a href='history.php?table=" . $row["Name"] . "&date=" . date("m/d/Y") . "' class='btn btn-primary btn-sm' style='float: right; margin: 0px;'>History</a>";
                            print "</div>";
                        print "</div>";
                    print "</div>";

                    $i++;

                    if ($i == 4){
                        print "</div>";
                        $i = 0;
                    }
                }
                
            }
        } else {
            return "err";
        }

        if ($i < 4){
            $h = 4 - $i;
            for ($j = 0; $j < $h; $j++) {
                print "<div class='col-sm'>";
                print "</div>";
            }
        }
        
        $conn->close();
    }
  
        function menumod(){
        // Server Connection Information
        $servername = "localhost";
        $username = "root";
        $password = "T3mp12";
        $dbname = "temp";

        // Row Counter
        $i = 0;
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check Connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        // Get Row from Database
        $sql = "SELECT * FROM locations ORDER BY ID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                        
                print "<li class='nav-item active'>";
                print "<a class='nav-link " . $row["SHORTCODE"] . "' href='./index.php?filter=" . $row["SHORTCODE"] . "'>" . $row["NAME"] . "</a>";
                print "</li>";
                
            }
        } else {
            return "err";
        }
        
        $conn->close();
    }

?>