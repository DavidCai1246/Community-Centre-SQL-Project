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
    <h1>Query Members</h1>
</div>

<!-- Memberships Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Memberships</h1>
    
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

        $sql = "SELECT * FROM Memberships";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Member ID </th>
                    <th> Age </th>
                    <th> Name </th>
                    <th> Address </th>
                    <th> Using Equipment </th>
                    <th> Parking No. </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Membership_ID"]. "</td>".
                    "<td>". $row["Age"]. "</td>".
                    "<td>". $row["Name"]. "</td>".
                    "<td>". $row["Address"]. "</td>".
                    "<td>". $row["Equipment_ID"]. "</td>".
                    "<td>". $row["Parking_Num"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    
</div>

<!-- Employees Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Employees</h1>
    
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

        $sql = "SELECT * FROM Employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Employee ID </th>
                    <th> Salary </th>
                    <th> Age </th>
                    <th> Name </th>
                    <th> Address </th>
                    <th> Hours </th>
                    <th> Parking Num </th>
                    <th> Community Centre </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Employee_ID"]. "</td>".
                    "<td>". $row["Salary"]. "</td>".
                    "<td>". $row["Age"]. "</td>".
                    "<td>". $row["Name"]. "</td>".
                    "<td>". $row["Address"]. "</td>".
                    "<td>". $row["Hours"]. "</td>".
                    "<td>". $row["Parking_Num"]. "</td>".
                    "<td>". $row["Community_Centre"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    
</div>

<!-- Staff Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Staff</h1>
    
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

        $sql = "SELECT * FROM Staff";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Employee ID </th>
                    <th> Role </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Employee_ID"]. "</td>".
                    "<td>". $row["Role"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    
</div>

<!-- Volunteers Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Volunteers</h1>
    
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

        $sql = "SELECT * FROM Volunteer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Employee ID </th>
                    <th> School </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Employee_ID"]. "</td>".
                    "<td>". $row["School"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    
</div>

<!-- Contractors Table -->
<div style="padding:20px;margin-top:30px;background-color:#ffffff;">
    <h1>Contractors</h1>
    
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

        $sql = "SELECT * FROM Contractor";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <tr>
                    <th> Employee ID </th>
                    <th> Contract Start </th>
                    <th> Contract End </th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["Employee_ID"]. "</td>".
                    "<td>". $row["Contract_Start"]. "</td>".
                    "<td>". $row["Contract_End"]. "</td>";
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
