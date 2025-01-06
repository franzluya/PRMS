<?php
require_once '../config/database.php';
require_once '../config/auth.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$result = $mysqli->query("SELECT * FROM pet_info WHERE id = $id");
$pet = $result->fetch_assoc();

if (!$pet) {
  header("Location: index.php");
  exit();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pet_type = $_POST['pet_type'];
  $pet_breed = $_POST['pet_breed'];
  $pet_name = $_POST['pet_name'];
  $pet_gender = $_POST['pet_gender'];
  $pet_color = $_POST['pet_color'];
  $dob = $_POST['dob'];
  $age = $_POST['age'];
  $weight = $_POST['weight'];
  $med_history = $_POST['med_history'];

  $mysqli->query("UPDATE pet_info SET 
        pet_type='$pet_type',
        pet_breed='$pet_breed',
        pet_name='$pet_name',
        pet_gender='$pet_gender',
        pet_color='$pet_color',
        dob='$dob',
        age='$age',
        weight='$weight',
        med_history='$med_history'
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
  <title>Update Pet - Animals at Home</title>
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
        <li class="active">
          <a href="index.php">
            <i class='bx bxs-dog'></i>
            <span>Pets</span>
          </a>
        </li>
        <li>
          <a href="../appointments/index.php">
            <i class='bx bx-calendar'></i>
            <span>Appointments</span>
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
        </div>
      </header>

      <main>
        <div class="content-header">
          <h1>Update Pet</h1>
        </div>

        <div class="form-container">
          <form method="POST">
            <div class="crud-form">
              <div class="form-group">
                <label>Pet Name:</label>
                <input type="text" name="pet_name" value="<?php echo $pet['pet_name']; ?>" required>
              </div>
              <div class="form-group">
                <label>Pet Type:</label>
                <input type="text" name="pet_type" value="<?php echo $pet['pet_type']; ?>" required>
              </div>
              <div class="form-group">
                <label>Breed:</label>
                <input type="text" name="pet_breed" value="<?php echo $pet['pet_breed']; ?>" required>
              </div>
              <div class="form-group">
                <label>Gender:</label>
                <select name="pet_gender" required>
                  <option value="">Select Gender</option>
                  <option value="Male" <?php echo $pet['pet_gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo $pet['pet_gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label>Color:</label>
                <input type="text" name="pet_color" value="<?php echo $pet['pet_color']; ?>" required>
              </div>
              <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="dob" value="<?php echo date('Y-m-d', strtotime($pet['dob'])); ?>" required>
              </div>
              <div class="form-group">
                <label>Age:</label>
                <input type="text" name="age" value="<?php echo $pet['age']; ?>" required>
              </div>
              <div class="form-group">
                <label>Weight:</label>
                <input type="text" name="weight" value="<?php echo $pet['weight']; ?>" required>
              </div>
              <div class="form-group">
                <label>Medical History:</label>
                <textarea name="med_history"><?php echo $pet['med_history']; ?></textarea>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn-submit">
                <i class='bx bx-save'></i>
                <span>Update Pet</span>
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