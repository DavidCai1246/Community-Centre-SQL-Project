<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>

<!-- NAVBAR-->
<ul>
    <li style="float:left"><img src="img/logo.png" alt="logo" width="165" height="87"></li>
    <li><a href="index.php">Community Centre</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="food.php">Food</a></li>
    <li><a href="members.php">Members</a></li>
    <li><a href="parking.php">Parking</a></li>
    <li><a href="rooms.php">Rooms</a></li>
</ul>

<!-- THIS IS WHERE ALL OUR FUNCTIONALITY WILL GO, THIS IS OUR BODY -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Welcome to Vancouver Community Centre</h1>
</div>

<div align = 'center'>
    <img src="img/community-centre.jpg" alt="Vancouver Community Centre">
</div>
<br></br>
<div align = 'center'>
    <img src="img/map.jpg" alt="map" width="600" height="400">
</div>

<!-- Aggregate Query for Membership -->
<div style="padding-top:60px;background-color:#ffffff;">

<form action="index.php" method="get">
    <div align='center' class="container">
      <h2>Show all other Community Centers</h2>
      <p> Please Select the Information you want to be displayed </p>
      <form>
        <label class="checkbox-inline">
          <input type="checkbox" name='Name' value="Name">Name
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name='Location' value="Location">Location
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name='Open_Time' value="Open_Time">Open Time
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name='Close_Time' value="Close_Time">Close Time
        </label>
        <input type="submit" name="ProjectionQuery" value="Show Table">
        <input type="submit" name="clear" value="Clear">
      </form>
    </div>
</form>


<!-- MAIN TABLE -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <?php
        if (isset($_GET['ProjectionQuery'])) {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "community-centre";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $attributes ='';

            if(isset($_GET['Name'])){
                $attributes .= "Name,";
            }
            if(isset($_GET['Location'])){
                $attributes .= "Location,";
            }
            if(isset($_GET['Open_Time'])){
                $attributes .= "Open_Time,";
            }
            if(isset($_GET['Close_Time'])){
                $attributes .= "Close_Time,";
            }

            $attributes = substr($attributes, 0, -1);

            if(!empty($attributes)) {
                $sql = "SELECT $attributes FROM Community_Centre";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h1>Community Centres</h1>";

                    $table_HTML = "<table> <tr>";
                    if(isset($_GET['Name'])){
                        $table_HTML .= "<th> Name </th>";
                    }
                    if(isset($_GET['Location'])){
                        $table_HTML .= "<th> Location </th>";
                    }
                    if(isset($_GET['Open_Time'])){
                        $table_HTML .= "<th> Open Time </th>";
                    }
                    if(isset($_GET['Close_Time'])){
                        $table_HTML .= "<th> Close Time </th>";
                    }
                    $table_HTML .= "</tr>";

                    echo "$table_HTML";
                            
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        if(!empty($row["Name"])) {
                            echo "<td>". $row["Name"]. "</td>"; 
                        }
                        if(!empty($row["Location"])) {
                            echo "<td>". $row["Location"]. "</td>";
                        }
                        if(!empty($row["Open_Time"])) {
                            echo "<td>". $row["Open_Time"]. "</td>";
                        }
                        if(!empty($row["Close_Time"])) {
                            echo "<td>". $row["Close_Time"]. "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
            }

            else {
                echo "Please select some columns";
            }

            $conn->close();
        }
    ?>
    
</div>


</html>
