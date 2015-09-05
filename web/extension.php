<?php
	import 'awsScript.php';
	if (!is_null($_POST["url"])) {
		$url = $_POST["url"];
	}
	itemLookup($url); 
?>