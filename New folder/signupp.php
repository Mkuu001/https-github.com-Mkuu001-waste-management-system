<?php

// Connect to the database.
$db = new PDO('mysql:host=localhost;dbname=signup', 'root', '');

// Get the user input.
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists in the database.
$sql = 'SELECT * FROM users WHERE username = ? AND password = ?';
$stmt = $db->prepare($sql);
$stmt->execute([$username, $password]);

// If the user exists, log them in.
if ($stmt->rowCount() > 0) {
  // Get the user information.
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // Set the session variables.
  $_SESSION['username'] = $row['username'];
  $_SESSION['logged_in'] = true;

  // Redirect the user to the home page.
  header('Location: /');
} else {
  // The user does not exist, show an error message.
  echo 'Invalid username or password.';
}

?>