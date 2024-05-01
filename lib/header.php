<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo($title . ' — ' . ((null !== SITETITLE) ? SITETITLE : "BiblioHub")) ?></title>
		<link rel="stylesheet" type="text/css" href="res/style.css">
	</head>


	<body>
		<header>
			<nav>
				<ul>
					<li><a href="dashboard.php"><h1><?php echo ((null !== SITETITLE) ? SITETITLE : "BiblioHub") ?></h1></a></li>
					<li><a href="book_management.php">Books</a></li>

					<!-- Admin menu items. -->
					<?php
					if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
					?>
						<li><a href="book_management.php">Inventory</a></li>
						<li><a href="user_management.php">Users</a></li>
						<li><a href="logs.php" >Logs</a></li>
					<?php } ?>
				</ul>

				<?php if (isset($_SESSION['user'])) { ?>
					<div><a href="logout.php">Logout</a></div>
				<?php } else { ?>
					<div><a href="user_login.php">Login</a></div>
				<?php } ?>
			</nav>
			<h2><?php echo $title ?></h2>
		</header>

		<main>
