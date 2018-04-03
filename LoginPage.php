<?php
require_once('Dao.php');
session_start();
$dao = new Dao();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="icon" href="twoDragon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="loginpage.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>

	<div id="iconHolder">
		<img src="yinyangdragon.png" class="leftDragon" alt="First Dragon">
    <img src="yinyangdragon.png" class="rightDragon" alt="Second Dragon">

	<h1 id="banner">
		Mythical Origins
	</h1>
</div>
<div id="tabHolder">
	<div class="tab">
		<button class="tablinks" onclick="location.href='HomePage.html'">HOME</button>
		<button class="tablinks" onclick="location.href='CreatureList.html'">CREATURES</button>
		<button class="tablinks" onclick="location.href='Map.html'">MAP</button>
		<div id="loginButton" style="display:block;">
		<button class="tablinks" onclick="location.href='LoginPage.php'">LOG IN</button>
	</div>
	<div id="logoutButton" style="display:none;">
		<button class="tablinks" onclick="location.href='LoginPage.php'">LOG OUT</button>
	</div>
	</div>
		<div class="loginForm">
			<div> <span class="error"> <?php echo $dao->GetErrorMessage();?></span> </div>
      <div id="middle">
			<form id=loginCreds method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<!-- <form id=loginCreds method="POST" action="login.php"> -->
  		User Name:
  		<input id="username" type="text" class="User" name="username" placeholder="Username" autocomplete="off" required>
			<span id='login_username_errorloc' class='error'></span>
			<br>
  		Password:
  		<input id="password" type="password" class="Password" name="password" placeholder="Password..." autocomplete="off" required>
			<span id='login_password_errorloc' class='error'></span>
			<br>
			<input id="login" type = "submit" value="Sign In">
			<input id="signUp" type = "submit" value="Create Account">
			<script type='text/javascript'>

				$(document).on('click', "#login", function(){
					var user = $("#username");
					var password = $("#password");
					if(!user.empty() && !password.empty()){
						"<?php echo $dao->login() ?>"
					}
				})

				$(document).on('click', "#signUp", function(){
					window.location.href = 'SignUp.php';
				})

				function loginSuccessful(){
					var logoutButton = document.getElementById('logoutButton');
					var loginButton = document.getElementById('loginButton');
					if(logoutButton.style.display === "none" && loginButton.style.display === "block"){
						logoutButton.style.display = "block";
						loginButton.style.display = "none";
					}
				}

			</script>
			</form>
    </div>
		</div>
	</div>
	<footer>
	<p>Property of Mythical Origins</p>
</footer>
</body>

</html>
