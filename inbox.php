<?php

if ((isset ($_GET["message"]))&&(!empty($_GET["message"]))) {
	
	echo "<h2></h2>"
	
	
} else {

echo "<h2>Ienākošās vēstules</h2>";
$sql = "SELECT id, subject, sender, created_at FROM messages 
	WHERE reciever='".$_SESSION["userid"]."'";
$result = $conn->query($sql);

if( $result->num_rows > 0) {
  // output data of each row
  $i = 1;
  while($row = $result->fetch_assoc() ) {
	
    echo $i.") Autors: ".$row["sender"]. " Laiks: " . $row["created_at"]. "<br>";
	echo "Temats: <a href='index.php?inbox=true&message=".$row["id"]."'>".$row["subject"]."</a><br><br>";
	$i++;
	}
} else {
  echo "Nav ienākošo vēstuļu!";
}

}
$conn->close();
?>