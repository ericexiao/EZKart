<?php
	$db = new mysqli('localhost', "ericineo_kartful", "Penn123!", 'ericineo_kartful');
	if (mysqli_connect_errno())
	{
		echo "Connection Error!";
		return;
	}
	
	$stmt = $db->stmt_init();
    if ($stmt->prepare("SELECT productURL, productName, price, imageURL FROM userProducts")){
   		$stmt->execute();
   		$stmt->bind_result($productURL, $productName, $price, $imageURL);

   		while($stmt->fetch()) {
   			echo ("<a style=\"display:block\" href=\" . $productURL . \">\n");
   			echo "<div class = \"square\">\n";
   			echo ("<h1>" . $productName . "</h1>\n");
   			echo ("<h2>" . $price . "</h2>\n");
   			echo ("<hr></hr>\n");
   			echo ("img class = \"square\" style = \"height:80%; width:80%\" src = \" . $imageURL . \"\n");
   			echo ("</div>\n");
   			echo ("</a\n");
   		}
    }
    mysqli_close($db);
?>