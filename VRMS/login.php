
<?php
session_start();
include "config.php";

if (isset($_POST["submit"])) {
    $u_name = mysqli_real_escape_string($con, $_POST["user_name"]);
    $u_pass = mysqli_real_escape_string($con, $_POST["user_pass"]);


     // Check staff credentials in database
    $sql = "SELECT uid, uname FROM user WHERE uname='{$u_name}' AND upass='{$u_pass}'";
    $res = $con->query($sql);

    $sql1="select a_name,a_pass from admin where a_name='{$u_name}' and a_pass='{$u_pass}'";
    $res1= $con->query($sql1);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
            // Set session variables
            $_SESSION["user_id"] = $row["u_id"];
            $_SESSION["user_name"] = $row["u_name"];
            // Redirect to home page
            header("Location: staff\staff-page.html");
            exit();
         } else if (($res1->num_rows > 0)) {
            $_SESSION["user_id"] = $row["a_name"];
            header("location: admin\admin.php");
            exit();
         }
         else {
        $login_error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-image: url(https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background-color: rgba(245, 245, 245, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            height: 80px;
            width: 80px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert-danger {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="logo-container">
            <img src="images\logo1.jpeg" alt="Company Logo">
        </div>
        
        <h2 class="text-center mb-4">Login <h6 class="text-center mb-4">(For Admin and Staffs Only)</h6></h2>
        
        <?php if(isset($login_error)): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?php echo $login_error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="user_name" class="form-label">
                    <i class="fas fa-user me-2"></i>Username
                </label>
                <input type="text" class="form-control" id="user_name" name="user_name" 
                       placeholder="Enter username" required autofocus>
            </div>
            
            <div class="mb-4">
                <label for="user_Pass" class="form-label">
                    <i class="fas fa-lock me-2"></i>Password
                </label>
                <input type="password" class="form-control" id="user_Pass" name="user_pass" 
                       placeholder="Enter password" required>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </div>
            
            <div class="text-center mt-3">
                <a href="index.html" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i>Back to Home
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>