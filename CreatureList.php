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
  		<button id="logoutButton" type="submit" onclick="location.href='logout.php'">LOG OUT</button>
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
      <button class="active" onclick="location.href='CreatureList.php'">CREATURES</button>
      <button class="tablinks" onclick="location.href='Map.php'">MAP</button>
      <button class="tablinks" onclick="location.href='LoginPage.php'">LOG IN</button>
    </div>

  </div>
  <br>
  <div id="creatureList">
    <ul>
    <a href="javascript:void"><li>Dragon</li></a>
      <a href="javascript:void"><li>Vampire</li></a>
      <a href="javascript:void"><li>Werewolf</li></a>
      <a href="javascript:void"><li>Banshee</li></a>
      <a href="javascript:void"><li>Angel</li></a>
      <a href="javascript:void"><li>Mummy</li></a>
      <a href="javascript:void"><li>Goblin</li></a>
      <a href="javascript:void"><li>Siren</li></a>
      <a href="javascript:void"><li>Basilisk</li></a>
      <a href="javascript:void"><li>Pegasus</li></a>
      <a href="javascript:void"><li>Hydra</li></a>
      <a href="javascript:void"><li>Scylla</li></a>
      <a href="javascript:void"><li>Elf</li></a>
      <a href="javascript:void"><li>Fairy</li></a>
      <a href="javascript:void"><li>Griffon</li></a>
      <a href="javascript:void"><li>Nymph</li></a>
      <a href="javascript:void"><li>Demon</li></a>
      <a href="javascript:void"><li>Manticore</li></a>
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
