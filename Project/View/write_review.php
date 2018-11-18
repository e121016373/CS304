<!DOCTYPE html>
<html>
<head>
	<title>Write Reviews</title>
</head>
<body>
	<h1>
		<?php
		echo "You are now reviewing " . $_POST['review'];
		?>
	</h1>
	<form action = "write_review.php" method = "post">
		<label for="rate">Rate</label>
		<input id="rate" type="number" name="rate" min="0" max="10" required>

		<br>

		<label for="comment">Comment</label>
		<textarea id="comment" type="text" name="comment"></textarea>

		<input type="submit" name="submit">

		
	</form>

</body>
</html>