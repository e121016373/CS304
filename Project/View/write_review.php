<?php 
include "../Controller/DB.php";
include "../Controller/Applicants.php";
?>
<link rel="stylesheet" type="text/css" href="template4.css"/>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<?php 
if(isset($_POST['write_review'])) {
  $companyName = $_POST['write_review'];
  $rate = $_POST['star'];
  $comment = $_POST['comment'];
  if(writeReview($companyName, $rate, $comment)) {
    header("Location:Dashboard_applicant.php?view_my_schedule=");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Write Reviews</title>
</head>

<body>
	<h1 style="background-color:transparent;margin-left:auto;margin-right:auto;display:block;margin-top:4%;margin-bottom:0%; border-radius: 12px; color: orange; font-size: 30px;text-align: center">
		<?php
		echo "You are now reviewing " . $_POST['review'];
		?>
	</h1>
	<form action = "write_review.php" method = "post">
		<label for="rate">Rate</label>
    <div class="stars" id = rate>

    <input class="star star-5" id="star-5" type="radio" name="star" value=5 />

    <label class="star star-5" for="star-5"></label>

    <input class="star star-4" id="star-4" type="radio" name="star" value = 4/>

    <label class="star star-4" for="star-4"></label>

    <input class="star star-3" id="star-3" type="radio" name="star" value = 3/>

    <label class="star star-3" for="star-3"></label>

    <input class="star star-2" id="star-2" type="radio" name="star" value = 2/>

    <label class="star star-2" for="star-2"></label>

    <input class="star star-1" id="star-1" type="radio" name="star" value = 1/>

    <label class="star star-1" for="star-1"></label>
    </div>

		<br>

		<label for="comment">Comment</label>
		<textarea id="comment" type="text" name="comment"></textarea>

		<!-- <input type="submit" name="submit" style="background-color:#4CAF50;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; b color: white; font-size: 13px;border-radius: 12px"> -->
    <button type="submit" name="write_review" style="background-color:#4CAF50;margin-left:auto;margin-right:auto;display:block;margin-top:2%;margin-bottom:0%; b color: white; font-size: 13px;border-radius: 12px" value= <?php echo "\"" . $_POST['review'] . "\""; ?>>Submit</button>

		
	</form>

</body>
</html>