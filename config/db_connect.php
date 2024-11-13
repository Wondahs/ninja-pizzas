<?php 
	$conn = mysqli_connect("localhost", "wondahs", "wondahs", "ninja_pizza");

	if (!$conn) {
		echo "Connection error: {$mysqli_connect_error()}";
	}
?>