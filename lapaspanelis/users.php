<?php 
if (isset($_GET["edit"])) { $edit = true; } 
	else { $edit = false; } 
?>
<h2><?php if($edit) {echo "Rediģēt";} else {echo "Pievienot";} ?> lietotāju</h2>
<?php
$e=false; //pieņemam, ka nav ievades kļūdu
if (isset($_POST['submit'])) {
//pārbaudām, vai forma aizpildīta


//pārbaude, vai tādi paši dati jau nav datubāzē reģistrēti
$e1=false; $e2=false; $e3=false; //kļūdu kodi sākumā ir false;
//pārbaudām, vai datubāzē jau nav tāds pats username
$sql = "SELECT * FROM users WHERE username='".$_POST["username"]."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e1 = true;
  echo "Šāds lietotājvārds jau eksistē!<br><br>";
} 
//pārbaudām, vai datubāzē jau nav tāds pats nickname
$sql = "SELECT * FROM users WHERE nickname='".$_POST["nickname"]."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e2 = true;
  echo "Šāds segvārds jau eksistē!<br><br>";
} 
//pārbaudām, vai datubāzē jau nav tāds pats email
$sql = "SELECT * FROM users WHERE email='".$_POST["email"]."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e3 = true;
  echo "Šāda e-pasta adrese jau eksistē!<br><br>";
}

if (($e1)||($e2)||($e3)) {
	$e=true; //tiek fiksēta dublēšanās kļūda
} else { //ja dati nedublējas, tad liekam datubāzē
//beidzas pārbaude, vai nedublējas dati



//ievietošana datubāzē
$sql = "INSERT INTO users (username, password, nickname, email, role)
VALUES ('".$_POST["username"]."', '".$_POST["password"]."', '".$_POST["nickname"]."', '".$_POST["email"]."', '".$_POST["role"]."')";
		
if ($conn->query($sql) === TRUE) {
  echo "Lietotājs veiksmīgi reģistrēts!<br><br>";
} else {
  echo "Kļūda reģistrējot lietotāju: " . $sql . "<br><br>" . $conn->error;
}

} //beidzas ievietošana datubāzē
} //beidzas pārbaude, vai forma aizpildīta

if (isset($_GET["edit"])) { //ja ir rediģēšanas režīms
	
$sql = "SELECT * FROM users WHERE id='".$_GET["edit"]."'";
// no db paņemam to lietotāju, kam id sakrīt ar to, kas saitē pie edit
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  //iegūstam rediģējamā lietotāja datus
  $row = $result->fetch_assoc();
	
}
}
?>
<form action="" method="POST">
<input type="text" name="username" placeholder="Ievadiet lietotājvārdu" value="
<?php if ($e) {echo $_POST["username"];}  elseif ($edit) {echo $row['username'];}?>
" required><br><br>
<input type="text" name="nickname" placeholder="Ievadiet segvārdu" value="
<?php if ($e) {echo $_POST["nickname"];}  elseif ($edit) {echo $row['nickname'];}?>
" required><br><br>
<input type="text" name="email" placeholder="Ievadiet e-pastu" value="<?php if ($e) {echo $_POST["email"];}  elseif ($edit) {echo $row['email'];} ?>" required><br><br>
<input type="password" name="password" placeholder="Ievadiet paroli" value="<?php if ($e) {echo $_POST["password"];} ?>" required><br><br>
<input type="radio" id="poga1" name="role" value="user" checked="checked">
<label for="poga1">lietotājs</label><br>
<input type="radio" id="poga2" name="role" value="admin" 
	<?php if (($e)&&($_POST["role"]=="admin")) {echo 'checked="checked"';} ?>>
<label for="poga2">administrators</label><br><br>
<input type="submit" name="submit" value="<?php if($edit) {echo "Atjaunināt";} else {echo "Pievienot";} ?> lietotāju">
</form>

<h2>Reģistrētie lietotāji</h2>
<?php 



//lietotāju dzēšana
if (isset($_GET["delete"])) { //pārbaudām, vai saitē ir delete	

if (($_GET["delete"]==$_SESSION["userid"])&&(!isset($_GET["selfdelete"]))) {
	//ja sakrīt dzēšamā lietotāja id ar tekošā lietotāja is un lietotājs jau nav atbildējis uz sevis dzēšanu (nav selfdelete)
	echo "Vai Jūs tiešām vēlaties izdzēst pats savu kontu? ";
	echo "<a href='index.php?open=users&delete=".
	$_GET["delete"]."&selfdelete=true'>JĀ</a> <a href='index.php?open=users'>NĒ</a>";
	 //beidzas pārbaude, vai lietotājs atbildējis uz selfdelete jautājumu
} else {

$sql = "DELETE FROM users WHERE id=".$_GET["delete"];
if ($conn->query($sql) === TRUE) {
  echo "Lietotājs (id=".$_GET["delete"].") veiksmīgi izdzēsts!<br><br>";
} else {
  echo "Kļūda dzēšot lietotāju: <br><br>" . $conn->error;

} //beidzas pārbaude, vai $_GET["selfdelete"]=='true'
} // beidzas pārbaude, vai lioetotājs nedzēš pats sevi
}//beidzas pārbaude, vai saitē ir delete



//lietotāju saraksta izdrukāšana
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  echo "<ul class='lietotaji'>";
  while($row = $result->fetch_assoc()) {
    echo '<li><a href="index.php?open=users&delete='.$row["id"].'">dzēst</a> <a href="index.php?open=users&edit='.$row["id"].'">rediģēt</a> '.$row["id"].' '.$row["role"].' '.$row["username"].
	' '.$row["nickname"].' '.$row["email"].'</li>';
  }
  echo "</ul>";
}

?>
