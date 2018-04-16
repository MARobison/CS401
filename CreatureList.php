<?php
require_once('Dao.php');
session_start();
$dao = new Dao();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CreatureList</title>
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
  <div id="creatureList">
    <ul>
      <a href="javascript:void" onclick="function(void)">
      <li>Dragon</li>
      <li>Vampire</li>
      <li>Werewolf</li>
      <li>Banshee</li>
      <li>Angel</li>
      <li>Mummy</li>
      <li>Goblin</li>
      <li>Siren</li>
      <li>Basilisk</li>
      <li>Pegasus</li>
      <li>Hydra</li>
      <li>Scylla</li>
      <li>Elf</li>
      <li>Fairy</li>
      <li>Griffon</li>
      <li>Nymph</li>
      <li>Demon</li>
      <li>Manticore</li>
    </ul>
  </div>
  <br>
  <script>
  $(document).on('click', "#logoutButton", function(){
    alert("You have succesfully logged out!");
  });
  </script>
  <div id="footerHolder">
  <footer>
  <p>Property of Mythical Origins</p>
</footer>
</div>
  </body>
</html>
