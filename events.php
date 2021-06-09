<html>
<head>
<link rel="stylesheet" href="css/style.css">
<style>
.collapsible {
  background-color: rgba(98, 167, 68, 0.2);
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: rgba(98, 167, 68, 0.4);
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
</style>
</head>
<body>

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

<!-- THIS IS WHERE ALL OUR FUNCTIONALITY WILL BE VIEWED -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">

    <button type="button" class="collapsible">Add Events</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            <table><tr>
                <td> Date Of Event </td>
                <td> Location </td>
                <td> Room ID </td>
                <td> Organizer ID </td>
            </tr>
            <tr>
                <td> <input type="text" name="insName"> </td>
                <td> <input type="text" name="insLocation"> </td>
                <td> <input type="text" name="insRoomID"> </td>
                <td> <input type="text" name="insOrganizerID"> </td>
            </tr></table>

            <input type="submit" value="submit" name="insertSubmit"></p>
        </form> 
    </div>

    <br>

    <button type="button" class="collapsible">Remove Events</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            <table><tr>
                <td> Event ID </td>
            </tr>
            <tr>
                <td> <input type="text" name="insName"> </td>
            </tr></table>

            <input type="submit" value="submit" name="insertSubmit"></p>
        </form> 
    </div>

</div>


<!-- THIS IS WHERE ALL OUR PHP SCRIPT WILL GO -->
<?php

$conn = Null;

function connect() {
    global $conn;
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
}

?>

<!-- MAIN TABLE -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>All Events</h1>

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

        $sql = "SELECT * FROM Events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Date Of Event </th>
                    <th> Location </th>
                    <th> Room ID </th>
                    <th> Organizer ID </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Date_of_Event"]. "</td>". 
                        "<td>". $row["Event_ID"]. "</td>". 
                        "<td>". $row["Room_ID"]. "</td>" . 
                        "<td>". $row["Employee_ID"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- SUB TABLES SHOWING THE EVENT TYPES -->

<!-- Fitness Classes Sub Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>All Fitness Classes</h1>

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

        $sql = "SELECT * FROM Fitness_Classes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Event ID </th>
                    <th> Instructor Name </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Event_ID"]. "</td>". 
                        "<td>". $row["Instructor_Name"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- Community Outreach Sub Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>All Community Outreach Programs</h1>

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

        $sql = "SELECT * FROM Community_Outreach";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Event ID </th>
                    <th> Attendance </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Event_ID"]. "</td>". 
                        "<td>". $row["Attendance"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- Intramural League Sub Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>All Intramural Leagues</h1>

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

        $sql = "SELECT * FROM Intramural_League";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Event ID </th>
                    <th> Sports Type </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Event_ID"]. "</td>". 
                        "<td>". $row["Sports_Type"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- Attends Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Attendees</h1>

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

        $sql = "SELECT * FROM Attends";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Member ID</th>
                    <th> Event ID </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Membership_ID"]. "</td>". 
                        "<td>". $row["Event_ID"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>

<!-- Sponsor_Funds Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Sponsorships and Funding</h1>

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

        $sql = "SELECT * FROM Sponsor_Funds";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Name </th>
                    <th> Amount </th>
                    <th> Event_ID </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Name"]. "</td>". 
                        "<td>". "$ " . $row["Amount"]. "</td>" . 
                        "<td>". $row["Event_ID"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</div>


<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

</body>
</html>
