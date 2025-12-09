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
      window.location.href = 'edit-info.html'; 
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --accent: #4895ef;
            --dark: #1b263b;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }
        
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .form-title {
            color: var(--dark);
            position: relative;
            margin-bottom: 2rem;
        }
        
        .form-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
        }
        
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.2);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 8px;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .nav-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        
        .nav-btn {
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .nav-btn:hover {
            transform: translateY(-2px);
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        .section-divider {
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(72, 149, 239, 0.5), transparent);
            margin: 2rem 0;
        }
        
        .edit-icon {
            color: var(--primary);
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-gradient shadow-md py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="..\images\logo1.jpeg" alt="Logo" class="h-16 w-16 object-contain rounded-full border-2 border-white">
            <h1 class="text-white text-xl font-bold">Heritage Wheels Showroom</h1>
        </div>
        <div class="flex space-x-4">
            <a href="staff-page.html" class="text-white px-4 py-2 rounded-lg nav-btn flex items-center">
                <i class="fas fa-home mr-2"></i>
                <span>Home</span>
            </a>
            <a href="../login.php" onclick="return confirm('Are you sure you want to logout?')" class="text-white px-4 py-2 rounded-lg nav-btn flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- Main Form -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <?php if(!empty($row)) foreach($row as $rows) { ?>
        <div class="card p-8">
            <h2 class="form-title text-3xl font-bold flex items-center">
                <i class="fas fa-edit text-blue-500 mr-3"></i>
                Edit Vehicle Registration
            </h2>
            
            <form action="edit-page-script.php" method="POST">
                <!-- Client Details Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-user-edit edit-icon"></i>
                        Client Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="clientName" class="form-label">Full Name</label>
                            <input type="text" id="clientName" name="cname" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['cname']); ?>">
                        </div>
                        
                        <div>
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="form-control w-full" required value="<?php echo $rows['dob']; ?>">
                        </div>
                        
                        <div>
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['email']); ?>">
                        </div>
                        
                        <div>
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="tel" id="contactNumber" name="mobile" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['mobile']); ?>">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="idProof" class="form-label">Aadhar Card Number</label>
                            <input type="text" id="idProof" name="id_Proof" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['id_proof']); ?>">
                        </div>
                    </div>
                </div>
                
                <div class="section-divider"></div>
                
                <!-- Vehicle Details Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-car-alt edit-icon"></i>
                        Vehicle Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="vehicleName" class="form-label">Vehicle Make & Model</label>
                            <input type="text" id="vehicleName" name="vehicle_name" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['vehicle_name']); ?>">
                        </div>
                        
                        <div>
                            <label for="engineNumber" class="form-label">Engine Number</label>
                            <input type="text" id="engineNumber" name="eng_num" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['eng_num']); ?>">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="rcNumber" class="form-label">RC Number</label>
                            <input type="text" id="rcNumber" name="rc_num" class="form-control w-full" required value="<?php echo htmlspecialchars($rows['rc_num']); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit" class="submit-btn text-white text-lg px-8 py-3 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Details
                    </button>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    <script>
        // Add interactive elements
        document.querySelectorAll('.form-control').forEach(input => {
            // Add focus effect
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.form-label').classList.add('text-blue-500');
                this.parentElement.querySelector('.form-label').classList.add('font-semibold');
            });
            
            // Remove focus effect if empty
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.querySelector('.form-label').classList.remove('text-blue-500');
                    this.parentElement.querySelector('.form-label').classList.remove('font-semibold');
                }
            });
            
            // Initialize labels for pre-filled fields
            if (input.value) {
                input.parentElement.querySelector('.form-label').classList.add('text-blue-500');
                input.parentElement.querySelector('.form-label').classList.add('font-semibold');
            }
        });
    </script>
</body>
</html>