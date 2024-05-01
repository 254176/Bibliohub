<?php
$title = "User Management";
include("lib/header.php");
?>

<!-- Form for adding a user -->
<h2>Add User</h2>
<form action="add_user.php" method="post">
	<!-- Input fields for user details -->
	<label for="userId">User ID:</label>
	<input type="text" id="userId" name="userId" required>
	<br>
	<label for="role">Role:</label>
	<select id="role" name="role" required>
		<option value="standard">Standard</option>
		<option value="admin">Admin</option>
	</select>
	<br>
	<label for="name">Name:</label>
	<input type="text" id="name" name="name" required>
	<br>
	<label for="email">Email:</label>
	<input type="email" id="email" name="email" required>
	<br>
	<label for="address">Address:</label>
	<input type="text" id="address" name="address">
	<br>
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" required>
	<br>
	<button type="submit">Add User</button>
</form>

<!-- Form for updating a user -->
<h2>Update User</h2>
<form action="update_user.php" method="post">
	<!-- Input fields for user details -->
	<label for="userIdToUpdate">User ID to Update:</label>
	<input type="text" id="userIdToUpdate" name="userIdToUpdate" required>
	<br>
	<label for="newRole">New Role:</label>
	<select id="newRole" name="newRole" required>
		<option value="standard">Standard</option>
		<option value="admin">Admin</option>
	</select>
	<br>
	<label for="newName">New Name:</label>
	<input type="text" id="newName" name="newName" required>
	<br>
	<label for="newEmail">New Email:</label>
	<input type="email" id="newEmail" name="newEmail" required>
	<br>
	<label for="newAddress">New Address:</label>
	<input type="text" id="newAddress" name="newAddress">
	<br>
	<label for="newPassword">New Password:</label>
	<input type="password" id="newPassword" name="newPassword" required>
	<br>
	<button type="submit">Update User</button>
</form>
<!-- Form for deleting a user -->
<h2>Delete User</h2>
<form action="delete_user.php" method="post">
	<label for="userIdToDelete">User ID to Delete:</label>
	<input type="text" id="userIdToDelete" name="userIdToDelete" required>
	<br>
	<button type="submit">Delete User</button>
</form>

<?php
include("lib/footer.php");
?>
