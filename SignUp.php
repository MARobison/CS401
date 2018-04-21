<?php
require_once('Dao.php');
session_start();
$dao = new Dao();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>
	<link rel="icon" href="twoDragon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="loginpage.css">
	<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
	<div id="logoutButtonHolder">
		<button id="logoutButton" class="tablinks" type="submit" onclick="location.href='logout.php'">LOG OUT</button>
	</div>
	<br>
  <div id="iconHolder">
		<img src="yinyangdragon.png" class="leftDragon" alt="First Dragon">
    <img src="yinyangdragon.png" class="rightDragon" alt="Second Dragon">

	<h1 id="banner">
		MYTHICAL ORIGINS
	</h1>
</div>
<div id="tabHolder">
	<div class="tab">
		<button class="tablinks" onclick="location.href='HomePage.php'">HOME</button>
		<button class="tablinks" onclick="location.href='CreatureList.php'">CREATURES</button>
		<button class="tablinks" onclick="location.href='Map.php'">MAP</button>
		<button class="tablinks" onclick="location.href='LoginPage.php'">LOG IN</button>
	</div>
</div>
<div id=errorMessageHolder>
<?php
if (isset($_SESSION['message'])) { ?>
<div id="errorMessage"><?php
	foreach ($_SESSION['message'] as $message) {
		echo "<div>" . $message . "</div>";
 }
	unset($_SESSION['message']); ?>
</div>
<?php } ?>
</div>
<form method="POST" action="signup_handler.php">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Creating an account will allow you to see our creatures map!</p>
    <hr>
    <label for="username"><b>Username: </b></label>
    <input type="text" id="username" class="username" placeholder="Enter Username" name="username" required>
    <label for="email"><b>Email: </b></label>
    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" class="email" placeholder="Enter Email" name="email" required>
    <label for="psw"><b>Password: </b></label>
    <input type="password" id="password" class="password" placeholder="Enter Password" name="password" required>
<br>
			<input id="signUpConfirm" type = "submit" value="Sign Up">
			</form>
			<input id="cancel" type = "submit" value="Cancel">
  </div>


<script>

$(document).on('click', "#cancel", function(){
  window.location.href = 'LoginPage.php';
});

$(document).on('click', "#logoutButton", function(){
  alert("You have succesfully logged out!");
});

</script>

  <footer>
  <p>Property of Mythical Origins</p>
</footer>
</body>

</html>
