<?php
$title = "Transactions";
include("lib/header.php");
require_once('lib/db.php');

// Fetch book log data from the database
$sql = "SELECT * FROM Transactions";
$result = $conn->query($sql);

// Display book log data in table rows
if ($result->num_rows > 0) {
	echo "<table>";
	echo "<tr><th>TransactionID</th><th>UserID</th><th>InventoryID</th><th>TransactionType</th><th>TransactionDate</th><th>DueDate</th><th>Status</th></tr>";
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>{$row['TransactionID']}</td>";
		echo "<td>{$row['UserID']}</td>";
		echo "<td>{$row['InventoryID']}</td>";
		echo "<td>{$row['TransactionType']}</td>";
		echo "<td>{$row['TransactionDate']}</td>";
		echo "<td>{$row['DueDate']}</td>";
		echo "<td>{$row['Status']}</td>";
		echo "</tr>";
	}
} else {
	echo "<tr><td colspan='7'>No book log entries found</td></tr>";
}

// Close connection
$conn->close();
