<?php
	require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Страны</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

</head>

<?php
	$result = $link->query("SELECT * FROM countries;"); 
?>
<body>
	<div class="city">
	<h1>Страны</h1>
	<ul>
	<?php 
		while($country = mysqli_fetch_assoc($result)) {
		    echo "<li>".$country['country']."</li>";
		}
	?>
	</ul>
	</div>
</body>
</html>