<?php
session_start();
include 'config.php';

if (!isset($_SESSION["username"])){
	header('Location: ../login.php?message=login-required');
}

if ((isset($_SESSION["role"]))&&($_SESSION["role"]=="user")) {
	//pārbaudām, vai lietotājs ir administrators
	header('Location: ../index.php');
} else {
	
?>
<!DOCTYPE html>
<html lang="lv">
<head>
<title>Panelis</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'header.php';

if(empty($_GET['open'])) {

 ?>
<h2>Šis ir administratora panelis. Jūs esat pieteicies kā 
<?php echo $_SESSION["username"]; ?>!</h2>
<a href="../logout.php">Izrakstīties</a>

<?php
} else {

switch ($_GET['open']) {
  case "users":
    include 'users.php';
    break;
  case "pages":
    include 'pages.php';
    break; 
}
}

} //beidzas pārbaude, vai lietotājs ir administrators
?>

</body>
</html>

