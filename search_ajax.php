<?php
	require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Поиск</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
	
	

	<link rel="stylesheet" href="static/style.css">

</head>
<body>
	<div class="my_search">
		<form action="" id="myform">
	        <input type="search" placeholder="Введите название страны" class="form-control" name="query" id="query">
	        <button type="submit" class="btn btn-info"  id="search_b">Найти</button> 
		</form>
    </div>
    <div class="search_result">
		<ul class="list-group main_list" id="search_result">
			
		</ul>

	</div>
    
</body>
<script src="static/ajax_search.js"></script>
<?php $link->close(); ?>
</html>