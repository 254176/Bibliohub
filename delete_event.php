<?php

// Database connection parameters
$servername = "localhost";
$username = "veom-mysql";
$password = "nemade777";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $eventIdToDelete = $_POST["eventIdToDelete"];

    // SQL to delete event
    $sql = "DELETE FROM Events WHERE EventID='$eventIdToDelete'";

    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error deleting event: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();