<?php include "base.php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
</head>
<body style="padding:10px">
<div id="main">
<?php //This page is for signing up to be on the list for a variety of pick-up sports
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION["Username"])){ //Checks if user has logged in successfully
	?>
	<h1 align='center'>Pick-up Sports Sign-up Page</h1>
	<p>Thanks for logging in <code><?=$_SESSION["Username"]?></code>!<span style='float:right;'><a href="logout.php">Logout</a></span></p>
	<p align='right'><a href="update_account.php">Update Account Information</a></p>
	<p align='center'>Use this page to view each sport's sign-up list and to add or remove yourself any of the sport's sign-up list below.</p>
	<h2>Soccer</h2>
	<?php /*First the code checks if the user is already a member of the sport list. If not, then a hyperlink to join the sport group is provided. If they are then the user is provided with a link to leave the group. Code is similar for all sports. */
		$check_player = mysqli_query($link,"SELECT * FROM soccer_list WHERE UserID='".$_SESSION["UserID"]."'");
		$soccer_count = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) FROM soccer_list"));
		if(mysqli_num_rows($check_player) == 1){
			echo "<p>Player count: ".$soccer_count[0]."/25</p>";
			echo "<p><a href='leave_sport.php?sport=soccer'>Leave Soccer Group</a></p>";
		}
		else{
			echo "<p>Player count: ".$soccer_count[0]."/25.</p>";
			if ($soccer_count[0] == 25){
				echo "<p>Sorry, but the Soccer list is full.</p>";
			}
			else{
				echo "<p><a href='join_sport.php?sport=soccer'>Join Soccer Group</a></p>";
			}
		}
		$soccer_query = mysqli_query($link, "SELECT UserID FROM soccer_list"); /*Finds all the users who have joined the sport group and add their user information by their userID */
		$player_num = 1;
		if($soccer_query){
			if(mysqli_num_rows($soccer_query) != 0){
				echo "<table class='w3-table w3-striped w3-bordered' width='100%' align='left'>
					<tr><td align='center'><b>Sign-up Number</b></td>
					<td align='left'><b>First Name</b></td>
					<td align='left'><b>Last Name</b></td>
					<td align='left'><b>Email Address</b></td></tr>";
			}
			while($soccer_row = mysqli_fetch_array($soccer_query)){
				$user_row = mysqli_fetch_array(mysqli_query($link, "SELECT First_Name, Last_Name, EmailAddress FROM users WHERE UserID='".$soccer_row['UserID']."'"));
				echo "<tr><td align='center'>".$player_num."</td>
					<td align='left'>".$user_row['First_Name']."</td>
					<td align='left'>".$user_row['Last_Name']."</td>
					<td align='left'>".$user_row['EmailAddress']."</td>";
				echo "</tr>";
				$player_num++;
			}
			echo "</table>";
		}
		else{
			echo "Couldn't issue database query<br />";
			echo mysqli_error($link);
		}
	?>
	<br />
	<br />
	<h2>Football</h2>
	<?php
		$check_player = mysqli_query($link,"SELECT * FROM football_list WHERE UserID='".$_SESSION["UserID"]."'");
		$football_count = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) FROM football_list"));
		if(mysqli_num_rows($check_player) == 1){
			echo "<p>Player count: ".$football_count[0]."/30 </p> <p><a href='leave_sport.php?sport=football'>Leave Football Group</a></p>";
		}
		else{
			if ($football_count[0] == 30){
				echo "<p>Sorry, but the Football list is full.</p>";
			}
			else{
				echo "<p>Player count: ".$football_count[0]."/30</p> <p><a href='join_sport.php?sport=football'>Join Football Group</a></p>";
			}
		}
		$football_query = mysqli_query($link, "SELECT UserID FROM football_list");
		$player_num = 1;
		if($football_query){
			
			if(mysqli_num_rows($football_query) != 0){
				
				echo "<table class='w3-table w3-striped w3-bordered' width='100%' align='left'>
					<tr><td><b>Sign-up Number</b></td>
					<td><b>First Name</b></td>
					<td><b>Last Name</b></td>
					<td><b>Email Address</b></td></tr>";
				}
			
			while($football_row = mysqli_fetch_array($football_query)){
				$user_row = mysqli_fetch_array(mysqli_query($link, "SELECT First_Name, Last_Name, EmailAddress FROM users WHERE UserID='".$football_row['UserID']."'"));
				echo "<tr><td align='center'>".$player_num."</td>
					<td align='left'>".$user_row['First_Name']."</td>
					<td align='left'>".$user_row['Last_Name']."</td>
					<td align='left'>".$user_row['EmailAddress']."</td>";
				echo "</tr>";
				$player_num++;
			}
			echo "</table>";
		}
		else{
			echo "Couldn't issue database query<br />";
			echo mysqli_error($link);
		}
	?>
	<br />
	<br />
	<h2>Hockey</h2>
	<?php
		$check_player = mysqli_query($link,"SELECT * FROM hockey_list WHERE UserID='".$_SESSION["UserID"]."'");
		$hockey_count = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) FROM hockey_list"));
		if(mysqli_num_rows($check_player) == 1){
			echo "<p>Player count: ".$hockey_count[0]."/22</p>  <p><a href='leave_sport.php?sport=hockey'>Leave Hockey Group</a></p>";
		}
		else{
			if ($hockey_count[0] == 22){
				echo "<p>Sorry, but the Hockey list is full.</p>";
			}
			else{
				echo "<p>Player count: ".$hockey_count[0]."/22</p> <p><a href='join_sport.php?sport=hockey'>Join Hockey Group</a></p>";
			}
		}
		$hockey_query = mysqli_query($link, "SELECT * FROM hockey_list");
		$player_num = 1;
		if($hockey_query){
			
			if(mysqli_num_rows($hockey_query) != 0){
				echo "<table class='w3-table w3-striped w3-bordered' align='left'>
					<tr><td align='center'><b>Sign-up Number</b></td>
					<td align='left'><b>First Name</b></td>
					<td align='left'><b>Last Name</b></td>
					<td align='left'><b>Email Address</b></td></tr>";
			}
			
			while($hockey_row = mysqli_fetch_array($hockey_query)){
				
				$user_row = mysqli_fetch_array(mysqli_query($link, "SELECT First_Name, Last_Name, EmailAddress FROM users WHERE UserID='".$hockey_row['UserID']."'"));
				echo "<tr><td align='center'>".$player_num."</td>
					<td align='left'>".$user_row['First_Name']."</td>
					<td align='left'>".$user_row['Last_Name']."</td>
					<td align='left'>".$user_row['EmailAddress']."</td>";
				echo "</tr>";
				$player_num++;
			}
			echo "</table>";
			}
		else{
			echo "Couldn't issue database query<br />";
			echo mysqli_error($link);
		}
	?>
	<br />
	<br />
	<h2>Basketball</h2>
	<?php
		$check_player = mysqli_query($link,"SELECT * FROM basketball_list WHERE UserID='".$_SESSION["UserID"]."'");
		$basketball_count = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) FROM basketball_list"));
		if(mysqli_num_rows($check_player) == 1){
			echo "<p>Player count: ".$basketball_count[0]."/20</p>  <p><a href='leave_sport.php?sport=basketball'>Leave Basketball Group</a></p>";
		}
		else{
			if ($basketball_count[0] == 20){
				echo "<p>Sorry, but the Basketball list is full.</p>";
			}
			else{
				echo "<p>Player count: ".$soccer_count[0]."/20</p> <p><a href='join_sport.php?sport=basketball'>Join Basketball Group</a></p>";
			}
		}
		$basketball_query = mysqli_query($link, "SELECT * FROM basketball_list");
		$player_num = 1;
		if($basketball_query){
			
			if(mysqli_num_rows($basketball_query) != 0){
				echo "<table class='w3-table w3-striped w3-bordered' align='left'>
					<tr><td align='center'><b>Sign-up Number</b></td>
					<td align='left'><b>First Name</b></td>
					<td align='left'><b>Last Name</b></td>
					<td align='left'><b>Email Address</b></td></tr>";
			}
			
			while($basketball_row = mysqli_fetch_array($basketball_query)){
				$user_row = mysqli_fetch_array(mysqli_query($link, "SELECT First_Name, Last_Name, EmailAddress FROM users WHERE UserID='".$basketball_row['UserID']."'"));
				echo "<tr><td align='center'>".$player_num."</td>
					<td align='left'>".$user_row['First_Name']."</td>
					<td align='left'>".$user_row['Last_Name']."</td>
					<td align='left'>".$user_row['EmailAddress']."</td>";
				echo "</tr>";
				$player_num++;
			}
			echo "</table>";
		}
		else{
			echo "Couldn't issue database query<br />";
			echo mysqli_error($link);
		}
	?>
	<br />
	<br />
	<h2>Baseball</h2
	<?php
		$check_player = mysqli_query($link,"SELECT * FROM baseball_list WHERE UserID='".$_SESSION["UserID"]."'");
		$baseball_count = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(*) FROM baseball_list"));
		if(mysqli_num_rows($check_player) == 1){
			echo "<p>Player count: ".$baseball_count[0]."/18</p> <p><a href='leave_sport.php?sport=baseball'>Leave Baseball Group</a></p>";
		}
		else{
			if ($baseball_count[0] == 18){
				echo "<p>Sorry, but the Baseball list is full.</p>";
			}
			else{
				echo "<p>Player count: ".$baseball_count[0]."/18</p> <p><a href='join_sport.php?sport=baseball'>Join Baseball Group</a></p>";
			}
		}
		$baseball_query = mysqli_query($link, "SELECT * FROM baseball_list");
		$player_num = 1;
		if($baseball_query){
			if(mysqli_num_rows($baseball_query) != 0){
			echo "<table class='w3-table w3-striped w3-bordered'align='left'>
				<tr><td align='center'><b>Sign-up Number</b></td>
				<td align='left'><b>First Name</b></td>
				<td align='left'><b>Last Name</b></td>
				<td align='left'><b>Email Address</b></td></tr>";
			}
			while($baseball_row = mysqli_fetch_array($baseball_query)){
				$user_row = mysqli_fetch_array(mysqli_query($link, "SELECT First_Name, Last_Name, EmailAddress FROM users WHERE UserID='".$baseball_row['UserID']."'"));
				echo "<tr><td align='center'>".$player_num."</td>
					<td align='left'>".$user_row['First_Name']."</td>
					<td align='left'>".$user_row['Last_Name']."</td>
					<td align='left'>".$user_row['EmailAddress']."</td>";
				echo "</tr>";
				$player_num++;
			}
			echo "</table>";
		}
		else{
			echo "Couldn't issue database query<br />";
			echo mysqli_error($link);
		}
		?>
	<?php
}
	//Checks if user account exists in the user database and adds their relevant information to the session.
	elseif(!empty($_POST["username"]) && !empty($_POST["password"])){
	$username = mysqli_real_escape_string($link, $_POST["username"]);
	$password = md5(mysqli_real_escape_string($link, $_POST["password"]));
	$checklogin = mysqli_query($link, "SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
	
	if(mysqli_num_rows($checklogin) == 1){
		$row = mysqli_fetch_array($checklogin);
		$userID = $row["UserID"];
		$email = $row["EmailAddress"];
		$firstname = $row["first_name"];
		$lastname = $row["last_name"];
		
		$_SESSION["UserID"] = $userID;
		$_SESSION["Username"] = $username;
		$_SESSION["EmailAddress"] = $email;
		$_SESSION["firstname"] = $firstname;
		$_SESSION["lastname"] = $lastname;
		$_SESSION["LoggedIn"] = 1;
		
		echo "<h1>Success</h1>";
		echo "<p>We are now redirecting you to the member area.</p>";
		echo "<meta http-equiv='refresh' content='=2;index.php' />";
		
	}
	else{
		echo "<h1>Error</h1>";
		echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>. </p>";
	}

}
else{ //Code to login with their account or register if user doesn't have an account.
	?>
	<h1>Member Login</h1>
	
	<p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>
	
	<form method="post" action="index.php" name="loginform" id="loginform">
	<fieldset>
		<label for="username">Username: </label><input type="text" name="username" id="username" /><br />
		<label for="password">Password: </label><input type="password" name="password" id="password" /> <br />
		<input type="submit" name="login" id="login" value="Login" />
	</fieldset>
	</form>
	
	<?php
}
	
?>
</div>
</body>
</html>