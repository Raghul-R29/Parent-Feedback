<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $stdname = $_POST['stdname'];
    $stdrno = $_POST['stdrno'];
    $stdclass = $_POST['stdclass'];
    $gender = $_POST['gender'];
    $parentname = $_POST['parentname'];
    $pmobile = $_POST['pmobile'];
    $feedback = $_POST['feedback'];

 
    $sql = "INSERT INTO stddetails (stdname, stdrno, stdclass, gender, parentname, pmobile, feedback) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }


    $stmt->bind_param("sisssss", $stdname, $stdrno, $stdclass, $gender, $parentname, $pmobile, $feedback);

 
    if ($stmt->execute()) {
        echo " ";
    } else {
        echo "Error: " . $stmt->error;
    }

 
    $stmt->close();
    $conn->close();
}
?>
