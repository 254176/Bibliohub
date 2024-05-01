<?php
// Create connection
require_once('lib/db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$isbnToDelete = $_POST["isbnToDelete"];

	// SQL to delete book
	$sql = "DELETE FROM Books WHERE ISBN='$isbnToDelete'";

	if ($conn->query($sql) === TRUE) {
		if ($conn->affected_rows > 0) {
			echo "Book deleted successfully";
		} else {
			echo "Error: ISBN to delete does not exist";
		}
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// Close connection
$conn->close();
