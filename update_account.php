<?php include "base.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>User Management System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="main">
<?php
if(!empty($_POST["firstname"]) || !empty($_POST["lastname"]) || !empty($_POST["email"])){
	//Performs an update query based on which fields were updated.
	$update_query = "UPDATE users SET ";
	$query_count=0;
	$email = mysqli_real_escape_string($link, $_POST["email"]);
	$firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
	$lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
	
	if(!empty($firstname) && !ctype_space($firstname)){
		$update_query .= "First_Name= '".$firstname."'";
		$query_count++;
	}
	
	if(!empty($lastname) && !ctype_space($lastname)){
		if($query_count != 0){
			$update_query .= ", ";
			$query_count--;
		}
		$update_query .= "Last_Name= '".$lastname."'";
		$query_count++;
	}
	
	if(!empty($email) && !ctype_space($email)){
		if($query_count != 0){
			$update_query .= ", ";
		}
		$update_query .= "EmailAddress= '".$email."'";
	}
	
	$update_query .= "WHERE UserID='".$_SESSION["UserID"]."'";
	$check_update = mysqli_query($link, $update_query);
	if($check_update){
		echo "<h1>Success!</h1>";
		echo "<p>Account information successfully updated. Please <a href=\"index.php\">click here</a> to return to the home page.</p>";
	}
	else{
		echo "<h1>Error</h1>";
		echo "<p>Sorry, your request failed. Please <a href=\"index.php\">click here</a> to go back to the home page.</p>";
		}
}
else{//Information to update account with
	?>
	<h1>Update Account Information</h1>
	<p>Please enter the information you would like to update below.</p>
	
	<form method="post" action="update_account.php" name="updateform" id="updateform">
	<fieldset>
		<label for="firstname">First Name: </label><input type="text" name="firstname" id="firstname"/><br />
		<label for="lastname">Last Name: </label><input type="text" name="lastname" id="lastname"/><br />
		<label for="email">Email Address: </label><input type="text" name="email" id="email" /> <br />
		<input type="submit" name="update" id="update" value="update" />
	</fieldset>
	</form>
	
	<?php
}
?>
</div>
</body>
</html>