<?php
$servername = "localhost";
$cname = "root";
$password = "";
$dbname = "vehicli";

// Create connection
$conn = new mysqli($servername, $cname, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}   
$sql = "SELECT * FROM data";
$result = ($conn->query($sql));
// declaring array to store the data
$row = [];
if($result->num_rows > 0){
    // fetch all data from db into array
    $row = $result->fetch_all(MYSQLI_ASSOC);
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registrations </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
            --light-bg: #f8f9fa;
            --text-color: #333;
            --border-color: #dee2e6;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Navigation */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--primary-color);
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo img {
            height: 60px;
            width: auto;
            transition: transform 0.3s;
        }
        
        .logo img:hover {
            transform: scale(1.05);
        }
        
        .heading h1 {
            color: white;
            font-size: 28px;
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .auth-buttons {
            display: flex;
            gap: 15px;
        }
        
        .nav-btn {
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-btn:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .nav-btn i {
            font-size: 16px;
        }
        
        /* Page Header */
        .page-header {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        
        .page-header h1 {
            color: var(--primary-color);
            font-size: 32px;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }
        
        .page-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        /* Data Table */
        .data-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
        }
        
        tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        /* Action Buttons */
        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            margin-right: 5px;
        }
        
        .action-btn i {
            margin-right: 5px;
        }
        
        .edit-btn {
            background-color: #ffc107;
            color: #212529;
        }
        
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }
            
            .heading {
                margin: 15px 0;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 14px;
            }
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
                <a href="../login.php" class="nav-btn" onclick="return confirm('Are you sure you want to logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </nav>
    </header>
    
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Vehicle Registration Database</h1>
            <p>Complete list of all registered vehicles in the system</p>
        </div>
        
        <!-- Data Table -->
        <div class="data-container">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>ID Proof</th>
                            <th>Mobile</th>
                            <th>Vehicle</th>
                            <th>Engine No.</th>
                            <th>RC No.</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($row)): ?>
                            <?php foreach($row as $rows): ?>
                                <tr>
                                    <td><?php echo $rows['SI_no']; ?></td>
                                    <td><?php echo htmlspecialchars($rows['cname']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($rows['dob'])); ?></td>
                                    <td><?php echo htmlspecialchars($rows['email']); ?></td>
                                    <td><?php echo htmlspecialchars($rows['id_proof']); ?></td>
                                    <td><?php echo htmlspecialchars($rows['mobile']); ?></td>
                                    <td><?php echo htmlspecialchars($rows['vehicle_name']); ?></td>
                                    <td><?php echo htmlspecialchars($rows['eng_num']); ?></td>
                                    <td><span class="badge badge-success"><?php echo htmlspecialchars($rows['rc_num']); ?></span></td>
                                    <td><?php echo date('d/m/Y', strtotime($rows['reg_date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" style="text-align: center; padding: 30px;">
                                    No vehicle registrations found in the database.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Summary Footer -->
        <div class="footer">
            <p>Total Registrations: <?php echo count($row); ?> | Generated on <?php echo date('d F Y H:i:s'); ?></p>
        </div>
    </div>
    
   
</body>
</html>