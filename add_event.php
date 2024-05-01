<?php
// Create connection
require_once('lib/db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$eventID = $_POST["eventID"];
	$userID = $_POST["userID"];
	$eventDate = $_POST["eventDate"];
	$eventTitle = $_POST["eventTitle"];
	$eventDescription = $_POST["eventDescription"];

	// SQL to insert into Events
	$sql = "INSERT INTO Events (EventID, UserID, EventDate, EventTitle, EventDescription) VALUES ('$eventID', '$userID', '$eventDate', '$eventTitle', '$eventDescription')";

	if ($conn->query($sql) === TRUE) {
		echo "Event added successfully";
	} else {
		echo "Error adding event: " . $sql . "<br>" . $conn->error;
	}
}

// Close connection
$conn->close();
