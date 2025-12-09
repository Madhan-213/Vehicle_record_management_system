<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicli";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registration_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM data WHERE SI_no = $registration_id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$formatted_dob = isset($data['dob']) ? date("d/m/Y", strtotime($data['dob'])) : '';
$formatted_reg_date = isset($data['reg_date']) ? date("d/m/Y", strtotime($data['reg_date'])) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vehicle Registration Report</title>
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
      margin: 30px auto;
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .report-header {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #37535c;
    }

    .report-header h1 {
      margin: 0;
      font-size: 26px;
      color: #37535c;
    }

    .report-header p {
      margin: 5px 0 0;
      color: #666;
    }

    .section-title {
      background-color: #37535c;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      font-size: 18px;
      margin-top: 25px;
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

    @media print {
      .navbar, .actions {
        display: none;
      }

      .report-container {
        box-shadow: none;
        margin: 0;
      }
    }
  </style>
</head>
<body>


  <!-- Report Body -->
  <?php if ($data): ?>
    <div class="report-container">
      <div class="report-header">
        <h1>VEHICLE REGISTRATION REPORT</h1>
        <p>Report generated on <?php echo date("d/m/Y H:i:s"); ?></p>
      </div>

      <div class="section-title">CUSTOMER INFORMATION</div>
      <div class="detail-row"><div class="detail-label">Name:</div><div class="detail-value"><?php echo htmlspecialchars($data['cname']); ?></div></div>
      <div class="detail-row"><div class="detail-label">Date of Birth:</div><div class="detail-value"><?php echo $formatted_dob; ?></div></div>
      <div class="detail-row"><div class="detail-label">Email:</div><div class="detail-value"><?php echo htmlspecialchars($data['email']); ?></div></div>
      <div class="detail-row"><div class="detail-label">Mobile:</div><div class="detail-value"><?php echo htmlspecialchars($data['mobile']); ?></div></div>
      <div class="detail-row"><div class="detail-label">ID Proof:</div><div class="detail-value"><?php echo htmlspecialchars($data['id_proof']); ?></div></div>

      <div class="section-title">VEHICLE INFORMATION</div>
      <div class="detail-row"><div class="detail-label">Vehicle Name:</div><div class="detail-value"><?php echo htmlspecialchars($data['vehicle_name']); ?></div></div>
      <div class="detail-row"><div class="detail-label">Engine Number:</div><div class="detail-value"><?php echo htmlspecialchars($data['eng_num']); ?></div></div>
      <div class="detail-row"><div class="detail-label">RC Number:</div><div class="detail-value"><?php echo htmlspecialchars($data['rc_num']); ?></div></div>

      <div class="section-title">REGISTRATION DETAILS</div>
      <div class="detail-row"><div class="detail-label">Registration Date:</div><div class="detail-value"><?php echo $formatted_reg_date; ?></div></div>
      <div class="detail-row"><div class="detail-label">Registration ID:</div><div class="detail-value"><?php echo htmlspecialchars($data['SI_no']); ?></div></div>

      <div class="actions">
        <a href="javascript:window.print()" class="btn">Print</a>
        <a href="customer_data.php" class="btn">Back to List</a>
      </div>
    </div>
  <?php else: ?>
    <div class="report-container">
      <div class="report-header">
        <h1>No Record Found</h1>
        <p>The registration ID does not exist.</p>
      </div>
      <div class="actions">
        <a href="customer_data.php" class="btn">Back to List</a>
      </div>
    </div>
  <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
