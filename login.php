<?php
session_start();

// Check if already logged in
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = $mysqli->query("SELECT * FROM admin WHERE username = '$username'");

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($password === $user['password']) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['fullname'] = $user['fname'] . ' ' . $user['lname'];
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid password";
    }
  } else {
    $error = "User not found";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Animals at Home</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 20px;
    }

    .login-container {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin-bottom: 1rem;
    }

    .login-header h1 {
      font-size: 1.5rem;
      color: #333;
      margin: 0;
    }

    .login-header p {
      color: #666;
      margin: 0.5rem 0 0;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: #333;
      font-weight: 500;
    }

    .form-group input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
    }

    .form-group input:focus {
      border-color: #4a90e2;
      outline: none;
      box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
    }

    .error-message {
      color: #dc3545;
      font-size: 0.875rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    .btn-login {
      background: #2563eb;
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.2s;
    }

    .btn-login:hover {
      background: #1d4ed8;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <img src="images/aah-logo.jpg" alt="Animals at Home Logo">
      <h1>Animals at Home</h1>
      <p>Veterinary Clinic & Supplies</p>
    </div>

    <?php if ($error): ?>
      <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" class="login-form">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit" class="btn-login">
        <i class='bx bx-log-in'></i>
        Login
      </button>
    </form>
  </div>
</body>

</html>