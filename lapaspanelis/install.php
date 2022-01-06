<?php
include'config.php';


// pārbaudām, vai tabula 'users' eksiste
$result = $conn->query("SHOW TABLES LIKE 'users'");
	if( $result->num_rows == 1 ) {
		echo "Tabula 'users' jau eksistē!<br>";
	} else {


// sql to create table
$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
nickname VARCHAR(30),
email VARCHAR(50),
role VARCHAR(10) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Tabula 'users' ir vieksmīgi izveidota!<br>";
} else {
  echo "Kļūda veidojot tabulu 'users':" . $conn->error . "<br>";
}
	}


// pārbaudām, vai tabula 'pages' eksiste
$result = $conn->query("SHOW TABLES LIKE 'pages'");
	if( $result->num_rows == 1 ) {
		echo "Tabula 'pages' jau eksistē!<br>";
	} else {


// sql to create table
$sql = "CREATE TABLE pages (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Tabula 'pages' ir vieksmīgi izveidota!<br>";
} else {
  echo "Kļūda veidojot tabulu 'pages':" . $conn->error . "<br>";
}


// noklusētā lietotāja 'admin' ievietošana tabulā 'users'
$sql = "INSERT INTO users (username, password, nickname, email, role)
VALUES ('admin', '12345', 'Administrators', 'admin@localhost.lv','admin')";

if ($conn->query($sql) === TRUE) {
  echo "Lietotājs veiksmīgi reģistrēts!<br>";
} else {
  echo "Kļūda reģistrējot lietotāju: " . $sql . "<br>" . $conn->error;
}




//TABULAS MESSAGES IZVEIDOŠANA
//pārbaudām, vai tabula "messages" eksistē
$result = $conn->query("SHOW TABLES LIKE 'messages'");
if( $result->num_rows > 0 ) {
echo "Tabula 'messages' jau eksistē!<br>";	
} else {

// sql to create table
$sql = "CREATE TABLE messages (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
subject VARCHAR(255) NOT NULL,
message TEXT,
sender INT(6) NOT NULL,
reciever INT(6) NOT NULL,
opened varchar(5),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Tabula 'messages' ir veiksmīgi izveidota!<br>";
} else {
  echo "Kļūda veidojot tabulu 'messages': " . $conn->error . "<br>";
}



	} // beidzas pārbaude, vai tabula 'users' eksistē
	
	
	

	
$conn->close();
?>

