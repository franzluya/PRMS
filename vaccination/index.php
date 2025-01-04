<?php
require_once '../config/database.php';

// Handle Delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM vaccination_info WHERE id = $id");
  header("Location: index.php");
  exit();
}

// Handle Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = '';
if ($search) {
  $where = "WHERE 
        c.fname LIKE '%$search%' OR 
        c.lname LIKE '%$search%' OR 
        p.pet_name LIKE '%$search%' OR 
        p.pet_type LIKE '%$search%' OR 
        p.pet_breed LIKE '%$search%' OR 
        v.vaccine_type LIKE '%$search%' OR 
        v.status LIKE '%$search%'";
}

// Get vaccinations with client and pet info
$query = "SELECT v.*, 
    CONCAT(c.fname, ' ', c.lname) as client_name,
    p.pet_name, p.pet_type, p.pet_breed, p.age, p.weight, p.med_history
    FROM vaccination_info v
    LEFT JOIN client_info c ON v.clientid = c.id
    LEFT JOIN pet_info p ON v.petid = p.id
    $where
    ORDER BY v.vaccination_date DESC";

$vaccinations = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccinations - Animals at Home</title>
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
          <h1>Vaccination Records</h1>
          <a href="add.php" class="btn-add">
            <i class='bx bx-plus'></i>
            <span>New Vaccination</span>
          </a>
        </div>

        <!-- Search Form -->
        <div class="search-container">
          <form method="GET" class="search-form">
            <div class="search-group">
              <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by client, pet, type, breed, or vaccine...">
              <button type="submit">
                <i class='bx bx-search'></i>
              </button>
            </div>
          </form>
        </div>

        <!-- Vaccinations Table -->
        <div class="table-container">
          <table class="data-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Pet Name</th>
                <th>Type/Breed</th>
                <th>Age/Weight</th>
                <th>Vaccine Info</th>
                <th>Next Due</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($vaccinations->num_rows > 0): ?>
                <?php while ($vaccination = $vaccinations->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo date('M d, Y', strtotime($vaccination['vaccination_date'])); ?></td>
                    <td><?php echo htmlspecialchars($vaccination['client_name']); ?></td>
                    <td><?php echo htmlspecialchars($vaccination['pet_name']); ?></td>
                    <td>
                      <?php echo htmlspecialchars($vaccination['pet_type']); ?><br>
                      <small><?php echo htmlspecialchars($vaccination['pet_breed']); ?></small>
                    </td>
                    <td>
                      <?php echo $vaccination['age']; ?> years<br>
                      <small><?php echo $vaccination['weight']; ?> kg</small>
                    </td>
                    <td>
                      <?php echo htmlspecialchars($vaccination['vaccine_type']); ?><br>
                      <small><?php echo htmlspecialchars($vaccination['vaccine_brand']); ?></small>
                    </td>
                    <td><?php echo date('M d, Y', strtotime($vaccination['next_vaccination_date'])); ?></td>
                    <td>
                      <span class="status-badge <?php echo strtolower($vaccination['status']); ?>">
                        <?php echo $vaccination['status']; ?>
                      </span>
                    </td>
                    <td class="actions">
                      <a href="edit.php?id=<?php echo $vaccination['id']; ?>" class="btn-edit" title="Edit">
                        <i class='bx bx-edit'></i>
                      </a>
                      <a href="?delete=<?php echo $vaccination['id']; ?>" class="btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this vaccination record?');">
                        <i class='bx bx-trash'></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="9" class="no-records">No vaccination records found.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</body>

</html>