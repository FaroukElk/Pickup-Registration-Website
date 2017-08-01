<?php include "base.php"; 
$join_query = mysqli_query($link, "INSERT INTO ".$_GET["sport"]."_list (UserID) VALUES('".$_SESSION["UserID"]."')");
if ($join_query){
	echo "<p>You have joined the ".$_GET["sport"]."	list.</p>";
}
else{
	echo "<p>There was an error joining the ".$_GET["sport"]." list.</p>";
}
?>
<meta http-equiv="refresh" content="2;index.php">