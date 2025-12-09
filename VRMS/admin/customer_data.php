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

// Initialize variables
$search_term = "";
$is_search = false;

// Check if search form was submitted
if (isset($_GET['rc_num']) && !empty($_GET['rc_num'])) {
    $search_term = $conn->real_escape_string($_GET['rc_num']);
    $is_search = true;
}

// Pagination variables
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get total number of records (different query for search vs all records)
if ($is_search) {
    $total_pages_sql = "SELECT COUNT(*) FROM data WHERE rc_num LIKE '%$search_term%'";
    $sql = "SELECT * FROM data WHERE rc_num LIKE '%$search_term%' LIMIT $offset, $records_per_page";
} else {
    $total_pages_sql = "SELECT COUNT(*) FROM data";
    $sql = "SELECT * FROM data LIMIT $offset, $records_per_page";
}

$result = $conn->query($total_pages_sql);
$total_rows = $result->fetch_array()[0];
$total_pages = ceil($total_rows / $records_per_page);

// Get records for current page
$result = $conn->query($sql);
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
        
        .search-box {
            max-width: 300px;
            margin-bottom: 20px;
        }
        
        .pagination {
            justify-content: center;
            margin-top: 20px;
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
        
        .back-btn {
            margin-bottom: 20px;
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
            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="active"><a href="registrations.php"><i class="fas fa-car"></i> Vehicle Registrations</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Admin Users</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <button class="btn btn-primary toggle-sidebar d-none mb-3" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Back Button -->
        <a href="admin.php" class="btn btn-secondary back-btn">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        
        <h2 class="mb-4"><i class="fas fa-car me-2"></i> Vehicle Registrations</h2>
        
        <!-- Search Box -->
        <div class="search-box">
            <form action="registrations.php" method="GET" class="d-flex">
                <input type="text" name="rc_num" class="form-control" placeholder="Search by RC number..." value="<?php echo htmlspecialchars($search_term); ?>">
                <button type="submit" class="btn btn-primary ms-2"><i class="fas fa-search"></i></button>
                <?php if ($is_search): ?>
                    <a href="registrations.php" class="btn btn-danger ms-2"><i class="fas fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>
        
        <!-- Registrations Table -->
        <div class="table-container">
            <?php if ($is_search): ?>
                <div class="alert alert-info mb-3">
                    Showing results for RC number containing: <strong><?php echo htmlspecialchars($search_term); ?></strong>
                    <a href="registrations.php" class="float-end">Show all registrations</a>
                </div>
            <?php endif; ?>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Reg ID</th>
                            <th>Customer Name</th>
                            <th>Vehicle Name</th>
                            <th>RC Number</th>
                            <th>Reg Date</th>
                            <th>Print Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $formatted_reg_date = date("d/m/Y", strtotime($row['reg_date']));
                                echo "<tr>
                                    <td>{$row['SI_no']}</td>
                                    <td>{$row['cname']}</td>
                                    <td>{$row['vehicle_name']}</td>
                                    <td>{$row['rc_num']}</td>
                                    <td>{$formatted_reg_date}</td>
                                    <td>
                                        <a href='view-registration.php?id={$row['SI_no']}' class='btn btn-sm btn-primary action-btn'>
                                            <i class='fas fa-eye'></i> View
                                        </a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No registrations found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if (!$is_search && $total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>