<!-- search_results.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details Report</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .report-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        
        .report-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #37535c;
        }
        
        .report-header h1 {
            color: #37535c;
            margin: 0;
            font-size: 28px;
        }
        
        .report-header p {
            color: #666;
            margin: 5px 0 0;
        }
        
        .detail-section {
            margin-bottom: 25px;
        }
        
        .section-title {
            background-color: #37535c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            padding: 0 15px;
        }
        
        .detail-label {
            flex: 1;
            font-weight: bold;
            color: #555;
        }
        
        .detail-value {
            flex: 2;
            color: #333;
        }
        
        .actions {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin: 0 10px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            background-color: #e64a19;
        }

        /* nav-bar css */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color:rgb(65, 52, 212);
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo img {
            height: 70px;
            width: 100px;
        }
        
        .heading h1 {
            color: white;
            font-size: 30px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
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
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .nav-btn:hover {
            background-color: #e64a19;
        }
        
        .no-results {
            text-align: center;
            padding: 50px;
            font-size: 18px;
            color: #d32f2f;
        }
    </style>
</head>
<body>

   <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="..\images\logo1.jpeg" alt="H&M Registrations Logo">
            </div>
            <div class="heading">
                <h1>Heritage Wheels Showroom</h1>
            </div>
            <div class="auth-buttons">
                <a href="staff-page.html" class="nav-btn">
                    <i class="fas fa-home"></i> Home
                </a>
              <a href="../login.php" onclick="return confirm('Are you sure you want to logout?')" class="text-white bg-black bg-opacity-20 px-4 py-2 rounded-lg nav-btn hover:bg-opacity-30 flex items-center space-x-2">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            </div>
        </nav>
    </header>
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
    $sql = "SELECT * FROM data WHERE rc_num = '$rc_num'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        // Format the date for display
        $formatted_dob = date("d/m/Y", strtotime($data['dob']));
        $formatted_reg_date = date("d/m/Y", strtotime($data['reg_date']));
?>

<div class="report-container">
    <div class="report-header">
        <h1>VEHICLE REGISTRATION DETAILS</h1>
        <p>Report generated on <?php echo date("d/m/Y H:i:s"); ?></p>
    </div>
    
    <div class="detail-section">
        <div class="section-title">CUSTOMER INFORMATION</div>
        <div class="detail-row">
            <div class="detail-label">Customer Name:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['cname']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Date of Birth:</div>
            <div class="detail-value"><?php echo $formatted_dob; ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Email Address:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['email']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Mobile Number:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['mobile']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">ID Proof:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['id_proof']); ?></div>
        </div>
    </div>
    
    <div class="detail-section">
        <div class="section-title">VEHICLE INFORMATION</div>
        <div class="detail-row">
            <div class="detail-label">Vehicle Name:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['vehicle_name']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Engine Number:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['eng_num']); ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">RC Number:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['rc_num']); ?></div>
        </div>
    </div>
    
    <div class="detail-section">
        <div class="section-title">REGISTRATION DETAILS</div>
        <div class="detail-row">
            <div class="detail-label">Registration Date:</div>
            <div class="detail-value"><?php echo $formatted_reg_date; ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Registration ID:</div>
            <div class="detail-value"><?php echo htmlspecialchars($data['SI_no']); ?></div>
        </div>
    </div>
    
    <div class="actions">
        <a href="javascript:window.print()" class="btn">Print Report</a>
        <a href="search-vehicle.html" class="btn">New Search</a>
    </div>
</div>

<?php
    } else {
        echo '<div class="no-results">
                <h2>Vehicle details not found!</h2>
                <p>No vehicle was found with the provided RC number.</p>
                <a href="search-vehicle.html" class="btn">Try Again</a>
              </div>';
    }
}
?>

</body>
</html>