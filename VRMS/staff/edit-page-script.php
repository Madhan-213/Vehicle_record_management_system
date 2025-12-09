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
} else {
    echo "Connected successfully";
}

// User input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST["cname"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $id_proof = $_POST["id_Proof"];
    $mobile = $_POST["mobile"];
    // $reg_num = $_POST["reg_num"];
    $vehicle_name = $_POST["vehicle_name"];
    $eng_num = $_POST["eng_num"];
    $rc_num = $_POST["rc_num"];
}

// Prepare SQL update query
$sql = "UPDATE data SET cname=?, dob=?, email=?, id_proof=?, mobile=?, vehicle_name=?, eng_num=? WHERE rc_num=?";
$stmt = $conn->prepare($sql);

if ($stmt === false) { 
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters (types: s = string, i = integer, d = double, b = blo
$stmt->bind_param('sssissss', $cname, $dob, $email, $id_proof, $mobile, $vehicle_name, $eng_num, $rc_num);

if ($stmt->execute()) {
    // echo "Vehicle details updated successfully!";
    
    echo "<script>
    alert('Vehicle details updated successfully!');
    window.location.href = 'staff-page.html'; 
  </script>";
  
} else {
    echo "Error updating vehicle details: " . $conn->error;
}


$stmt->close();
$conn->close();
?>
