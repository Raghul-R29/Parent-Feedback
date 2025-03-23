<?php
include 'connect.php';
if (isset($_GET['stdrno'])) {
    $stdrno = $_GET['stdrno'];

 
    $delete_query = "DELETE FROM stddetails WHERE stdrno='$stdrno'";

    if ($conn->query($delete_query) === TRUE) {
        echo "Record deleted successfully.";
        header("Location: details.php"); 
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
