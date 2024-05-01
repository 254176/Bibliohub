<?php
// Create connection
require_once('lib/db.php');

// Get username and password from form submission
$username = $_POST['username'];
$password = $_POST['password'];

// Query to check if the username and password match a user in the database
$sql = "SELECT * FROM Users WHERE Name='$username' AND Password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// User found, redirect to dashboard or home page
	header("Location: dashboard.php");
} else {
	// Check if the username exists
	$sql = "SELECT * FROM Users WHERE Name='$username'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// Username found, but password is incorrect
		echo "Incorrect password.";
	} else {
		// Username not found
		echo "Username not found.";
	}
}

// Close connection
$conn->close();
