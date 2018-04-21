<?PHP
session_start();
require_once("Dao.php");
$dao = new Dao();

$username = $_POST['username'];
$password = $_POST['password'];


if (empty($username)) {
  $_SESSION['message'][] = "Missing username";
    header("Location:LoginPage.php");
}
 if (empty($password)) {
   $_SESSION['message'][] = "Missing password";
     header("Location:LoginPage.php");
 }
 if (isset($_SESSION['message'])) {
   $_SESSION['presets']['username'] = $username;
   exit;
 }

 if ($dao->CheckLoginInDB($username, $password)) {
  $_SESSION['logged_in'] = true;
  $_SESSION['message'][] = "Log in successful!";
  header("Location:LoginPage.php");
  exit;
} else {
  $_SESSION['presets']['username'] = $username;
  $_SESSION['message'][] = "Invalid username/password combo";
  header("Location:LoginPage.php");
  exit;
}
?>
<html>
<body>
</body>
</html>
