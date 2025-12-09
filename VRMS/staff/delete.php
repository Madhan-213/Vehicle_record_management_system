<!-- delete.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicli";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['rc_num'])) {
    $rc_num = $_POST['rc_num'];
    
    // SQL to delete a record
    $sql = "DELETE FROM data WHERE rc_num = '$rc_num'";

    if ($conn->query($sql) === TRUE) {
        header("location:staff-page.html");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>