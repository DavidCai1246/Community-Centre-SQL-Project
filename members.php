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
    <h1>Members and Employees Page</h1>
</div>



<!-- Aggregate Query for Membership -->
<div style="padding-top:60px;background-color:#ffffff;">
<header> 
    <h3 align='center'> Aggregation Querys for Members </h3>
</header>
<section>
    <article>
        <p align='center'>
        <form method="GET" action="members.php" style='text-align:center'>
          <label for="calculate">Calculate:</label>
          <select name="operation" id="operation">
            <option value="MIN">MIN</option>
            <option value="MAX">MAX</option>
            <option value="AVG">AVG</option>
          </select>
          <label for="calculate">of</label>
          <select name="attribute" id="attribute">
            <option value="Age">Age</option>
          </select>
          <label for="calculate">for Members Table</label>
          <input type="submit" name="AggregationQueryMember" value="Submit">
          <input type="submit" name="clear" value="Clear">
          <br>
          <label for="calculate">Calculate Number of Members</label>
          <input type="submit" name="AggregationQueryCountMember" value="Submit">
        </form>
        </p>
    </article>

<?php
    if (isset($_GET['AggregationQueryMember']) || isset($_GET['AggregationQueryCountMember'])) {
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
        if (isset($_GET['AggregationQueryMember'])) {
            $attribute = $_GET['attribute'];
            $operation = $_GET['operation'];
            $sql = "SELECT $operation($attribute) as ret FROM Memberships";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                echo "<p align='center'>The $operation $attribute is $row[ret]</p>";
            }    
        }
        else if (isset($_GET['AggregationQueryCountMember'])) {
            $sql = "SELECT COUNT(*) as count FROM Memberships";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                echo "<p align='center'>We currently have $row[count] members</p>";
            }
        }
        $conn->close();
    }
?>
</div>



<!-- Memberships Table -->
<div style="padding:0px;margin-top:0px;background-color:#ffffff;">
    <h1>Members</h1>
    
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



<!-- Aggregate Query for Employee -->
<div style="padding-top:60px;background-color:#ffffff;">
<header> 
    <h3 align='center'> Aggregation Querys for Employees </h3>
</header>
<section>
    <article>
        <p align='center'>
        <form method="GET" action="members.php" style='text-align:center'>
          <label for="calculate">Calculate:</label>
          <select name="operation" id="operation">
            <option value="MIN">MIN</option>
            <option value="MAX">MAX</option>
            <option value="AVG">AVG</option>
            <option value="SUM">SUM</option>
          </select>
          <label for="calculate">of</label>
          <select name="attribute" id="attribute">
            <option value="Age">Age</option>
            <option value="Salary">Salary</option>
            <option value="Hours">Hours</option>
          </select>
          <label for="calculate">for Members Table</label>
          <input type="submit" name="AggregationQueryEmployee" value="Submit">
          <input type="submit" name="clear" value="Clear">
          <br>
          <label for="calculate">Calculate Number of Members</label>
          <input type="submit" name="AggregationQueryCountEmployee" value="Submit">
        </form>
        </p>
    </article>

<?php
    if (isset($_GET['AggregationQueryEmployee']) || isset($_GET['AggregationQueryCountEmployee'])) {
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
        if (isset($_GET['AggregationQueryEmployee'])) {
            $attribute = $_GET['attribute'];
            $operation = $_GET['operation'];
            $sql = "SELECT $operation($attribute) as ret FROM Employee";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                echo "<p align='center'>The $operation $attribute is $row[ret]</p>";
            }    
        }
        else if (isset($_GET['AggregationQueryCountEmployee'])) {
            $sql = "SELECT COUNT(*) as count FROM Employee";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                echo "<p align='center'>We currently have $row[count] Employees</p>";
            }
        }
        $conn->close();
    }
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

</html>