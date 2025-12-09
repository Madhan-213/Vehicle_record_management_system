
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle Data </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
            --success-color: #27ae60;
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
        
        /* Main Content */
        .main-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .page-title {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--accent-color);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: rgb(240, 12, 12);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        
        .submit-btn:hover {
            background-color:rgb(109, 48, 48);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        
        .instructions {
            background-color: #f8f9fa;
            border-left: 4px solid var(--accent-color);
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }
        
        .instructions p {
            margin: 0;
            color: #666;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            color: #666;
            font-size: 14px;
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
            
            .main-container {
                margin: 20px auto;
                padding: 0 15px;
            }
            
            .form-container {
                padding: 20px;
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
                <a href="../login.php" class="nav-btn" onclick="return confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </nav>
    </header>
    
    <!-- Main Content -->
    <div class="main-container">
        <div class="form-container">
            <h2 class="page-title">Detele Vehile Data</h2>
            
            <div class="instructions">
                <p><i class="fas fa-info-circle"></i> Enter the vehicle RC number to Delete Vehicle details.</p>
            </div>
            
            <form action="delete-data-desplay.php" method="POST" id="editForm">
                <div class="form-group">
                    <label for="rcNumber" class="form-label">Vehicle RC Number</label>
                    <input type="text" id="rcNumber" name="rc_num" class="form-input" 
                           placeholder="Enter RC Number(e.g. RC996472)" required>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-search"></i> Search Vehicle
                </button>
            </form>
        </div>
        
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> Heritage Wheels Showroom. All rights reserved.</p>
        </div>
    </div>
    
    <script>
        // Enhanced logout confirmation
        function confirmLogout() {
            if(confirm('Are you sure you want to logout?')) {
                window.location.href = '../login.php';
            }
            return false;
        }
        
        // Form validation
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const rcNumber = document.getElementById('rcNumber').value.trim();
            if(rcNumber === '') {
                alert('Please enter a valid RC Number');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>