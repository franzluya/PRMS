<?php
require_once '../config/database.php';
require_once '../config/auth.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$result = $mysqli->query("SELECT v.*, p.pet_type, p.pet_breed, p.age, p.weight, p.med_history 
    FROM vaccination_info v 
    LEFT JOIN pet_info p ON v.petid = p.id 
    WHERE v.id = $id");
$vaccination = $result->fetch_assoc();

if (!$vaccination) {
  header("Location: index.php");
  exit();
}


$clients = $mysqli->query("SELECT id, CONCAT(fname, ' ', lname) as name FROM client_info ORDER BY lname, fname");
$pets = $mysqli->query("SELECT id, pet_name, pet_type, pet_breed, age, weight, med_history FROM pet_info ORDER BY pet_name");

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $client_id = $_POST['client_id'];
  $pet_id = $_POST['pet_id'];
  $vaccination_date = $_POST['vaccination_date'];
  $vaccine_type = $_POST['vaccine_type'];
  $vaccine_brand = $_POST['vaccine_brand'];
  $next_vaccination_date = $_POST['next_vaccination_date'];
  $notes = $_POST['notes'];
  $status = $_POST['status'];

  $mysqli->query("UPDATE vaccination_info SET 
        clientid='$client_id',
        petid='$pet_id',
        vaccination_date='$vaccination_date',
        vaccine_type='$vaccine_type',
        vaccine_brand='$vaccine_brand',
        next_vaccination_date='$next_vaccination_date',
        notes='$notes',
        status='$status'
        WHERE id=$id");

  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Vaccination - Animals at Home</title>
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
        <li>
          <a href="../appointments/index.php">
            <i class='bx bx-calendar'></i>
            <span>Checkup</span>
          </a>
        </li>
        <li class="active">
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
        </div>
      </header>

      <main>
        <div class="content-header">
          <h1>Update Vaccination Record</h1>
        </div>

        <div class="form-container" style="margin-bottom: 20px;">
          <h2>Current Pet Details</h2>
          <div class="pet-details" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 1rem;">
            <div>
              <p><strong>Type:</strong> <?php echo htmlspecialchars($vaccination['pet_type']); ?></p>
              <p><strong>Breed:</strong> <?php echo htmlspecialchars($vaccination['pet_breed']); ?></p>
              <p><strong>Age:</strong> <?php echo $vaccination['age']; ?> years</p>
            </div>
            <div>
              <p><strong>Weight:</strong> <?php echo $vaccination['weight']; ?> kg</p>
              <p><strong>Medical History:</strong> <?php echo htmlspecialchars($vaccination['med_history']); ?></p>
            </div>
          </div>
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
                    <option value="<?php echo $client['id']; ?>" <?php echo $client['id'] == $vaccination['clientid'] ? 'selected' : ''; ?>>
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
                    <option value="<?php echo $pet['id']; ?>" <?php echo $pet['id'] == $vaccination['petid'] ? 'selected' : ''; ?>>
                      <?php echo $pet['pet_name']; ?>
                      (<?php echo $pet['pet_type']; ?> - <?php echo $pet['pet_breed']; ?>)
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Vaccination Date:</label>
                <input type="date" name="vaccination_date" value="<?php echo date('Y-m-d', strtotime($vaccination['vaccination_date'])); ?>" required>
              </div>

              <div class="form-group">
                <label>Next Due Date:</label>
                <input type="date" name="next_vaccination_date" value="<?php echo date('Y-m-d', strtotime($vaccination['next_vaccination_date'])); ?>" required>
              </div>
            </div>

            <div class="form-column">
              <div class="form-group">
                <label>Vaccine Type:</label>
                <input type="text" name="vaccine_type" value="<?php echo $vaccination['vaccine_type']; ?>" required>
              </div>

              <div class="form-group">
                <label>Vaccine Brand:</label>
                <input type="text" name="vaccine_brand" value="<?php echo $vaccination['vaccine_brand']; ?>" required>
              </div>

              <div class="form-group">
                <label>Additional Notes:</label>
                <textarea name="notes"><?php echo $vaccination['notes']; ?></textarea>
              </div>

              <div class="form-group">
                <label>Status:</label>
                <select name="status" required>
                  <option value="Completed" <?php echo $vaccination['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                  <option value="Scheduled" <?php echo $vaccination['status'] == 'Scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                  <option value="Cancelled" <?php echo $vaccination['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
              </div>
            </div>

            <div class="form-actions full-width">
              <button type="submit" class="btn-submit">
                <i class='bx bx-save'></i>
                <span>Update Vaccination</span>
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