
<h2>Meklēt mājaslapā</h2>
<form action="" method="post">
<input type="text" name="keyword" placeholder="Ierakstiet atslēgvārdu" 
	value="<?php if (isset($_POST['submit'])) { echo $_POST['keyword']; } ?>" required><br><br>
<input type="submit" name="submit" value="Meklēt">
</form>



<?php
//$_POST['keyword']

if (isset($_POST['submit'])) { //ja nospiesta poga "Meklēt"
//MEKLĒJAM LAPAS tabulā pages
echo "<h2>Atrastās lapas (sadaļas):</h2>";
$sql = "SELECT * FROM pages WHERE title LIKE '%".$_POST['keyword']."%' 
	OR content LIKE '%".$_POST['keyword']."%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo '<p><a href="?action=editpages&delete=',$row["id"],'">dzēst</a>';
	echo ' <a href="?action=editpages&edit=',$row["id"],'">rediģēt</a>';
   	echo ' ',$row["id"],'. ',$row["title"],' </p>';
  }
} else {
  echo "<p>Nav atrasta neviena lapa pēc dotā atslēgvārda!</p>";
} //beidzam meklēt lapas

//MEKLĒJAM BLOGA IERAKSTUS tabulā posts
echo "<h2>Atrasti bloga ieraksti:</h2>";
$sql = "SELECT * FROM posts WHERE title LIKE '%".$_POST['keyword']."%' 
	OR content LIKE '%".$_POST['keyword']."%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo '<p><a href="?action=blog&delete=',$row["id"],'">dzēst</a>';
	echo ' <a href="?action=blog&edit=',$row["id"],'">rediģēt</a>';
   	echo ' ',$row["id"],'. ',$row["title"],' </p>';
  }
} else {
  echo "<p>Nav atrasts neviens bloga ieraksts pēc dotā atslēgvārda!</p>";
} //beidzam meklēt bloga ierakstus

//MEKLĒJAM komentārus tabulā comments
echo "<h2>Atrasti komentāri:</h2>";

$sql = "SELECT comments.id, comments.username, comments.content, posts.title 
	FROM comments INNER JOIN posts 
	ON comments.postid = posts.id WHERE comments.username LIKE '%".$_POST['keyword']."%' 
	OR comments.content LIKE '%".$_POST['keyword']."%'";
	
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo '<p><a href="?action=comments&delete=',$row["id"],'">dzēst</a>';
   	echo ' ',$row["id"],'. ',$row["title"],' - ',$row["username"],' komentārs: ',$row["content"],'</p>';
  }
} else {
  echo "<p>Nav atrasts neviens komentārs pēc dotā atslēgvārda!</p>";
} //beidzam meklēt komentārus


} //beidzas pārbaude, vai nospiesta poga "Meklēt"
?>