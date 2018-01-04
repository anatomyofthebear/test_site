<?php 
require_once 'db_connect.php';

$country_q = '%'.$_POST['query'].'%';
$pk_mas = [];
$city_mas = [];

$per_page = 5;
$cur_page = 1;
if (isset($_POST['page']) && $_POST['page'] > 0) 
{
    $cur_page = $_POST['page'];
}
$start = ($cur_page - 1) * $per_page;

$result1 = $link->prepare("SELECT * FROM countries WHERE country LIKE ?");
$result1->bind_param("s", $country_q);  
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

if (sizeof($pk_mas)){
	echo "<nav>";
	echo '<ul class="pagination">';
	if ($cur_page>1){
			echo '<li class="page-item"><a href="#" class="page-link click-page" id='.($cur_page-1).'>Предыдущая</a></li>';
	};
	while ($page++ < $num_pages) {
		
		if($page == $cur_page){
			echo '<li class="page-item disabled">'.'<a href="#" class="page-link click-page" id='.$page.'>'.$page.'</a></li>';
		} else {
			echo '<li class="page-item">'.'<a href="#" class="page-link click-page" id='.$page.'>'.$page.'</a></li>';
		}
	}
	if ($cur_page<$num_pages){
			echo '<li class="page-item"><a href="#" class="page-link click-page" id='.($cur_page+1).'>Следующая</a></li>';
	};
}

 ?>