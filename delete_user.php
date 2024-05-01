<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$userIdToDelete = $_POST["userIdToDelete"];

	// Create connection
	require_once('lib/db.php');

	// SQL query to delete user
	$sql = "DELETE FROM Users WHERE UserID='$userIdToDelete'";

	if ($conn->query($sql) === TRUE) {
		echo "User deleted successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	// Close connection
	$conn->close();
}
