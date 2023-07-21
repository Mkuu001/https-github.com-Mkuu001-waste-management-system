<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>
<?php

// Connect to the database. I BELIEVE THE BELOW CODE WAS WRONG

$db = new PDO('localhost','root', ','signup');

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

  // Redirect the user to the home page. WHAT IS THE LINK TO YOUR HOME?
  header('Location: /');
} else {
  // The user does not exist, show an error message.
  echo 'Invalid username or password.';
}

?>


	<h1>Registration Form</h1>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="username">Username:</label>
		<input type="text" name="username" required><br>

		<label for="password">Password:</label>
		<input type="password" name="password" required><br>

		<input type="submit" value="Submit">
	</form>

</body>
</html>
