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

<!-- THIS IS WHERE ALL OUR FUNCTIONALITY WILL GO, THIS IS OUR BODY 
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Query Food Services</h1>
</div>
-->

<!-- JOIN QUERY FOR FOODSERVICES -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
<section>
	<article>
		<p align='center'>
		<form method="GET" action="food.php" style ='text-alignt:center'>
			<label for="calculate">Display food logs:</label>
			<input type="submit" name="DisplayFoodLogs" value="Display">
			<input type="submit" name="Hide" value="Clear">
		</form>
		</p>
	</article>
</section>

<?php
    if (isset($_GET['DisplayFoodLogs'])) {
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
		
		if (isset($_GET['DisplayFoodLogs'])) {
			$sql = "SELECT f.Food_Service_Name, e.Employee_ID, e.Food, e.TimeAte FROM Food_Services f, EatsEmployee e WHERE f.Food_Service_ID=e.Food_Service_ID";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Food Service Name </th>
					<th> Employee ID </th>
                    <th> Food </th>
					<th> Time Ate </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Food_Service_Name"]. "</td>".
					"<td>". $row["Employee_ID"]. "</td>".
					"<td>". $row["Food"]. "</td>".
                    "<td>". $row["TimeAte"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
			} else {
            echo "0 results";
			}
		}
		
		$sql = "SELECT f.Food_Service_Name, m.Membership_ID, m.Food, m.TimeAte FROM Food_Services f, EatsMembership m WHERE f.Food_Service_ID=m.Food_Service_ID;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Food Service Name </th>
					<th> Member ID </th>
                    <th> Food </th>
					<th> Time Ate </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Food_Service_Name"]. "</td>".
					"<td>". $row["Membership_ID"]. "</td>".
					"<td>". $row["Food"]. "</td>".
                    "<td>". $row["TimeAte"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
			} else {
            echo "0 results";
			}
        $conn->close();
    }
?>



</div>



<!-- Food Services Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Food Services</h1>
    
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

        $sql = "SELECT * FROM Food_Services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Food Service Name </th>
                    <th> Location </th>
                    <th> Community Centre </th>
                    <th> Food Service ID </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Food_Service_Name"]. "</td>".
                    "<td>". $row["Location"]. "</td>".
                    "<td>". $row["Community_Centre"]. "</td>".
                    "<td>". $row["Food_Service_ID"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- Eats_Employee Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Employee Eats</h1>
    
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

        $sql = "SELECT * FROM EatsEmployee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Employee ID </th>
                    <th> Food Service ID </th>
                    <th> Food </th>
                    <th> Time Ate </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Employee_ID"]. "</td>".
                    "<td>". $row["Food_Service_ID"]. "</td>".
                    "<td>". $row["Food"]. "</td>".
                    "<td>". $row["TimeAte"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- Eats_Membership Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Member Eats</h1>
    
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

        $sql = "SELECT * FROM EatsMembership";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Member ID </th>
                    <th> Food Service ID </th>
                    <th> Food </th>
                    <th> Time Ate </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Membership_ID"]. "</td>".
                    "<td>". $row["Food_Service_ID"]. "</td>".
                    "<td>". $row["Food"]. "</td>".
                    "<td>". $row["TimeAte"]. "</td>";
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

