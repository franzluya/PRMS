<?php
require_once '../config/database.php';
require_once '../config/auth.php';


$clients = $mysqli->query("SELECT id, CONCAT(fname, ' ', lname) as name FROM client_info ORDER BY lname, fname");
$pets = $mysqli->query("SELECT id, pet_name FROM pet_info ORDER BY pet_name");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $client_id = $_POST['client_id'];
  $pet_id = $_POST['pet_id'];
  $appointment_date = $_POST['appointment_date'];
  $appointment_time = $_POST['appointment_time'];
  $reason = $_POST['reason'];
  $notes = $_POST['notes'];
  $status = $_POST['status'];

  $datetime = $appointment_date . ' ' . $appointment_time;

  $mysqli->query("INSERT INTO checkup_test 
        (clientid, petid, appointment_date, reason, notes, status) 
        VALUES 
        ('$client_id', '$pet_id', '$datetime', '$reason', '$notes', '$status')");

  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Checkup - Animals at Home</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="wrapper">

    <nav id="sidebar">
      <div class="sidebar-header">
        <img src="../images/aah-logo.jpg" alt="Clinic Logo" class="logo">
        <div class="clinic-info">
          <h3>Animals at Home</h3>
          <p>Veterinary Clinic & Supplies</p>
        </div>
      </div>
      <ul class="nav-links">
        <li>
          <a href="../index.php">
            <i class='bx bx-home'></i>
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="../clients/index.php">
            <i class='bx bx-group'></i>
            <span>Clients</span>
          </a>
        </li>
        <li>
          <a href="../pets/index.php">
            <i class='bx bxs-dog'></i>
            <span>Pets</span>
          </a>
        </li>
        <li class="active">
          <a href="index.php">
            <i class='bx bx-calendar'></i>
            <span>Checkup</span>
          </a>
        </li>
        <li>
          <a href="../vaccination/index.php">
            <i class='bx bx-injection'></i>
            <span>Vaccination</span>
          </a>
        </li>
      </ul>
    </nav>


    <div id="content">
      <header>
        <div class="user-menu">
          <i class='bx bx-user'></i>
          <span>Admin</span>
          <a href="../logout.php" class="btn-logout" title="Logout">
            <i class='bx bx-log-out'></i>
          </a>
        </div>
      </header>

      <main>
        <div class="content-header">
          <h1>Schedule New Checkup</h1>
        </div>


        <div class="form-container">
          <form method="POST" class="crud-form two-columns">
            <div class="form-column">
              <div class="form-group">
                <label>Client:</label>
                <select name="client_id" required>
                  <option value="">Select Client</option>
                  <?php while ($client = $clients->fetch_assoc()): ?>
                    <option value="<?php echo $client['id']; ?>">
                      <?php echo $client['name']; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Pet:</label>
                <select name="pet_id" required>
                  <option value="">Select Pet</option>
                  <?php while ($pet = $pets->fetch_assoc()): ?>
                    <option value="<?php echo $pet['id']; ?>">
                      <?php echo $pet['pet_name']; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Checkup Date:</label>
                <input type="date" name="appointment_date" required>
              </div>

              <div class="form-group">
                <label>Time:</label>
                <input type="time" name="appointment_time" required>
              </div>
            </div>

            <div class="form-column">
              <div class="form-group">
                <label>Reason for Checkup:</label>
                <textarea name="reason" required></textarea>
              </div>

              <div class="form-group">
                <label>Additional Notes:</label>
                <textarea name="notes"></textarea>
              </div>

              <div class="form-group">
                <label>Status:</label>
                <select name="status" required>
                  <option value="Scheduled">Scheduled</option>
                  <option value="Confirmed">Confirmed</option>
                  <option value="Completed">Completed</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
            </div>

            <div class="form-actions full-width">
              <button type="submit" class="btn-submit">
                <i class='bx bx-plus'></i>
                <span>Schedule Checkup</span>
              </button>
              <a href="index.php" class="btn-cancel">
                <i class='bx bx-x'></i>
                <span>Cancel</span>
              </a>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</body>

</html>