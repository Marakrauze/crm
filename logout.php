<?php
		session_start();
		session_unset();   
	    session_destroy();  
		header('Location: index.php?message=logout');

		?>
		
<!DOCTYPE html>
<html lang="lv">
<head>
<title>Logout</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

</body>
</html>
