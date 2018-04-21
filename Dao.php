<?php
class DAO {

  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_00cb65a73a2f1fd";
  private $user = "b59c43093d3188";
  private $password = "4c91422f";

  // private $host = "127.0.0.1";
  // private $db = "cs401";
  // private $user = "root";
  // private $password = "";

  var $error_message;
  var $connection;
  protected $logger;

  var $username;
  var $userPassword;
  var $email;
  var $sessionvar;

  function CheckLogin(){
    if(!isset($_SESSION)){
      session_start();
    }

    $sessionvar = $username;

    if(empty($_SESSION[$sessionvar]))
    {
       return false;
    }
    return true;
  }

  function LogOut(){
    session_start();
    $_SESSION['user'] = NULL;
    unset($_SESSION['user']);
  }

//Insert into database for a new user
  function InsertIntoDB($username, $password, $email)
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userPassword = $_POST['password'];
    $salt = '23efeaeat34tq3argafd';
    $password = md5($password . $salt);
    if($this->checkExistingUser($username) == false){
      $conn = $this->AccessDatabase();
      $query = $conn->prepare('INSERT INTO user (username,email,password,access)values(:username, :email, :password, 1)');
      $query->bindParam(":username", $username);
      $query->bindParam(":email", $email);
      $query->bindParam(":password", $password);
      $query->execute();
      $results = $query->fetch(PDO::FETCH_ASSOC);
      return true;
    }
  }

function checkExistingUser($username){
  $conn = $this->AccessDatabase();
  $query =  $conn->prepare("SELECT username FROM user WHERE username= :username");
  $query->bindParam(":username", $username);
  $query->execute();
  $results = $query->fetch(PDO::FETCH_ASSOC);
  if (is_array($results) && 0 < count($results)) {
        return true;
      } else {
        return false;
      }
}
//Connect to database
  function AccessDatabase(){
    try{
    $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,$this->password);
    return $this->connection;
  } catch (Exception $e) {
      echo "connection failed: " . $e->getMessage();
    }

  }

//Make sure that data coming through is not a sql injection attack
  function SanitizeForSQL($str)
  {
      if( function_exists( "mysqli_real_escape_string" ) )
      {
            $ret_str = mysqli_real_escape_string($this->connection, $str );
      }
      else
      {
            $ret_str = addslashes( $str );
      }
      return $ret_str;
  }
//Remove any possible characters for a sql attack
  function Sanitization($str,$remove_nl=true)
  {
      $str = $this->StripSlashes($str);

      if($remove_nl)
      {
          $injections = array('/(\n+)/i',
              '/(\r+)/i',
              '/(\t+)/i',
              '/(%0A+)/i',
              '/(%0D+)/i',
              '/(%08+)/i',
              '/(%09+)/i'
              );
          $str = preg_replace($injections,'',$str);
      }

      return $str;
  }

function StripSlashes($str)
{
    if(get_magic_quotes_gpc())
    {
        $str = stripslashes($str);
    }
    return $str;
}


//Be able to login into the database and search for user and their password
function CheckLoginInDB($username,$password)
{
    $salt = '23efeaeat34tq3argafd';
    $password = md5($password . $salt);
    $conn = $this->AccessDatabase();
    $query = $conn->prepare("SELECT access, email, username FROM user WHERE username= :username AND password= :password");
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $password);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_ASSOC);
    if (is_array($results) && 0 < count($results)) {
      $_SESSION['user'] = $username;
      return true;
    } else {
      return false;
    }
}



}
