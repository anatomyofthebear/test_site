<?php
	require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Страны</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="static/style.css">

</head>

<?php
	$result = $link->query("SELECT * FROM countries;"); 
?>
<body>
	<div class="countries">
	<h1>Страны</h1>
	<div class="dropdown">
	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Выберете страну
	</button>
	<ul class="dropdown-menu">
	<?php 
		while($country = mysqli_fetch_assoc($result)) {
		    echo "<li class=''><a href=?city=".$country['id'].">".$country['country']."</a></li>";
		}
	?>
	</ul>
	</div>
	</div>
	<?php if(isset($_GET['city'])): ?>
	<div class="cities">
		<h1>Города</h1>
		<ul class="list-group main_list">
		<?php 
			$result1 = $link->prepare("SELECT * FROM cities WHERE pk_country=?");
			$result1->bind_param("d", $_GET['city']);  
			$result1->execute();
			$result1->bind_result($city_id, $city_name, $country_pk); 

			while($result1->fetch()) {
		    	echo "<li class='list-group-item'>".$city_name."</li>";
			}


		 ?>
		</ul>
	</div>
	<?php endif; ?>
</body>
</html>