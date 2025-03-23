<?php
include 'connect.php'; 
$sql = "SELECT * FROM stddetails";
$result = $conn->query($sql);
?>

<body>

    <h2>Details</h2>
    <table border="1"  cellpadding=10>
        <tr>
            <th>Stdname</th>
            <th>Stdrno</th>
            <th>Stdclass</th>
            <th>Gender</th>
            <th>ParentName</th>
            <th>ParentMobile</th>
            <th>Feedback</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['stdname'] . "</td>";
                echo "<td>" . $row['stdrno'] . "</td>";
                echo "<td>" . $row['stdclass'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['parentname'] . "</td>";
                echo "<td>" . $row['pmobile'] . "</td>";
                echo "<td>" . $row['feedback'] . "</td>";

                echo '<td><a href="delete.php?stdrno='.$row['stdrno']. '">Delete</a></td>';
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' align='center'>No users found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <button onclick="location.href='index.php'" style=margin-top:10px>Back to login</button>

</body>
</html>
