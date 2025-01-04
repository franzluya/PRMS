<?php
require_once '../config/database.php';

// Get clients and pets for dropdowns
$clients = $mysqli->query("SELECT id, CONCAT(fname, ' ', lname) as name FROM client_info ORDER BY lname, fname");
$pets = $mysqli->query("SELECT id, pet_name, pet_type, pet_breed, age, weight, med_history FROM pet_info ORDER BY pet_name");

// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $client_id = $_POST['client_id'];
  $pet_id = $_POST['pet_id'];
  $vaccination_date = $_POST['vaccination_date'];
  $vaccine_type = $_POST['vaccine_type'];
  $vaccine_brand = $_POST['vaccine_brand'];
  $next_vaccination_date = $_POST['next_vaccination_date'];
  $notes = $_POST['notes'];
  $status = $_POST['status'];

  $mysqli->query("INSERT INTO vaccination_info 
        (clientid, petid, vaccination_date, vaccine_type, vaccine_brand, next_vaccination_date, notes, status) 
        VALUES 
        ('$client_id', '$pet_id', '$vaccination_date', '$vaccine_type', '$vaccine_brand', '$next_vaccination_date', '$notes', '$status')");

  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Vaccination - Animals at Home</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
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
        <li>
          <a href="../appointments/index.php">
            <i class='bx bx-calendar'></i>
            <span>Checkup</span>
          </a>
        </li>
        <li class="active">
          <a href="index.php">
            <i class='bx bx-injection'></i>
            <span>Vaccination</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
      <header>
        <div class="user-menu">
          <i class='bx bx-user'></i>
          <span>Admin</span>
        </div>
      </header>

      <main>
        <div class="content-header">
          <h1>Record New Vaccination</h1>
        </div>

        <!-- Vaccination Form -->
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
                      (<?php echo $pet['pet_type']; ?> - <?php echo $pet['pet_breed']; ?>)
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Vaccination Date:</label>
                <input type="date" name="vaccination_date" required>
              </div>

              <div class="form-group">
                <label>Next Due Date:</label>
                <input type="date" name="next_vaccination_date" required>
              </div>
            </div>

            <div class="form-column">
              <div class="form-group">
                <label>Vaccine Type:</label>
                <input type="text" name="vaccine_type" required>
              </div>

              <div class="form-group">
                <label>Vaccine Brand:</label>
                <input type="text" name="vaccine_brand" required>
              </div>

              <div class="form-group">
                <label>Additional Notes:</label>
                <textarea name="notes"></textarea>
              </div>

              <div class="form-group">
                <label>Status:</label>
                <select name="status" required>
                  <option value="Completed">Completed</option>
                  <option value="Scheduled">Scheduled</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
            </div>

            <div class="form-actions full-width">
              <button type="submit" class="btn-submit">
                <i class='bx bx-plus'></i>
                <span>Record Vaccination</span>
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