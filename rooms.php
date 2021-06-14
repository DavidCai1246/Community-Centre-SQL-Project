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
<section>
    <article>
		<p align='center'>
		<form method="GET" action="rooms.php" style ='text-alignt:center'>
			<label for="calculate">Display Staff That Reserved All Rooms:</label>
			<input type="submit" name="DisplayReservedAll" value="Display">
			<input type="submit" name="Hide" value="Clear">
		</form>
		</p>
	</article>
</section>


<?php
    if (isset($_GET['DisplayReservedAll'])) {
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
		
		if (isset($_GET['DisplayReservedAll'])) {
			// $sql = "SELECT r.Type, r.Size, r.Room_ID FROM Room r
            //             WHERE NOT EXISTS (SELECT s.EmployeeID FROM Staff s WHERE NOT EXISTS (
            //                 SELECT q.ReservedBy FROM Room q
            //                     WHERE q.ReservedBy = r.ReservedBy)";
            
            $sql = "SELECT e.Name, e.Employee_ID FROM Employee e
                        WHERE NOT EXISTS (SELECT * FROM Room r WHERE NOT EXISTS (
                            SELECT q.ReservedBy FROM Room q 
                                WHERE q.ReservedBy = Employee_ID AND q.Room_ID = r.Room_ID))";

			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Name </th>
					<th> Employee_ID </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Name"]. "</td>".
					"<td>". $row["Employee_ID"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
			} else {
            echo "0 results";
			}
		}
        $conn->close();
    }
?>

</div>

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

    function handleUpdateRequest() {
        global $conn;

        $Column = $_POST['updtColumn'];
        $RoomID = $_POST['updtRoomID'];
        $Modifier = $_POST['updtMod'];

        $sql = "UPDATE Room SET $Column = '$Modifier' WHERE Room_ID = '$RoomID'";

        $conn->query($sql);
    }


    // big switch for post functions (insert, update, deletes)
    function handlePOSTRequest() {
        if (connect()) {
            if (array_key_exists('updateRequest', $_POST)) {
                handleUpdateRequest();
            }
        }
        disconnect();
    }

    if (isset($_POST['postRequest'])) {
        handlePOSTRequest();
    }

?>


<!-- Rooms Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">

    <!--Updating Events -->
    <button type="button" class="collapsible">Update Room</button>
    <div class="content">
        <form method="POST" action="rooms.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateRequest" name="updateRequest">
            <table><tr>
                <td> Column </td>
                <td> Room ID </td>
                <td> Modification </td>
            </tr>
            <tr>
                <td> 
                    <select name="updtColumn"> 
                        <option value="Type">Type</option>
                        <option value="Size">Size</option>
                        <option value="Community_Centre">Community Centre</option>
                        <option value="Is_Reserved">Is Reserved</option>
                        <option value="ReservedBy">Reserved By</option>
                    </select>
                </td>
                <td> <input type="text" name="updtRoomID"> </td>
                <td> <input type="text" name="updtMod"> </td>
            </tr></table>

            <input type="submit" value="update" name="postRequest"></p>
        </form> 
    </div>

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


</html>
