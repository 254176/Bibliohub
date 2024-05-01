<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$userId = $_POST["userId"];
	$role = $_POST["role"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$password = $_POST["password"];

	// Create connection
	require_once('lib/db.php');

	// SQL query to insert user
	$sql = "INSERT INTO Users (UserID, Role, Name, Email, Address, Password) VALUES ('$userId', '$role', '$name', '$email', '$address', '$password')";
	if ($conn->query($sql) === TRUE) {
		echo "New user added successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	// Close connection
	$conn->close();
}
