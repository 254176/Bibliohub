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
    $isbnToUpdate = $_POST["isbnToUpdate"];
    $newTitle = $_POST["newTitle"];
    $newAuthor = $_POST["newAuthor"];
    $newGenre = $_POST["newGenre"];

    // SQL to update book
    $sql = "UPDATE Books SET Title='$newTitle', Author='$newAuthor', Genre='$newGenre' WHERE ISBN='$isbnToUpdate'";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Book updated successfully";
        } else {
            echo "Error: ISBN to update does not exist";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();