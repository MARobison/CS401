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
		<button class="tablinks" onclick="location.href='LoginPage.php'">LOG IN</button>
	</div>
</div>
<form method="POST">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Creating an account will allow you to add to our creatures map!</p>
    <hr>
    <label for="username"><b>Username: </b></label>
    <input type="text" id="username" class="username" placeholder="Enter Username" name="username" required>
    <label for="email"><b>Email: </b></label>
    <input type="text" id="email" class="email" placeholder="Enter Email" name="email" required>
    <label for="psw"><b>Password: </b></label>
    <input type="password" id="password" class="password" placeholder="Enter Password" name="password" required>
    <div class="clearfix">
      <input id="cancel" type = "submit" value="Cancel">
			<input id="signUpConfirm" type = "submit" value="Sign Up">
    </div>
  </div>
</form>

<script>

$(document).ready(function(){
$("#signUpConfirm").click(function(){
  var username = $("#username").val();
  var email = $("#email").val();
  var password = $("#password").val();

	if( username =='' || password =='' || email == ''){
			$('input[type="text"],input[type="password"]').css("border","2px solid red");
			$('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
			alert("Please fill in all fields");
}else {
	var helper = "<?php echo $dao->InsertIntoDB()?>";
    if(helper == "Username already exists"){
			alert("Username already exists!");
		} else if(helper == "1"){
			alert("Account created successfully!");
			window.location.href = 'LoginPage.php';
		}
	}
	})
});

$(document).on('click', "#cancel", function(){
  window.location.href = 'LoginPage.php';
})

</script>

  <footer>
  <p>Property of Mythical Origins</p>
</footer>
</body>

</html>
