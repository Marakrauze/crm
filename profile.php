<?php 
$edit = true; 
?>
<h2>Mans profils</h2>
<?php
if ((isset($_GET["message"]))&&($_GET["message"]=="success")) {echo "Dati tika veiksmīgi atjaunināti!<br><br>";}
$e=false; //pieņemam, ka nav ievades kļūdu
if (isset($_POST['submit'])) {
//pārbaudām, vai forma aizpildīta


//pārbaude, vai tādi paši dati jau nav datubāzē reģistrēti
$e1=false; $e2=false; $e3=false; //kļūdu kodi sākumā ir false;
//pārbaudām, vai datubāzē jau nav tāds pats username
$sql = "SELECT * FROM users WHERE username='".$_POST["username"]."'";
if ($edit) {$sql = $sql." AND NOT id= ".$_SESSION["userid"]; }
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e1 = true;
  echo "Šāds lietotājvārds jau eksistē!<br><br>";
} 
//pārbaudām, vai datubāzē jau nav tāds pats nicname
$sql = "SELECT * FROM users WHERE nicname='".$_POST["nicname"]."'";
if ($edit) {$sql = $sql." AND NOT id= ".$_SESSION["userid"]; }
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e2 = true;
  echo "Šāds segvārds jau eksistē!<br><br>";
} 
//pārbaudām, vai datubāzē jau nav tāds pats email
$sql = "SELECT * FROM users WHERE email='".$_POST["email"]."'";
if ($edit) {$sql = $sql." AND NOT id= ".$_SESSION["userid"]; }
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e3 = true;
  echo "Šāda e-pasta adrese jau eksistē!<br><br>";
}

if (($e1)||($e2)||($e3)) {
	$e=true; //tiek fiksēta dublēšanās kļūda
} else { //ja dati nedublējas, tad liekam datubāzē
//beidzas pārbaude, vai nedublējas dati

if ($edit) {
$sql="UPDATE users
SET username = '".$_POST["username"]."', password= '".$_POST["password"]."', nickname='".$_POST["nickname"]."', email='".$_POST["email"]."' WHERE id = ".$_SESSION["userid"];
} else {
//ievietošana datubāzē
$sql = "INSERT INTO users (username, password, nickname, email, role)
VALUES ('".$_POST["username"]."', '".$_POST["password"]."', '".$_POST["nickname"]."', '".$_POST["email"]."', '".$_POST["role"]."')";
}	
	
if ($conn->query($sql) === TRUE) {

	$_SESSION["username"] = $_POST["username"];
	$_SESSION["nickname"] = $_POST["nickname"];
	header('Location: index.php?profile=true&message=success');
	
  if ($edit) {echo "Lietotāja dati veiksmīgi atjaunināti!<br><br>";} 
	else {echo "Lietotājs veiksmīgi reģistrēts!<br><br>";}
} else {
  echo "Kļūda: " . $sql . "<br><br>" . $conn->error;
}

} //beidzas ievietošana datubāzē
} //beidzas pārbaude, vai forma aizpildīta

if ($edit) { //ja ir rediģēšanas režīms
	
$sql = "SELECT * FROM users WHERE id='".$_SESSION["userid"]."'";
// no db paņemam to lietotāju, kam id sakrīt ar to, kas saitē pie edit
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  //iegūstam rediģējamā lietotāja datus
  $row = $result->fetch_assoc();
	
}
}
?>
<form action="" method="POST">
<input type="text" name="username" placeholder="Ievadiet lietotājvārdu" value="<?php if ($e) {echo $_POST["username"];} elseif ($edit) {echo $row['username'];} ?>
" required><br><br>
<input type="text" name="nickname" placeholder="Ievadiet segvārdu" value="<?php if ($e) {echo $_POST["nickname"];} elseif ($edit) {echo $row['nickname'];}?>" required><br><br>
<input type="text" name="email" placeholder="Ievadiet e-pastu" value="<?php if ($e) {echo $_POST["email"];} elseif ($edit) {echo $row['email'];}?>" required><br><br>
<input type="password" name="password" placeholder="Ievadiet paroli" value="<?php if ($e) {echo $_POST["password"];} elseif ($edit) {echo $row['password'];}?>" required><br><br>

<input type="submit" name="submit" value="Atjaunināt datus">
</form>
