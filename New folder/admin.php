
<?php
// Connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";
//THIS IS CORRECT COMPARE WITH SIGN UP $CONN -TEST AS I HAVE CHANGED
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert a new admin -POST
$sql = "INSERT INTO admin (username, password) VALUES ('admin', 'password')";
if ($conn->query($sql) === TRUE) {
  echo "New admin created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
