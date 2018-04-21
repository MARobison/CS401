<?php
session_start();
require_once('Dao.php');
$dao = new Dao();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
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
		<button id="home" class="tablinks" onclick="location.href='HomePage.php'">HOME</button>
		<button id="creatures" class="tablinks" onclick="location.href='CreatureList.php'">CREATURES</button>
		<button id="map" class="tablinks" onclick="location.href='Map.php'">MAP</button>
		<button id="login" class="active" onclick="location.href='LoginPage.php'">LOG IN</button>
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
		<div class="loginForm">
      <div id="middle">
			<form id=loginCreds method="POST" action="login.php">
  		User Name:
  		<input id="username" type="text" class="User" name="username" placeholder="Username" value="<?php echo isset($_SESSION['presets']['username']) ? $_SESSION['presets']['username'] : ""; ?>" autocomplete="off">
			<br>
  		Password:
  		<input id="password" type="password" class="Password" name="password" placeholder="Password..." value="<?php echo isset($_SESSION['presets']['password']) ? $_SESSION['presets']['password'] : ""; ?>"autocomplete="off" >
			<br>
			<input id="signIn" type ="submit" value="Sign In">
		</form>
			<input id="signUp" type ="submit" value="Create Account">
				</div>
			</div>
			<script type='text/javascript'>

			$(document).on('click', "#signUp", function(){
				window.location.href = 'SignUp.php';
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
