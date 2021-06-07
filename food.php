<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>

<!-- NAVBAR-->
<ul>
    <li style="float:left"><img src="img/logo.png" alt="logo" width="165" height="87"></li>
    <li><a href="index.html">Community Centre</a></li>
    <li><a href="events.html">Events</a></li>
    <li><a href="food.html">Food</a></li>
    <li><a href="members.html">Members</a></li>
    <li><a href="parking.html">Parking</a></li>
    <li><a href="rooms.html">Rooms</a></li>
</ul>

<!-- THIS IS WHERE ALL OUR FUNCTIONALITY WILL GO, THIS IS OUR BODY-->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Food Page</h1>
    
    <!-- THIS DISPLAYS THE TABLE ON LINK OPEN -->
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "ZAGI";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT customerid, customername, customerzip FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> id </th>
                    <th> name </th>
                    <th> zip </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["customerid"]. "</td>". "<td>". $row["customername"]. "</td>". "<td>". $row["customerzip"]. "</td>";
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
