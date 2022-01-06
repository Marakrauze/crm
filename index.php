<?php
session_start();
include'lapaspanelis/config.php';

?>


<!DOCTYPE html>
<html lang="lv">
<head>
<title>Mājaslapa</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'header.php'; 

if (isset($_GET["login"])) { //nepieciešama ielogošanās
	include 'login.php';	
} elseif (isset($_GET["registration"])) { //reģistrācija
	include 'registration.php';
} elseif (isset($_GET["profile"])) { 
	include 'profile.php';
} elseif (isset($_GET["profiles"])) { 
	include 'profiles.php';
} elseif (isset($_GET["send"])) { 
	include 'send.php';
} elseif (isset($_GET["inbox"])) { //visi lietotāju profili
	include 'inbox.php';	
} elseif (isset($_GET["search"])) { //visi lietotāju profili
	include 'search.php';	
} 


else



{
//sākas lapu satura drukāšana
if (isset($_GET["id"])) { $id=$_GET["id"]; } 
	else { $id = 1;} 
$sql = "SELECT * FROM pages WHERE id=".$id;
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  // output data of each row
  $row = $result->fetch_assoc();
	echo "<h2>",$row["title"],"</h2>";
    echo $row["content"];
} else {
  echo "0 results";
}

} // beidzas lapu satura drukāšana
?>

</body>
</html>
