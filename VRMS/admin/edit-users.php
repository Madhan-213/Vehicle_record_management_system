<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'vehicli');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add new user
    if (isset($_POST['uname']) && !isset($_POST['id'])) {
        $username = $conn->real_escape_string($_POST['uname']);
        $password = password_hash($conn->real_escape_string($_POST['upass']), PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO user (uname, upass) VALUES ('$username', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: users.php?success=User added successfully");
        } else {
            header("Location: users.php?error=Error adding user: " . $conn->error);
        }
    }
    // Edit existing user
    elseif (isset($_POST['id']) && isset($_POST['uname'])) {
        $id = $conn->real_escape_string($_POST['id']);
        $username = $conn->real_escape_string($_POST['uname']);
        
        // Update password only if provided
        if (!empty($_POST['upass'])) {
            $password = password_hash($conn->real_escape_string($_POST['upass']), PASSWORD_DEFAULT);
            $sql = "UPDATE user SET uname='$username', upass='$password' WHERE uid='$id'";
        } else {
            $sql = "UPDATE user SET uname='$username' WHERE uid='$id'";
        }
        
        if ($conn->query($sql) === TRUE) {
            header("Location: users.php?success=User updated successfully");
        } else {
            header("Location: users.php?error=Error updating user: " . $conn->error);
        }
    }
}

$conn->close();
?>