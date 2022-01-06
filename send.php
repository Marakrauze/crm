

<?php
$sql = "SELECT nickname FROM users WHERE id='".$_GET["reciever"]."'";
// no db paņemam to lietotāju, kam id sakrīt ar to, kas saitē pie receiver
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  //iegūstam rediģējamā lietotāja datus
  $row = $result->fetch_assoc();
}
?>

<h2>Sūtīt vēstuli lietotājam <?php 
echo $row['nickname'];
 ?></h2>

<?php
if (isset($_POST['submit'])) {
//pārbaudām, vai forma aizpildīta

//ievietošana datubāzē (vēstules sūtīšana)
$sql = "INSERT INTO messages (subject, message, sender, reciever, opened)
VALUES ('".$_POST["subject"]."', '".$_POST["message"]."', '".$_SESSION["userid"]."', '".$_GET["reciever"]."', 'false')";

if ($conn->query($sql) === TRUE) {
  echo "Vēstule nosūtīta!<br><br>";
} else {
  echo "Kļūda sūtot vēstuli: " . $sql . "<br><br>" . $conn->error;
}//beidzas ievietošana datubāzē

} //beidzas pārbaude, vai forma aizpildīta
?>

<form action="" method="POST">
<input type="text" name="subject" placeholder="Ievadiet vēstules tematu" size="40" required><br><br>
<textarea name="message" rows="15" cols="60" placeholder="Ievadiet vēstules tekstu..." required></textarea><br><br>
<input type="submit" name="submit" value="Sūtīt vēstuli">
</form>