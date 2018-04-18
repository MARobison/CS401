<?php
class DAO {

  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_00cb65a73a2f1fd";
  private $user = "b59c43093d3188";
  private $password = "4c91422f";

  var $error_message;
  var $connection;

  var $username;
  var $userPassword;
  var $email;
  var $sessionvar;

//Check to see if login information is empty
//Check to see if user actually has access
function login(){
  if(empty($_POST['username'])){
      $this->errorHandler("UserName is empty!");
      return false;
  }
  if(empty($_POST['password'])){
      $this->errorHandler("Password is empty!");
      return false;
  }
  $username = trim($_POST['username']);
  $userPassword = trim($_POST['password']);

  if(!isset($_SESSION)){
    session_start();
  }
  if(!$this->CheckLoginInDB($username,$userPassword))
  {
    $this->errorHandler("User not found");
    return false;
  }

  $_SESSION['user'] = $username;
  return true;
  }

  function errorHandler($error){
    $this->error_message .= $error;
  }

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
    //$sessionvar = $username;
    $_SESSION['user'] = NULL;
    unset($_SESSION['user']);
  }

//Insert into database for a new user
  function InsertIntoDB()
  {
    if(empty($_POST['username'])){
      echo "Empty username";
        $this->errorHandler("UserName is empty!");
        return false;
    }
    if(empty($_POST['password'])){
        $this->errorHandler("Password is empty!");
        return false;
    }
    if(empty($_POST['email'])){
      $this->errorHandler("Email is empty!");
      return false;
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userPassword = $_POST['password'];
    if($this->AccessDatabase() == true && $this->checkExistingUser($username) == true){
      $insert_query = 'INSERT INTO ' . 'user' .'(
              username,
              email,
              password,
              access
              )
              values
              (
              "' . $this->SanitizeForSQL($username) . '",
              "' . $this->SanitizeForSQL($email) . '",
              "' . md5($userPassword) . '",
              "' . 1 . '"
              )';
        mysqli_query($this->connection, $insert_query);
  }
      else
      {
          return false;
      }
       return true;
  }

function checkExistingUser($username){
  $query = "SELECT username FROM user WHERE username='" . $username ."'";
  $result = mysqli_query($this->connection, $query);
  if($result && mysqli_num_rows($result) > 0){
     $this->errorHandler("Username already exists");
     echo "Username already exists";
    return false;
  }
  return true;
}
//Connect to database
  function AccessDatabase(){
    $this->connection = mysqli_connect($this->host,$this->user,$this->password,$this->db);

    if(!$this->connection)
    {
        $this->errorHandler("Database Login failed");
        return false;
    }
    if(!mysqli_select_db($this->connection, $this->db))
    {
        $this->errorHandler("Failed to select database");
        return false;
    }
    return true;
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
function CheckLoginInDB($username,$userPassword)
{
    if(!$this->AccessDatabase())
    {
        $this->errorHandler("Database login failed!");
        return false;
    }
    $username = $this->SanitizeForSQL($username);
    $userPasswordmd5 = md5($userPassword);
    $query = "SELECT access, email, username FROM user WHERE username='" . $username . "' AND password='" . $userPasswordmd5 . "'";
    $result = mysqli_query($this->connection, $query);

    if(!$result || mysqli_num_rows($result) == NULL)
    {
        $this->errorHandler("Error logging in. The username or password does not match");
      echo "Password or username does not match our records";
      return false;
    }

     $row = mysqli_fetch_assoc($result);
     $_SESSION['user'] = $row['username'];
     $_SESSION['email'] = $row['email'];
    return true;
}

function GetErrorMessage()
{
    if(empty($this->error_message))
    {
        return '';
    }
    $errormsg = nl2br(htmlentities($this->error_message));
    return $errormsg;
}


}
