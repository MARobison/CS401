<?php
require_once('Dao.php');
session_start();
$dao = new Dao();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
     <link rel="icon" href="twoDragon.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="mainPageStyle.css">
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
      Mythical Origins
    </h1>
  </div>
  <div id="tabHolder">
    <div class="tab">
      <button class="tablinks" onclick="location.href='HomePage.php'">HOME</button>
      <button class="tablinks" onclick="location.href='CreatureList.php'">CREATURES</button>
      <button class="tablinks" onclick="location.href='Map.php'">MAP</button>
      <button class="tablinks" onclick="location.href='LoginPage.php'">LOG IN</button>
    </div>

    <div id="Home" class="tabcontent">
      <h3>HOME</h3>
      <p>Access Home</p>
    </div>

    <div id="Creatures" class="tabcontent">
      <h3>CREATURES</h3>
      <p>Access Creatures</p>
    </div>

    <div id="Map" class="tabcontent">
      <h3>MAP</h3>
      <p>Access Map</p>
    </div>

    <div id="Login" class="tabcontent">
      <h3>LOG IN</h3>
      <p>Gonna log in</p>
    </div>

  </div>
  <br>
  <div id="homePageSheet">
    <div>
      <p style="text-align:center">
        Welcome to Mythical Origins!
      </p>
      <p style="text-align:center">
        Glad you could make it. Now you might be wondering...What is Mythical Origins?
        Well it's quite simple, right now you're on the home page, one step away from unlocking
        the potential to see the origins of the everyday mythical creatures we know about today or
        maybe some that you've never heard of!
      </p>
      <p style="text-align:center">
        First things first, in order to use the map that displays these mythical creatures you need to log in first!
        It's pretty simple, just hit the 'Log In' button to create an account or if you're already a member do a quick sign up!
      </p>
    </div>
    <div>
      Creature of the month:
      <div>
        
      </div>
    </div>

  </div>
  <script>
  $(document).on('click', "#logoutButton", function(){
    alert("You have succesfully logged out!");

  });
  </script>
  <br>
  <footer>
  <p>Property of Mythical Origins</p>
</footer>
  <script>

    </script>
  </body>
</html>
