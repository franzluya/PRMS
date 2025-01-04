<?php
require_once '../config/database.php';

// Handle Delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM checkup_test WHERE id = $id");
  header("Location: index.php");
}

// Handle Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = '';
if ($search) {
  $where = "WHERE 
        a.appointment_date LIKE '%$search%' OR 
        p.pet_name LIKE '%$search%' OR 
        CONCAT(c.fname, ' ', c.lname) LIKE '%$search%' OR 
        a.reason LIKE '%$search%'";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkup Appointments - Animals at Home</title>
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
        <li class="active">
          <a href="index.php">
            <i class='bx bx-calendar'></i>
            <span>Checkup</span>
          </a>
        </li>
        <li>
          <a href="../vaccination.php">
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
          <h1>Checkup Appointments</h1>
          <a href="add.php" class="btn-add">
            <i class='bx bx-plus'></i>
            <span>New Checkup</span>
          </a>
        </div>

        <!-- Search Form -->
        <div class="search-container">
          <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search checkup appointments..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn-search">
              <i class='bx bx-search'></i>
              <span>Search</span>
            </button>
            <?php if ($search): ?>
              <a href="index.php" class="btn-clear">
                <i class='bx bx-x'></i>
                <span>Clear</span>
              </a>
            <?php endif; ?>
          </form>
        </div>

        <!-- Appointments List -->
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Date & Time</th>
                <th>Client Name</th>
                <th>Pet Name</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = $mysqli->query("
                                SELECT 
                                    a.*, 
                                    p.pet_name,
                                    CONCAT(c.fname, ' ', c.lname) as client_name
                                FROM checkup_test a
                                LEFT JOIN pet_info p ON a.petid = p.id
                                LEFT JOIN client_info c ON a.clientid = c.id
                                $where
                                ORDER BY a.appointment_date DESC
                            ");
              if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
              ?>
                  <tr>
                    <td><?php echo date('M d, Y h:i A', strtotime($row['appointment_date'])); ?></td>
                    <td><?php echo $row['client_name']; ?></td>
                    <td><?php echo $row['pet_name']; ?></td>
                    <td><?php echo $row['reason']; ?></td>
                    <td>
                      <span class="status-badge <?php echo strtolower($row['status']); ?>">
                        <?php echo $row['status']; ?>
                      </span>
                    </td>
                    <td class="actions">
                      <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">
                        <i class='bx bx-edit'></i>
                        <span>Edit</span>
                      </a>
                      <a href="?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">
                        <i class='bx bx-trash'></i>
                        <span>Delete</span>
                      </a>
                    </td>
                  </tr>
                <?php
                endwhile;
              else:
                ?>
                <tr>
                  <td colspan="6" class="no-records">No appointments found</td>
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