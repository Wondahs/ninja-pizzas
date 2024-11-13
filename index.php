<?php
	include "config/db_connect.php";

	// SQL query
	$sql = "SELECT title, ingredients, id FROM pizzas ORDER BY created_at DESC";

	// Getting result from SQL database
	$result = mysqli_query($conn, $sql);

	// Fetching all rows as associative arrays and storing them in the $pizzas array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Freeing the result set and closing the connection to the database
	mysqli_free_result($result);
	mysqli_close($conn);

	// Printing the fetched data as an associative array for testing purposes. You can replace this with your own HTML/CSS/JS code.
	// print_r($pizzas);

	// explode(",", $pizzas[0]["ingredients"]);

?>

<!DOCTYPE html>
<html lang="en">
	<?php require './templates/header.php' ?>
	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			<?php foreach($pizzas as $pizza): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza["title"]) ?></h6>
							<l>
								<?php foreach(explode(",", $pizza["ingredients"]) as $ingredients): ?>
									<li><?php echo htmlspecialchars($ingredients)?></li>
								<?php endforeach; ?>
							</ul>
							<div class="card-action right-align">
								<a href="#" class="brand-text">More Info</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php require './templates/footer.php' ?>

</html>