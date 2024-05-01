<?php
require_once('config.php');
try {
	$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
}

catch (mysqli_sql_exception $e) {
	die( $e->getMessage() );
}
?>
