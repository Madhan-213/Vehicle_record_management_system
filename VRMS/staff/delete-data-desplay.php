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

    // declaring array to store the data
    $row = [];

    if ($result->num_rows > 0) {
        // fetch all data from db into array
        $row = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<script>
        alert('Vehicle details not found!');
        window.location.href = 'delete-data.php'; 
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --danger: #ef233c;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .nav-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        
        .card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .data-table {
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .data-table th {
            background-color: var(--primary);
            color: white;
            position: sticky;
            top: 0;
        }
        
        .data-table th, 
        .data-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .data-table tr:last-child td {
            border-bottom: none;
        }
        
        .data-table tr:hover td {
            background-color: #f8f9fa;
        }
        
        .delete-btn {
            background-color: var(--danger);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .delete-btn:hover {
            background-color: #d90429;
            transform: translateY(-1px);
        }
        
        .no-results {
            background-color: #fff8f8;
            border-left: 4px solid var(--danger);
        }
        
        @media (max-width: 768px) {
            .data-table th, 
            .data-table td {
                padding: 0.5rem;
                font-size: 0.875rem;
            }
            
            .delete-btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-gradient shadow-md py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="..\images\logo1.jpeg" alt="Logo" class="h-14 w-14 object-contain rounded-full border-2 border-white">
            <h1 class="text-white text-xl font-bold">Heritage Wheels Showroom</h1>
        </div>
        <div class="flex space-x-4">
            <a href="staff-page.html" class="text-white px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition flex items-center">
                <i class="fas fa-home mr-2"></i>
                <span>Home</span>
            </a>
            <a href="../login.php" onclick="return confirm('Are you sure you want to logout?')" class="text-white px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-search text-blue-500 mr-2"></i>
                Vehicle Search Results
            </h1>
            <p class="text-gray-600">Review and manage vehicle registration details</p>
        </div>

        <div class="card p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-car text-blue-500 mr-2"></i>
                    Vehicle Records
                </h2>
                <div class="text-sm text-gray-500">
                    <?php echo count($row); ?> record(s) found
                </div>
            </div>

            <?php if (!empty($row)): ?>
            <div class="table-container">
                <table class="data-table w-full">
                    <thead>
                        <tr>
                            <th class="rounded-tl-lg">#</th>
                            <th>Customer</th>
                            <th>DOB</th>
                            <th>Email</th>
                            <th>ID Proof</th>
                            <th>Mobile</th>
                            <th>Vehicle</th>
                            <th>Engine No.</th>
                            <th>RC Number</th>
                            <th>Reg. Date</th>
                            <th class="rounded-tr-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $data): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['SI_no']); ?></td>
                            <td><?php echo htmlspecialchars($data['cname']); ?></td>
                            <td><?php echo htmlspecialchars($data['dob']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td><?php echo htmlspecialchars($data['id_proof']); ?></td>
                            <td><?php echo htmlspecialchars($data['mobile']); ?></td>
                            <td><?php echo htmlspecialchars($data['vehicle_name']); ?></td>
                            <td><?php echo htmlspecialchars($data['eng_num']); ?></td>
                            <td><?php echo htmlspecialchars($data['rc_num']); ?></td>
                            <td><?php echo htmlspecialchars($data['reg_date']); ?></td>
                            <td>
                                <form method='POST' action='delete.php' onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type='hidden' name='rc_num' value='<?php echo htmlspecialchars($data['rc_num']); ?>'>
                                    <button type='submit' class="delete-btn">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="no-results p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                    <div>
                        <h3 class="font-medium text-gray-800">No records found</h3>
                        <p class="text-sm text-gray-600">Try searching with different criteria</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <a href="delete-data.php" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Search
            </a>
        </div>
    </div>

    <script>
        // Add any interactive functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight row on hover
            const rows = document.querySelectorAll('.data-table tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f9fa';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
</body>
</html>