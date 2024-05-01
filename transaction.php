<?php
// Create connection
require_once('lib/db.php');

// Check if form is submitted for transaction
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$isbn = $_POST["isbn"];
	$transactionType = $_POST["transactionType"];
	$transactionID = $_POST["transactionID"];
	$userID = $_POST["userID"];
	$inventoryID = $_POST["inventoryID"];

	// Check if the user has already borrowed or returned the same book
	$sql_check = "SELECT * FROM Transactions WHERE UserID = $userID AND InventoryID = $inventoryID ORDER BY TransactionDate DESC LIMIT 1";
	$result = $conn->query($sql_check);
	if ($result->num_rows > 0) {
		$lastTransaction = $result->fetch_assoc();
		if ($lastTransaction["TransactionType"] == $transactionType) {
			echo "You cannot perform the same transaction twice in a row.";
			exit;
		}
	}

	// Prepare the SQL statement based on transaction type
	if ($transactionType == 1) {
		// Borrow transaction: Remove ISBN from Inventory
		$sql_inventory = "DELETE FROM Inventory WHERE ISBN = '$isbn'";
		$transactionStatus = 0;
	} elseif ($transactionType == 2) {
		// Return transaction: Add ISBN to Inventory
		$sql_inventory = "INSERT INTO Inventory (ISBN, TransactionID) VALUES ('$isbn','$transactionID')";
		$transactionStatus = 1;
	} else {
		// Invalid transaction type
		echo "Invalid transaction type";
		exit; // Stop execution
	}

	// Execute SQL statement for Inventory transaction
	if ($conn->query($sql_inventory) !== TRUE) {
		echo "Error: " . $sql_inventory . "<br>" . $conn->error;
		exit; // Stop execution
	}

	// Insert into Transactions table
	$sql_transactions = "INSERT INTO Transactions (UserID, InventoryID, TransactionType, TransactionDate, DueDate, Status)
       VALUES ($userID, $inventoryID, '$transactionType', NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), $transactionStatus)";
	echo "Transaction Successful";
	if ($conn->query($sql_transactions) !== TRUE) {
		echo "Error: " . $sql_transactions . "<br>" . $conn->error;
		exit; // Stop execution
	}
}

// Close connection
$conn->close();
