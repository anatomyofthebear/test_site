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
	$per_page = 5;
	$cur_page = 1;
	if (isset($_GET['page']) && $_GET['page'] > 0) 
	{
	    $cur_page = $_GET['page'];
	}
	$start = ($cur_page - 1) * $per_page;

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
	<?php if(isset($_GET['city']) and $_GET['city']>0 ): ?>
	<div class="cities">
		<h1>Города</h1>
		<ul class="list-group main_list">
		<?php
			$city = $_GET['city'];
			$city;
			$result1 = $link->prepare("SELECT * FROM cities WHERE pk_country=?");
			$result1->bind_param("d", $_GET['city']);  
			$result1->execute();
			$result1->store_result(); 
			$rows = $result1->num_rows;

			$five_cities = $link->prepare("SELECT * FROM cities WHERE pk_country=? LIMIT ?, ?");
			$five_cities->bind_param("ddd", $_GET['city'], $start, $per_page);
			$five_cities->execute();
			$five_cities->bind_result($city_id, $city_name, $country_pk);
			
			while($five_cities->fetch()) {
		    	echo "<li class='list-group-item'>".$city_name."</li>";
			};


			$num_pages = ceil($rows / $per_page);
			$page = 0;

		 ?>
		</ul>
		<nav>
		<ul class="pagination">
		<?php if ($cur_page>1): ?>
			<li class="page-item"><a href="?page=<?=$cur_page-1?>&city=<?=$city?>" class="page-link">Предыдущая</a></li>
		<?php endif ?>	
		<?php while ($page++ < $num_pages): ?>
		<?php if ($page == $cur_page): ?>
		<li class="page-item disabled"><a href="" class="page-link"><?=$page?></a></li>
		<?php else: ?> 
		<li class="page-item"><a href="?page=<?=$page?>&city=<?=$city?>" class="page-link"><?=$page?></a></li>
		<?php endif ?> 
		<?php endwhile ?>

		<?php if ($cur_page<$num_pages): ?>
			<li class="page-item"><a href="?page=<?=$cur_page+1?>&city=<?=$city?>" class="page-link">Следущая</a></li>
		<?php endif ?> 
		</ul>
		</nav>
	</div>
	<?php endif; ?>


</body>
<?php $link->close(); ?>
</html>