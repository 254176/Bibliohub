<?php
$title = "Book Log";
include("lib/header.php");
require_once('lib/db.php');

// Select data from Books table
$sql = "SELECT * FROM Books";
$result = $conn->query($sql);

echo("<table>");
// Output data of each row
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row["ISBN"] . "</td>";
		echo "<td>" . $row["Title"] . "</td>";
		echo "<td>" . $row["Author"] . "</td>";
		echo "<td>" . $row["Genre"] . "</td>";
		echo "</tr>";
	}
} else {
	echo "<tr><td colspan='4'>0 results</td></tr>";
}
echo("</table>");
$conn->close();
