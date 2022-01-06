<h2>Pievienot lapu (sadaļu)</h2>

<form action="" method="POST">
<?php 
$e=false;
  //pieņemam, ka nav ievades kļūdu

if(isset($_POST['submit'])) {
 
   // pārbauda vai tādi paši dati jau nav datubāzē
 $e1=false; //kļūda sākumā ir false
 
 //pārbaudām vai nav jau tāds pats page

  
$sql = "SELECT * FROM pages WHERE title='".$_POST['title']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
	$e1 = true;	{
	echo "šāda lapa jau eksistē!<br>";
}


if ($e1=true) {
	 //tiek fiksēta dublēšanās kļūda
	
} else {

if(isset($_POST['submit'])) {
 $title = $_POST['title']; 
 $content = $_POST['content'];
 
 
 if(empty($title) or empty($content)){
  echo "<p>Jāaizpilda visi lauki</p>";
 } else{ 
 
 mysqli_query($conn,"INSERT INTO pages (title, content) 
VALUES (' ".$title." ',' ".$content." ')");
echo "Lapa ir veiksmīgi pievienota! <br><br>";
 }
}
}
}
?>﻿ 
<input type ='text' name = 'title' placeholder="Ievadies lapas nosaukumu" size="40" value="<?php if ($e) {echo $_POST["title"];} ?>" required /><br/><br/>
<textarea name="content" rows="15" cols="60" value="<?php if ($e) {echo $_POST["content"];} ?>
" placeholder="Ievadiet lapas saturu" >
</textarea><br><br>
<input type = 'submit' name = 'submit' value='Pievienot lapu' />
</form>