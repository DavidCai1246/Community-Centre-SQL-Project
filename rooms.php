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
    <h1>Query Rooms</h1>
</div>


<!-- Rooms Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Rooms</h1>
    
        <!-- THIS DISPLAYS THE TABLE ON LINK OPEN -->
    <?php
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

        $sql = "SELECT * FROM Room";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Type </th>
                    <th> Size </th>
                    <th> Community Centre </th>
                    <th> Is Reserved? </th>
                    <th> Room ID </th>
                    <th> Reserved By </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Type"]. "</td>".
                    "<td>". $row["Size"]. "</td>".
                    "<td>". $row["Community_Centre"]. "</td>".
                    "<td>". $row["Is_Reserved"]. "</td>".
                    "<td>". $row["Room_ID"]. "</td>".
                    "<td>". $row["ReservedBy"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    
</div>

<!-- Equipment Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Rooms</h1>
    
        <!-- THIS DISPLAYS THE TABLE ON LINK OPEN -->
    <?php
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

        $sql = "SELECT * FROM Equipment";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Equipment ID </th>
                    <th> Community Centre </th>
                    <th> Type </th>
                    <th> In Use? </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Equipment_ID"]. "</td>".
                    "<td>". $row["Community_Centre"]. "</td>".
                    "<td>". $row["Type"]. "</td>".
                    "<td>". $row["In_Use"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    
</div>


</html>
