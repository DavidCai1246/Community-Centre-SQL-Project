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
    <h1>Query Community Centres</h1>
    <br> </br>
    <h1>Insert Values into DemoTable</h1>
        <form method="POST" action="index.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            <table><tr>
                <td> Name </td>
                <td> Location </td>
                <td> Open Time </td>
                <td> Close Time </td>
            </tr>
            <tr>
                <td> <input type="text" name="insName"> </td>
                <td> <input type="text" name="insLocation"> </td>
                <td> <input type="text" name="insOpen"> </td>
                <td> <input type="text" name="insClose"> </td>
            </tr></table>

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>
</div>


<!-- MAIN TABLE -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Community Centres</h1>
    
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

        $sql = "SELECT Name, Location, Open_Time, Close_Time FROM Community_Centre";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Name </th>
                    <th> Location </th>
                    <th> Open Time </th>
                    <th> Close Time </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Name"]. "</td>". "<td>". $row["Location"]. "</td>". "<td>". $row["Open_Time"]. "</td>" . "<td>". $row["Close_Time"]. "</td>";
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
