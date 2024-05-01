<?php
$title = "User Login";
include("lib/header.php");
?>

<form action="login.php" method="post">
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" required>

	<label for="password">Password:</label>
	<input type="password" id="password" name="password" required>

	<input type="submit" value="Login">
</form>
<h2>User Log</h2>
<table border="1">
	<tr>
		<th>User ID</th>
		<th>Role</th>
		<th>Name</th>
		<th>Email</th>
		<th>Address</th>
		<th>Password</th>
	</tr>
	<?php
	require_once('lib/db.php');

	// Select data from Users table
	$sql = "SELECT * FROM Users";
	$result = $conn->query($sql);

	// Output data of each row
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["UserID"] . "</td>";
			echo "<td>" . $row["Role"] . "</td>";
			echo "<td>" . $row["Name"] . "</td>";
			echo "<td>" . $row["Email"] . "</td>";
			echo "<td>" . $row["Address"] . "</td>";
			echo "<td>" . $row["Password"] . "</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='6'>0 results</td></tr>";
	}
	$conn->close();
	?>
</table>

<?php
include("lib/footer.php");
?>
