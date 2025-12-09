<?php

// Database connection
$conn = new mysqli('localhost', 'root', '', 'vehicli');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-menu {
            padding: 0;
            list-style: none;
        }
        
        .sidebar-menu li {
            padding: 10px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }
        
        .sidebar-menu li:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }
        
        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: block;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .dashboard-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .card-icon {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .sidebar.active {
                width: 250px;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .toggle-sidebar {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-car"></i> Heritage Wheels Showroom</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="active"><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="registrations.php"><i class="fas fa-car"></i> Vehicle Registrations</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i>Staff Management</a></li>
            <li><a href="..\login.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <button class="btn btn-primary toggle-sidebar d-none mb-3" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        
        <h2 class="mb-4"><i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard</h2>
        
        <!-- Dashboard Stats -->
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-card card bg-primary text-white p-4">
                    <div class="card-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h5>Total Registrations</h5>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) as total FROM data");
                    $row = $result->fetch_assoc();
                    echo "<h3>" . $row['total'] . "</h3>";
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card card bg-success text-white p-4">
                    <div class="card-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h5>Staff Users</h5>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) as total FROM user");
                    $row = $result->fetch_assoc();
                    echo "<h3>" . $row['total'] . "</h3>";
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card card bg-info text-white p-4">
                    <div class="card-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <h5>Today's Registrations</h5>
                    <?php
                    $today = date("Y-m-d");
                    $result = $conn->query("SELECT COUNT(*) as total FROM data WHERE reg_date = '$today'");
                    $row = $result->fetch_assoc();
                    echo "<h3>" . $row['total'] . "</h3>";
                    ?>
                </div>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
        
        // Handle edit modal data
        var editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var username = button.getAttribute('data-username');
            
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_username').value = username;
        });
    </script>
</body>
</html>