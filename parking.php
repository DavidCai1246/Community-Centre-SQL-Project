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
    <h1>Parking Page</h1>
</div>

<div>
    <article>
        <p align='center'>
        <form method="GET" action="parking.php" style='text-align:center'>
          <label for="calculate">Show </label>
          <select name="attribute" id="attribute">
            <option value="Parking_Num">Parking Number</option>
            <option value="Duration">Duration</option>
          </select>
          <select name="operation" id="operation">
            <option value=">">></option>
            <option value="<"><</option>
            <option value="=">=</option>
            <option value=">=">>= </option>
            <option value="<="><= </option>
          </select>
          <input type="number" id="restraint" name="restraint" step=".01" required>
          <input type="submit" name="SelectionQuery" value="Submit">
        </form>
        <form method="GET" action="parking.php" style='text-align:center'>
            <input type="submit" name="Show All" value="Show All">
        </form>
        </p>
    </article>
</div>


<!-- Parking Stalls Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    
        <!-- THIS DISPLAYS THE TABLE ON LINK OPEN -->
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "000824";
        $dbname = "community-centre";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['SelectionQuery'])) {
            // output data of each row
            $attribute = $_GET['attribute'];
            $operation = $_GET['operation'];
            $number = $_GET['restraint'];
            $sql = "SELECT * FROM Parking_Stall WHERE $attribute $operation $number";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<h1>Parking Stalls</h1>";
                echo "<p>Selection Query</p>";
                echo "<table> <tr>
                            <th> Parking Number </th>
                            <th> Duration </th>
                            <th> Type </th>
                            <th> Community Centre </th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $row["Parking_Num"]. "</td>".
                            "<td>". $row["Duration"]. "</td>".
                            "<td>". $row["Type"]. "</td>".
                            "<td>". $row["Community_Centre"]. "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
            }
            else {
                echo "No Parking Stalls Found :(";
            }
        }

        else {
            $sql = "SELECT * FROM Parking_Stall";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<h1>Parking Stalls</h1>";
                echo "<p>Selection Query</p>";
                // output data of each row
                echo "<table> <tr>
                        <th> Parking Number </th>
                        <th> Duration </th>
                        <th> Type </th>
                        <th> Community Centre </th>
                        </tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row["Parking_Num"]. "</td>".
                        "<td>". $row["Duration"]. "</td>".
                        "<td>". $row["Type"]. "</td>".
                        "<td>". $row["Community_Centre"]. "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        }

        $conn->close();
    ?>
    
</div>

</html>
