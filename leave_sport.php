<?php include "base.php";
$leave_query = mysqli_query($link, "DELETE FROM ".$_GET["sport"]."_list WHERE UserID='".$_SESSION["UserID"]."'");
if ($leave_query){
	echo "<p>You have left the ".$_GET["sport"]." group.</p>";
}
else{
	echo "<p>There was an error leaving the ".$_GET["sport"]." group.</p>";
}
?>
<meta http-equiv="refresh" content="2;index.php">