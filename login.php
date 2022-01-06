<?php
session_start();
include'lapaspanelis/config.php';
?>


<!DOCTYPE html>
<html lang="lv">
<head>
<title>Pieteikties</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php 
if(!empty($_GET['message'])) {
if ($message = $_GET['message'] == 'login-required'){
	echo 'Lai pieslēgtos, nepieciešams pierakstīties!<br>';
}
}

?>
<h2>Pieteikties</h2>

<?php

if (isset($_POST["submit"])) {
//pārbaudām vai dati ir ievadīti

$sql = "SELECT * FROM users WHERE username='".$_POST["username"]."'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
  // output data of each row
  $row = $result->fetch_assoc();
  if ($row["password"]==$_POST["password"]) {
	   //lietotājs tiek ielogots
	  
	  $_SESSION["username"] = $row["username"];
	  $_SESSION["userid"] = $row["id"];
	  $_SESSION["nickname"] = $row["nickname"];
	  $_SESSION["role"] = $row["role"];
	  
	  if ($_SESSION["role"] == 'admin') {
		header('Location: lapaspanelis/index.php');
	  } else {
		  header('Location: index.php');
	  }
	  } else {
		  echo "Parole nav pareiza!<br>";
	  }
  
  
} else {
  echo "Šāds lietotājs neeksistē!";
}
}


?>




<form action="" method="POST">
<input type="text" name="username" placeholder="Ievadiet lietotājvārdu" required><br><br>
<input type="password" name="password" placeholder="Ievadiet paroli" required><br><br>
<input type="submit" name="submit" value="Pieteikties">
<a href="index.php?registration=true">Reģistrēties</a>

</form>
</body>
</html>

