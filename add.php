<?php
	
	include "config/db_connect.php";


	$title = $email = $ingredients = "";
	$errors = array("email" => "", "title" => "", "ingredients" => "");
	if(isset($_POST["submit"])) {
		// POST check
		if(empty($_POST["email"])) {
			$errors['email'] = "An Email is required <br />";
		} else {
			$email = $_POST["email"];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = "Email must be a valid email";
			}
		}
		if(empty($_POST["title"])) {
			$errors['title'] = "A Title is required <br />";
		} else {
			$title = $_POST["title"];
			if(!preg_match("/^[a-zA-Z\s]+$/", $title)) {
				$errors['title'] = "Title must be letters and spaces only";
			}
		}
		if(empty($_POST["ingredients"])) {
			$errors['ingredients'] = "Ingredients are required <br />";
		} else {
			$ingredients = $_POST["ingredients"];
			if(!preg_match("/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/", $ingredients)) {
				$errors['ingredients'] = "Ingredients must be a comma-separated list";
			}
		}

		if(array_filter($errors)) {
			// Errors in the form
		} else {
			// No errors in the form
			$email = mysqli_real_escape_string($conn, $email);
			$title = mysqli_real_escape_string($conn, $title);
			$ingredients = mysqli_real_escape_string($conn, $ingredients);
			$sql = "INSERT INTO pizzas (email, title, ingredients) VALUES('$email', '$title', '$ingredients')";
			if(!mysqli_query($conn, $sql)) {
				echo "Error: ". $sql. "<br>". mysqli_error($conn);
			} else {
				header("Location: index.php");
			}
			$title = $ingredients = $email = "";
		}
		// End of POST check
	}
?>

<!DOCTYPE html>
<html lang="en">
	<?php require './templates/header.php' ?>

	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form action="add.php" class="white" method="POST">
			<label for="">Your Email</label>
			<input type="text" name="email" id="" value="<?php echo htmlspecialchars($email) ?>" >
			<div class="red-text"><?php echo $errors['email'] ?></div>

			<label for="">Pizza Title</label>
			<input type="text" name="title" id="" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title'] ?></div>

			<label for="">Ingredients (comma separated)</label>
			<input type="text" name="ingredients" id="" value="<?php echo htmlspecialchars($ingredients) ?>">
			<div class="red-text"><?php echo $errors['ingredients'] ?></div>

			<div class="center">
				<input class="btn brand z-depth-0" type="submit" name="submit" value="submit" id="">
			</div>
		</form>

	</section>

	<?php require './templates/footer.php' ?>

</html>