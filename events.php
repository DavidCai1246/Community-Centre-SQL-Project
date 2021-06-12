<html>
<head>
<link rel="stylesheet" href="css/style.css">
<style>
.collapsible {
  background-color: rgba(98, 167, 68, 0.2);
  color: white;
  cursor: pointer;
  padding: 10px;
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
  padding: 0 10px;
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

<!-- ******************************************** -->
<!-- * THIS IS WHERE ALL OUR PHP SCRIPT WILL GO * -->
<!-- ******************************************** -->
<?php

    $conn = Null;

    // creates a connection
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
            return false;
            die("Connection failed: " . $conn->connect_error);
        } else {return true;}
    }

    // closes the connection
    function disconnect() {
        global $conn;
        mysqli_close($conn);
    }

    function handleInsertEventRequest() {
        global $conn;

        $Date = $_POST['insDate'];
        $EventID = $_POST['insEventID'];
        $RoomID = $_POST['insRoomID'];
        $OrganizerID = $_POST['insOrganizerID'];

        $sql = "INSERT INTO Events (Date_of_Event, Event_ID, Room_ID, Employee_ID) VALUES ('$Date', '$EventID',  '$RoomID', '$OrganizerID')";

        $conn->query($sql);
    }

    function handleDeleteRequest() {
        global $conn;
        
        $EventID2 = $_POST['delEventID'];

        $sql = "DELETE FROM Events WHERE Event_ID = '$EventID2'";

        $conn->query($sql);
    }

    function handleInsertEventTypeRequest() {
        global $conn;

        $EventID = $_POST['insTypeEventID'];
        $EventType = $_POST['insTypeEventType'];
        $Modifier = $_POST['modifier'];

        $sql = "INSERT INTO $EventType VALUES ('$EventID', '$Modifier')";
        // echo $EventType . $EventID . "<br>" . $sql;

        $conn->query($sql);
    }

    function handleUpdateEventQueryRequest() {
        global $conn;

        $Column = $_POST['updtColumn'];
        $EventID = $_POST['updtEventID'];
        $Modifier = $_POST['updtMod'];

        $sql = "UPDATE Events SET $Column = '$Modifier' WHERE Event_ID = '$EventID'";

        $conn->query($sql);
    }

    function handleInsertAttendeeRequest() {
        global $conn;

        $EventID = $_POST['eventID'];
        $MemberID = $_POST['memberID'];


        $sql = "INSERT INTO Attends VALUES ('$MemberID', '$EventID')";
        // echo $EventType . $EventID . "<br>" . $sql;

        $conn->query($sql);
    }

    // big switch for post functions (insert, update, deletes)
    function handlePOSTRequest() {
        if (connect()) {
            if (array_key_exists('insertEventQueryRequest', $_POST)) {
                handleInsertEventRequest();
            } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                handleDeleteRequest();
            } else if (array_key_exists('insertEventTypeQueryRequest', $_POST)) {
                handleInsertEventTypeRequest();
            } else if (array_key_exists('updateEventQueryRequest', $_POST)) {
                handleUpdateEventQueryRequest();
            } else if (array_key_exists('insertAttendeeRequest', $_POST)) {
                handleInsertAttendeeRequest();
            } 
        }
        disconnect();
    }

    if (isset($_POST['postRequest'])) {
        handlePOSTRequest();
    }
?>
<!------------------------------------------------------------------------------------------------------------------------->

<!-- MAIN TABLE -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">

    <!--Adding Events -->
    <button type="button" class="collapsible">Add Events</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertEventQueryRequest" name="insertEventQueryRequest">
            <table><tr>
                <td> Date Of Event </td>
                <td> Event ID </td>
                <td> Room ID </td>
                <td> Organizer ID </td>
            </tr>
            <tr>
                <td> <input type="date" name="insDate"> </td>
                <td> <input type="text" name="insEventID"> </td>
                <td> <input type="text" name="insRoomID"> </td>
                <td> <input type="text" name="insOrganizerID"> </td>
            </tr></table>

            <input type="submit" value="insert" name="postRequest"></p>
        </form> 
    </div>

    <!--Updating Events -->
    <button type="button" class="collapsible">Update Event</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateEventQueryRequest" name="updateEventQueryRequest">
            <table><tr>
                <td> Column </td>
                <td> Event ID </td>
                <td> Modification </td>
            </tr>
            <tr>
                <td> 
                    <select name="updtColumn"> 
                        <option value="Date_of_Event">Date Of Event</option>
                        <option value="Room_ID">Room ID</option>
                        <option value="Employee_ID">Employee ID</option>
                    </select>
                </td>
                <td> <input type="text" name="updtEventID"> </td>
                <td> <input type="text" name="updtMod"> </td>
            </tr></table>

            <input type="submit" value="update" name="postRequest"></p>
        </form> 
    </div>

    <!--Removing Events -->
    <button type="button" class="collapsible">Remove Events</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            <table><tr>
                <td> Event ID </td>
            </tr>
            <tr>
                <td> <input type="text" name="delEventID"> </td>
            </tr></table>
                <input type="submit" value="delete" name="postRequest"></p>
        </form> 
    </div>   

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
                    <th> Event ID </th>
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

<!-- EVENT TYPES -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">

    <!--Adding Event Types -->
    <button type="button" class="collapsible">Add Event Type</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertEventTypeQueryRequest" name="insertEventTypeQueryRequest">
            <table><tr>
                <td> Event Type </td>
                <td> Event ID </td>
                <td> Event Modifier </td>
            </tr>
            <tr>
                <td> 
                    <select name="insTypeEventType"> 
                        <option value="Fitness_Classes">Fitness Class</option>
                        <option value="Community_Outreach">Community Outreach</option>
                        <option value="Intramural_League">Intramural League</option>
                    </select>
                </td>
                <td> <input type="text" name="insTypeEventID"> </td>
                <td> <input type="text" name="modifier"> </td>
            </tr></table>

            <input type="submit" value="insert" name="postRequest"></p>
        </form> 
    </div>

    <h1>All Fitness Classes</h1>
    <!-- Fitness Classes Sub Table -->
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

    <h1>All Community Outreach Programs</h1>
    <!-- Community Outreach Sub Table -->
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

    <h1>All Intramural Leagues</h1>
    <!-- Intramural League Sub Table -->
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

    <!--Adding Attendance -->
    <button type="button" class="collapsible">Add Attendees</button>
    <div class="content">
        <form method="POST" action="events.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertAttendeeRequest" name="insertAttendeeRequest">
            <table><tr>
                <td> Member ID </td>
                <td> Event ID </td>
            </tr>
            <tr>
                <td> <input type="text" name="memberID"> </td>
                <td> <input type="text" name="eventID"> </td>
            </tr></table>

            <input type="submit" value="insert" name="postRequest"></p>
        </form> 
    </div>

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

<!-- JavaScript for sliding page expanding thing -->
<!-- Taken/Adapted from w3schools as usual :^) -->
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
