
<div id="header">
<h1>Mājaslapas publiskā daļa</h1>
<?php

if (!empty($_GET['message'])) {
	if  ($_GET['message'] == 'logout') {
	echo '<p>Izrakstīts</p>';
	}
}

if (isset($_SESSION["username"])) {
	echo "<div id='userinfo'>Sveiki , ",$_SESSION["nickname"],"!";
	echo "<a href='index.php?profile=true'>Mans profils    </a>";
	echo "<a href='index.php?inbox=true'>Ienākošās vēstules</a></div>";
}

?>


<div id ="menu">
<ul>
<?php

$sql = "SELECT * FROM pages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<li><a href="index.php?id=',$row["id"],'">',$row["title"],'</a></li>';
  }
} else {
  echo "0 results";

}

?>


  <?php if ((isset($_SESSION["role"]))&&($_SESSION["role"]=='admin')) {?>
  <li style="float:right"><a href="lapaspanelis/index.php">Administrēt</a></li> 
  <?php } ?>
  <li style="float:right"><?php if (isset($_SESSION["username"])) {echo "<a href='logout.php'>Atteikties</a>";} else {echo "<a href='login.php'>Pieteikties</a>";} ?></li>
	<li style="float:right"><a href="index.php?profiles=true">Lietotāju profili</a></li> 
	<li style="float:right"><a href="index.php?search=true">Meklēt</a></li>
</ul>
</div>
</div>

 