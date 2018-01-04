<?php
	require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Поиск</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="static/style.css">

</head>
<body>
	<div class="my_search" method="GET">
    	<form action="">
        <input type="search" placeholder="Введите название города" class="form-control" name="query">
        <button type="submit" class="btn btn-info">Найти</button> 
        </form>   
    </div>
    <?php if(isset($_GET['query'])): ?>
	<div class="search_result">
		<ul class="list-group main_list">
		<?php
			$get_search = $_GET['query'];

			$per_page = 5;
			$cur_page = 1;
			if (isset($_GET['page']) && $_GET['page'] > 0) 
			{
			    $cur_page = $_GET['page'];
			}
			$start = ($cur_page - 1) * $per_page;

			$pk_mas = [];
			$search_q = '%'.$_GET['query'].'%';
			$result1 = $link->prepare("SELECT * FROM countries WHERE country LIKE ?");
			$result1->bind_param("s", $search_q);  
			$result1->execute();
			$result1->bind_result($country_id, $country_name);

			while($result1->fetch()) {
		    	array_push($pk_mas,$country_id);
			};

			$my_query = "SELECT * FROM cities WHERE ";
			
			if (sizeof($pk_mas)){
				$my_query .= "pk_country=".$pk_mas[0]." ";
				foreach ($pk_mas as  $key => $value) {
					if ($key != 0) {
						$my_query .= " OR pk_country=$value ";
					}
				    
				};
				$result2=$link->query($my_query); 
				$rows = $result2->num_rows;

				$my_query .= "LIMIT $start, $per_page";
				$result2 = $link->query($my_query);
				while($city = mysqli_fetch_assoc($result2)) {
				    echo "<li class='list-group-item'>".$city['city']."</li>";
				}
				$num_pages = ceil($rows / $per_page);
				$page = 0;
			} else {
				echo "Ничего не найдено";
			}

			
		?>
		</ul>
		<?php if (sizeof($pk_mas)): ?>
		<nav>
		<ul class="pagination">
		<?php if ($cur_page>1): ?>
			<li class="page-item"><a href="?page=<?=$cur_page-1?>&query=<?=$get_search?>" class="page-link">Предыдущая</a></li>
		<?php endif ?>	
		<?php while ($page++ < $num_pages): ?>
		<?php if ($page == $cur_page): ?>
		<li class="page-item disabled"><a href="" class="page-link"><?=$page?></a></li>
		<?php else: ?> 
		<li class="page-item"><a href="?page=<?=$page?>&query=<?=$get_search?>" class="page-link"><?=$page?></a></li>
		<?php endif ?> 
		<?php endwhile ?>

		<?php if ($cur_page<$num_pages): ?>
			<li class="page-item"><a href="?page=<?=$cur_page+1?>&query=<?=$get_search?>" class="page-link">Следущая</a></li>
		<?php endif ?> 
		</ul>
		</nav>
		<?php endif ?>
	</div>
	<?php endif ?>
</body>
<?php $link->close(); ?>
</html>