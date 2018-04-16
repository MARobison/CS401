<?php
require_once('Dao.php');
$dao = new DAO();

$dao->LogOut();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="twoDragon.png" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="loginpage.css">
  <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  </head>
  <body>
    <script>
window.location.href = 'LoginPage.php';
</script>
</body>
</html>
