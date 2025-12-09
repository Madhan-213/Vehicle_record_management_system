<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'vehicli');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter exists
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    
    // First, check if this is the last admin (prevent deleting all admins)
    $check_sql = "SELECT COUNT(*) as count FROM user";
    $result = $conn->query($check_sql);
    $row = $result->fetch_assoc();
    
    if ($row['count'] <= 1) {
        header("Location: users.php?error=Cannot delete the last admin user");
        exit();
    }
    
    // Proceed with deletion
    $sql = "DELETE FROM user WHERE uid='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: users.php?success=User deleted successfully");
    } else {
        header("Location: users.php?error=Error deleting user: " . $conn->error);
    }
} else {
    header("Location: users.php?error=No user ID specified");
}

$conn->close();
?>