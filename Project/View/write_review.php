
<link rel="stylesheet" type="text/css" href="template4.css"/>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<!DOCTYPE html>
<html>
<head>
	<title>Write Reviews</title>
</head>
<style>

div.stars {

  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {

  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }
label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 30px;text-align: center">
		<?php
		echo "You are now reviewing " . $_POST['review'];
		?>
	</h1>
	<form action = "write_review.php" method = "post">
		<label for="rate">Rate</label>
		<div class="stars">

  <form action="">

    <input class="star star-5" id="star-5" type="radio" name="star"/>

    <label class="star star-5" for="star-5"></label>

    <input class="star star-4" id="star-4" type="radio" name="star"/>

    <label class="star star-4" for="star-4"></label>

    <input class="star star-3" id="star-3" type="radio" name="star"/>

    <label class="star star-3" for="star-3"></label>

    <input class="star star-2" id="star-2" type="radio" name="star"/>

    <label class="star star-2" for="star-2"></label>

    <input class="star star-1" id="star-1" type="radio" name="star"/>

    <label class="star star-1" for="star-1"></label>

  </form>

</div>


		<br>

		<label for="comment">Comment</label>
		<textarea id="comment" type="text" name="comment"></textarea>

		<input type="submit" name="submit" style="background-color:#4CAF50;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; b color: white; font-size: 13px;border-radius: 12px">

		
	</form>

</body>
</html>