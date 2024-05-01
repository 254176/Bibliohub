<?php
$title = "Dashboard";
include("lib/header.php");
?>

<h2>Book Transaction</h2>
<form action="transaction.php" method="post">
	<label for="isbn">ISBN:</label>
	<input type="text" id="isbn" name="isbn" required><br>
	<label for="inventoryID">inventoryID:</label>
	<input type="text" id="inventoryID" name="inventoryID" required><br>
	<label for="transactionID">transactionID:</label>
	<input type="text" id="transactionID" name="transactionID" required><br>
	<label for="userID">userID:</label>
	<input type="text" id="userID" name="userID" required><br>
	<label for="transactionType">Transaction Type:</label>
	<select id="transactionType" name="transactionType" required>
		<option value="1">Borrow</option>

		<option value="2">Return</option>
	</select><br>

	<button type="submit">Submit Transaction</button>
</form>

<h2>Book Log</h2>
<table border="1">
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Author</th>
		<th>Genre</th>
	</tr>
	<?php
	// Create connection
	require_once('lib/db.php');

	// Select data from Books table
	$sql = "SELECT * FROM Books";
	$result = $conn->query($sql);

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
	?>
</table>
<h2>Inventory Log</h2>
<table border="1">
	<tr>
		<th>InventoryID</th>
		<th>ISBN</th>
		<th>TransactionID</th>
	</tr>
	<?php
	// Select data from Inventory table
	$sql = "SELECT * FROM Inventory";
	$result = $conn->query($sql);

	// Output data of each row
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["InventoryID"] . "</td>";
			echo "<td>" . $row["ISBN"] . "</td>";
			echo "<td>" . $row["TransactionID"] . "</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='3'>0 results</td></tr>";
	}
	?>
</table>
<h2>Transaction Log</h2>
<table border="1">
	<tr>
		<th>TransactionID</th>
		<th>UserID</th>
		<th>InventoryID</th>
		<th>TransactionType</th>
		<th>TransactionDate</th>
		<th>DueDate</th>
		<th>Status</th>
	</tr>
	<?php
	// Select data from Transactions table
	$sql = "SELECT * FROM Transactions";
	$result = $conn->query($sql);

	// Output data of each row
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["TransactionID"] . "</td>";
			echo "<td>" . $row["UserID"] . "</td>";
			echo "<td>" . $row["InventoryID"] . "</td>";
			echo "<td>" . $row["TransactionType"] . "</td>";
			echo "<td>" . $row["TransactionDate"] . "</td>";
			echo "<td>" . $row["DueDate"] . "</td>";
			echo "<td>" . $row["Status"] . "</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='7'>0 results</td></tr>";
	}
	$conn->close()
	?>
</table>

<?php
include("lib/footer.php");
?>
