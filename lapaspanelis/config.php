<?php
//pieslēgšanās informācija
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "majaslapa";

// pieslēguma izveidošana datubāzei
$conn = new mysqli($servername, $username, $password, $dbname);
// pieslēguma pārbaude
if ($conn->connect_error) {
  die("Pieslēgums neizdevās: " . $conn->connect_error);
}
?>