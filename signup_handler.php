<?PHP
session_start();
require_once("Dao.php");
$dao = new Dao();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

echo $username;
echo $email;
echo $password;


if (empty($username)) {
  $_SESSION['message'][] = "Missing username";
    header("Location:SignUp.php");
}
if (empty($email)) {
  $_SESSION['message'][] = "Missing email";
    header("Location:SignUp.php");
}
 if (empty($password)) {
   $_SESSION['message'][] = "Missing password";
     header("Location:SignUp.php");
 }
 if (isset($_SESSION['message'])) {
   $_SESSION['presets']['username'] = $username;
   exit;
 }
 if ($dao->InsertIntoDB($username, $password, $email)) {
  $_SESSION['logged_in'] = true;
  $_SESSION['message'][] = "You have signed up successfully!";
  header("Location:LoginPage.php");
  exit;
} else {
  $_SESSION['presets']['username'] = $username;
  $_SESSION['message'][] = "Username is already taken, please select a different username";
  header("Location:SignUp.php");
  exit;
}
?>
<html>
<body>
</body>
</html>
