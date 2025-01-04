<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animals at Home Veterinary Clinic & Supplies</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <img src="./images/aah-logo.jpg" alt="Clinic Logo" class="logo">
        <div class="clinic-info">
          <h3>Animals at Home</h3>
          <p>Veterinary Clinic & Supplies</p>
        </div>
      </div>
      <ul class="nav-links">
        <li class="active">
          <a href="index.php">
            <i class='bx bx-home'></i>
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="clients/index.php">
            <i class='bx bx-group'></i>
            <span>Clients</span>
          </a>
        </li>
        <li>
          <a href="./pets/index.php">
            <i class='bx bxs-dog'></i>
            <span>Pets</span>
          </a>
        </li>
        <li>
          <a href="./appointments/index.php">
            <i class='bx bx-calendar'></i>
            <span>Appointments</span>
          </a>
        </li>
        <li>
          <a href="./vaccination/index.php">
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
        <div class="welcome-section">
          <h1>Animals at Home</h1>
          <h2>Veterinary Clinic & Supplies</h2>
          <div class="clinic-details">
            <div>
              <i class='bx bx-map'></i>
              <span>123 Main Street, Cityville, State 12345</span>
            </div>
            <div>
              <i class='bx bx-phone'></i>
              <span>(123) 456-7890</span>
            </div>
            <div>
              <i class='bx bx-envelope'></i>
              <span>info@animalsathome.com</span>
            </div>
          </div>
        </div>

        <div class="stats-grid">
          <div class="stat-card">
            <i class='bx bx-dog'></i>
            <h3>Total Pets</h3>
            <p class="stat-number">150</p>
            <p class="stat-label">Registered Pets</p>
          </div>
          <div class="stat-card">
            <i class='bx bx-group'></i>
            <h3>Clients</h3>
            <p class="stat-number">120</p>
            <p class="stat-label">Active Clients</p>
          </div>
          <div class="stat-card">
            <i class='bx bx-calendar'></i>
            <h3>Appointments</h3>
            <p class="stat-number">25</p>
            <p class="stat-label">Scheduled Today</p>
          </div>
          <div class="stat-card">
            <i class='bx bx-injection'></i>
            <h3>Vaccinations</h3>
            <p class="stat-number">300</p>
            <p class="stat-label">This Month</p>
          </div>
        </div>

        <div class="quick-actions">
          <h2>Quick Actions</h2>
          <div class="action-buttons">
            <a href="appointments.php?action=new" class="action-button">
              <i class='bx bx-calendar-plus'></i>
              <span>New Appointment</span>
            </a>
            <a href="pets.php?action=register" class="action-button">
              <i class='bx bx-plus-circle'></i>
              <span>Register Pet</span>
            </a>
            <a href="clients/add.php" class="action-button">
              <i class='bx bx-user-plus'></i>
              <span>Add Client</span>
            </a>
            <a href="vaccination.php?action=new" class="action-button">
              <i class='bx bx-injection'></i>
              <span>Record Vaccination</span>
            </a>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="js/script.js"></script>
</body>

</html>