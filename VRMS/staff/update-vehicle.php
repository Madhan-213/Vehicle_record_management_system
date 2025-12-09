<?php
// db.php: File for database connection
$servername = "localhost"; // Your DB server
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "vehicli"; // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch vehicle data based on RC number
$rcNumber = "";
if (isset($_GET['rc_num'])) {
    $rcNumber = $_GET['rc-num'];
}

$vehicleDetails = null;
if ($rcNumber) {
    $sql = "SELECT * FROM vehicles WHERE rc_num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $rcNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $vehicleDetails = $result->fetch_assoc();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vehicle Details</title>
    <style>
        /* Your existing CSS styles */
        

  /* nav-bar css */
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #37535c;
    padding: 10px 20px;
  }
  
  .logo img {
    height: 70px;
    width: 100px;
  }
  
  .heading h1 {
    color: white;
    font-size: 30px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  }
  
  .auth-buttons {
    display: flex;
    gap: 10px;
  }
  
  .nav-btn {
    padding: 8px 16px;
    background-color: #ff5722;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    justify-content: end;
  }
  
  .btn:hover {
    background-color: #e64a19;
  }
    </style>
</head>
<body>

  <!-- nav bar -->
  <header>
    <nav class="navbar">
      <!-- Logo Section -->
      <div class="logo">
        <img src="logo.jpeg" alt="Logo.png" />
      </div>

      <!-- Heading Section -->
      <div class="heading" text>
        <h1>Heritage Wheels Showroom</h1>
      </div>

      <!-- Button Section (Login/Logout) -->
      <div class="auth-buttons">
      <a href="staff-page.html">  <button id="home" class="nav-btn">Home</button></a>
         <a href="../login.php"><button id="logout" class="nav-btn" onclick="logout()">Logout</button></a>
        
      </div>
    </nav>
  </header>
    <div class="container">
        <h2>Update Vehicle Details</h2>
        <?php if ($vehicleDetails): ?>
        <form action="update_vehicle.php" method="POST">
            <!-- Client Details -->
            <div class="form-group">
                <label for="clientName">Client Name:</label>
                <input type="text" id="clientName" name="clientName" value="<?php echo $vehicleDetails['owner_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $vehicleDetails['dob']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo $vehicleDetails['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="idProof">ID Proof (Aadhar Card Number):</label>
                <input type="text" id="idProof" name="idProof" value="<?php echo $vehicleDetails['id_proof']; ?>" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" value="<?php echo $vehicleDetails['contact_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="registerDate">Registration Date:</label>
                <input type="date" id="registerDate" name="registerDate" value="<?php echo $vehicleDetails['registration_date']; ?>" required>
            </div>

            <!-- Vehicle Details -->
            <div class="form-group">
                <label for="vehicleName">Vehicle Name:</label>
                <input type="text" id="vehicleName" name="vehicleName" value="<?php echo $vehicleDetails['vehicle_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="engineNumber">Engine Number:</label>
                <input type="text" id="engineNumber" name="engineNumber" value="<?php echo $vehicleDetails['engine_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rcNumber">RC Number:</label>
                <input type="text" id="rcNumber" name="rcNumber" value="<?php echo $vehicleDetails['rc_number']; ?>" required readonly>
            </div>

            <button type="submit">Update Details</button>
        </form>
        <?php else: ?>
        <p>No vehicle found with this RC number.</p>
        <?php endif; ?>
    </div>
    <script>
    function logout() {
      document.getElementById("logout").innerHTML = alert("Are you sure you want to Log-Out?");
    }

    
  </script>
</body>
</html>
