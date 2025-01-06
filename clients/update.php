<?php
require_once '../config/database.php';
require_once '../config/auth.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$result = $mysqli->query("SELECT * FROM client_info WHERE id = $id");
$client = $result->fetch_assoc();

if (!$client) {
  header("Location: index.php");
  exit();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $lname = $_POST['lname'];
  $fname = $_POST['fname'];
  $middle = $_POST['middle'];
  $address = $_POST['address'];
  $contact_no = $_POST['contact_no'];
  $no_of_pets = $_POST['no_of_pets'];
  $pet_type = $_POST['pet_type'];

  $mysqli->query("UPDATE client_info SET 
        lname='$lname', 
        fname='$fname', 
        middle='$middle', 
        address='$address', 
        contact_no='$contact_no',
        no_of_pets='$no_of_pets',
        pet_type='$pet_type'
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
  <title>Update Client - Animals at Home</title>
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
          <a href="../index.php">Home</a>
        </li>
        <li class="active">
          <a href="index.php">Clients</a>
        </li>
        <li>
          <a href="../pets/index.php">Pets</a>
        </li>
        <li>
          <a href="../appointments/index.php">Appointments</a>
        </li>
        <li>
          <a href=".../vaccination/index.php">Vaccination</a>
        </li>
      </ul>
    </nav>


    <div id="content">
      <header>
        <div class="user-menu">Admin</div>
      </header>

      <main>
        <div class="content-header">
          <h1>Update Client</h1>
        </div>


        <div class="form-container">
          <form method="POST">
            <div class="crud-form">
              <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="lname" value="<?php echo $client['lname']; ?>" required>
              </div>
              <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="fname" value="<?php echo $client['fname']; ?>" required>
              </div>
              <div class="form-group">
                <label>Middle Initial:</label>
                <input type="text" name="middle" maxlength="1" value="<?php echo $client['middle']; ?>">
              </div>
              <div class="form-group">
                <label>Address:</label>
                <textarea name="address" required><?php echo $client['address']; ?></textarea>
              </div>
              <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" name="contact_no" maxlength="11" value="<?php echo $client['contact_no']; ?>" required>
              </div>
              <div class="form-group">
                <label>Number of Pets:</label>
                <input type="number" name="no_of_pets" value="<?php echo $client['no_of_pets']; ?>" required>
              </div>
              <div class="form-group">
                <label>Pet Type:</label>
                <input type="text" name="pet_type" value="<?php echo $client['pet_type']; ?>" required>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn-submit">Update Client</button>
              <a href="index.php" class="btn-cancel">Cancel</a>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</body>

</html>