<?php 
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	
	$counter = 0;
	$db = new mysqli('localhost', "ericineo_kartful", "Penn123!", 'ericineo_kartful');
	$query = "SELECT * FROM userProducts";
	
	$result = $db -> query($query);
	$rows = $result -> fetch_array();
	while ($rows) {
		$counter++;
		$rows =	$result -> fetch_array();
	}
	echo $counter;
?>