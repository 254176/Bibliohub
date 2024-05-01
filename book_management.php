<?php
$title = "Book Management";
include("lib/header.php");
?>

<!-- Form for adding a book -->
<h2>Add Book</h2>
<form action="add_book.php" method="post" id="addBookForm">
	<label for="title">Title:</label>
	<input type="text" id="title" name="title" required>
	<br>

	<label for="author">Author:</label>
	<input type="text" id="author" name="author" required>
	<br>

	<label for="genre">Genre:</label>
	<input type="text" id="genre" name="genre" required>
	<br>
	<label for="transactionID">TransactionID:</label>
	<input type="text" id="transactionID" name="transactionID" required>
	<br>
	<label for="isbn">ISBN:</label>
	<input type="text" id="isbn" name="isbn" required>
	<span id="isbnError" class="error"></span> <!-- Error message container -->
	<br>

	<button type="submit">Add Book</button>
</form>

<!-- Form for updating a book -->
<h2>Update Book</h2>
<form action="update_book.php" method="post" id="updateBookForm">
	<label for="isbnToUpdate">ISBN to Update:</label>
	<input type="text" id="isbnToUpdate" name="isbnToUpdate" required>
	<span id="isbnToUpdateError" class="error"></span> <!-- Error message container -->
	<br>

	<!-- Input fields for new book details -->
	<label for="newTitle">New Title:</label>
	<input type="text" id="newTitle" name="newTitle" required>
	<br>

	<label for="newAuthor">New Author:</label>
	<input type="text" id="newAuthor" name="newAuthor" required>
	<br>

	<label for="newGenre">New Genre:</label>
	<input type="text" id="newGenre" name="newGenre" required>
	<br>

	<button type="submit">Update Book</button>
</form>

<!-- Form for deleting a book -->
<h2>Delete Book</h2>
<form action="delete_book.php" method="post" id="deleteBookForm">
	<label for="isbnToDelete">ISBN to Delete:</label>
	<input type="text" id="isbnToDelete" name="isbnToDelete" required>
	<span id="isbnToDeleteError" class="error"></span> <!-- Error message container -->
	<br>

	<button type="submit">Delete Book</button>
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
	$conn->close();
	?>
</table>
<script>
 // JavaScript validation for ISBN field in Add Book form
 document.getElementById('addBookForm').addEventListener('submit', function(event) {
	 var isbnInput = document.getElementById('isbn');
	 var isbnError = document.getElementById('isbnError');

	 if (isbnInput.value.length !== 9) {
		 isbnError.textContent = "ISBN must be 9 digits long";
		 event.preventDefault(); // Prevent form submission
	 } else {
		 isbnError.textContent = ""; // Clear error message if ISBN is valid
	 }
 });

 // JavaScript validation for ISBN field in Update Book form
 document.getElementById('updateBookForm').addEventListener('submit', function(event) {
	 var isbnToUpdateInput = document.getElementById('isbnToUpdate');
	 var isbnToUpdateError = document.getElementById('isbnToUpdateError');

	 if (isbnToUpdateInput.value.length !== 9) {
		 isbnToUpdateError.textContent = "ISBN must be 9 digits long";
		 event.preventDefault(); // Prevent form submission
	 } else {
		 isbnToUpdateError.textContent = ""; // Clear error message if ISBN is valid
	 }
 });

 // JavaScript validation for ISBN field in Delete Book form
 document.getElementById('deleteBookForm').addEventListener('submit', function(event) {
	 var isbnToDeleteInput = document.getElementById('isbnToDelete');
	 var isbnToDeleteError = document.getElementById('isbnToDeleteError');

	 if (isbnToDeleteInput.value.length !== 9) {
		 isbnToDeleteError.textContent = "ISBN must be 9 digits long";
		 event.preventDefault(); // Prevent form submission
	 } else {
		 isbnToDeleteError.textContent = ""; // Clear error message if ISBN is valid
	 }
 });
</script>

	</body>
</html>
