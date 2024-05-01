<?php
// Create connection
require_once('lib/db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$title = $_POST["title"];
	$author = $_POST["author"];
	$genre = $_POST["genre"];
	$isbn = $_POST["isbn"];
	$transactionID = $_POST["transactionID"];
	// SQL to insert new book
	$sql_book = "INSERT INTO Books (ISBN, Title, Author, Genre) VALUES ('$isbn', '$title', '$author', '$genre')";

	if ($conn->query($sql_book) === TRUE) {
		echo "New book added successfully";

		// SQL to insert new inventory entry with the same ISBN
		$sql_inventory = "INSERT INTO Inventory (ISBN,TransactionID) VALUES ('$isbn','$transactionID')";
		if ($conn->query($sql_inventory) === TRUE) {
			echo " and added to inventory successfully";
		} else {
			echo "Error adding book to inventory: " . $sql_inventory . "<br>" . $conn->error;
		}
	} else {
		echo "Error adding book: " . $sql_book . "<br>" . $conn->error;
	}
}

// Close connection
$conn->close();
