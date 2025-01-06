<?php
require_once '../config/database.php';
require_once '../config/auth.php';
//  Delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM vaccination_info WHERE petid = $id");
  $mysqli->query("DELETE FROM checkup_test WHERE petid = $id");

  
  $mysqli->query("DELETE FROM pet_info WHERE id = $id");
  header("Location: index.php");
  exit();
}


$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = '';
if ($search) {
  $where = "WHERE 
        pet_name LIKE '%$search%' OR 
        pet_type LIKE '%$search%' OR 
        pet_breed LIKE '%$search%'";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pets - Animals at Home</title>
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
            <span>Checkup Appointments</span>
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
          <h1>Pet Management</h1>
          <a href="add.php" class="btn-add">
            <i class='bx bx-plus'></i>
            <span>Add New Pet</span>
          </a>
        </div>


        <div class="search-container">
          <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search pets..." value="<?php echo htmlspecialchars($search); ?>">
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

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = $mysqli->query("SELECT * FROM pet_info $where ORDER BY pet_name");
              if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
              ?>
                  <tr>
                    <td><?php echo $row['pet_name']; ?></td>
                    <td><?php echo $row['pet_type']; ?></td>
                    <td><?php echo $row['pet_breed']; ?></td>
                    <td><?php echo $row['pet_gender']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['weight']; ?></td>
                    <td class="actions">
                      <a href="update.php?id=<?php echo $row['id']; ?>" class="btn-edit">
                        <i class='bx bx-edit'></i>
                        <span>Update</span>
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
                  <td colspan="7" class="no-records">No pets found</td>
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