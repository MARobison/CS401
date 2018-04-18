<?php
require_once('Dao.php');
$dao = new Dao();
if(isset($POST['submitted']))
{
	if($dao->login()){
		header("Location:LoginPage.php");
	}
}
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

	<div id="errorMessage" style="display:none;"> Please fill in all fields!
	</div>
		<div class="loginForm">
			<div> <span class="error"> <?php echo $dao->GetErrorMessage();?></span> </div>
      <div id="middle">
			<form id=loginCreds method="POST">
			<!-- <form id=loginCreds method="POST" action="login.php"> -->
  		User Name:
  		<input id="username" type="text" class="User" name="username" placeholder="Username" autocomplete="off" required>
			<span id='login_username_errorloc' class='error'></span>
			<br>
  		Password:
  		<input id="password" type="password" class="Password" name="password" placeholder="Password..." autocomplete="off" required>
			<span id='login_password_errorloc' class='error'></span>
			<br>
			<input id="signIn" type = "submit" value="Sign In">
			<input id="signUp" type = "submit" value="Create Account">
			<!-- <button id="signIn" onclick="checkSubmit();"> -->
			<script type='text/javascript'>

			$(document).on('click', "#signUp", function(){
				window.location.href = 'SignUp.php';
			});

// function checkSubmit(){
			$(document).ready(function(){
			$("#signIn").click(function(){
				var username = $("#username").val();
				var password = $("#password").val();
				var helper = "<?php echo $dao->login()?>";
				if( username =='' || password ==''){
						$('input[type="text"],input[type="password"]').css("border","2px solid red");
						$('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
			}else {

					if(helper == "Password or username does not match our records"){
					 document.getElementById('errorMessage').style.display = 'block';
					}
					else if(helper == "1"){
						alert("Login Successful");
						header("Location:Map.php");
				}
			}
		// };
		})
	});

	$(document).on('click', "#logoutButton", function(){
		alert("You have succesfully logged out!");

	});



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
