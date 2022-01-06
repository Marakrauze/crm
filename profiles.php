<h2>Lietotāju profili</h2>
<?php
//lietotāju profili
$sql = "SELECT * FROM users WHERE NOT id=".$_SESSION['userid'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  echo "<ul class='lietotaji'>";
  while($row = $result->fetch_assoc()) {
    echo '<li><a href="index.php?send=true&reciever='.$row["id"].'">Sūtīt vēstuli</a> '.$row["nickname"].'</li>';
  }
  echo "</ul>";
}
?>