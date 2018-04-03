<?php
class DAO {

  private $host = "127.0.0.1";
  private $db = "cs401";
  private $user = "root";
  private $password = "";

  var $error_message;
  var $connection;

  var $username;
  var $userPassword;
  var $email;

//   public function getConnection () {
//     try {
// 			$conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
// 			// set the PDO error mode to exception
// 			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 			echo "Connected successfully";
// 			return $conn;
// 		}
// 		catch(PDOException $e)
// 		{
// 			echo "Connection failed: " . $e->getMessage();
// 		}
// 		throw new Exception("user not found");
// }

//Check to see if login information is empty
//Check to see if user actually has access
function login(){
  if(empty($_POST['username'])){
    echo "Empty username";
      $this->errorHandler("UserName is empty!");
      return false;
  }
  if(empty($_POST['password'])){
      $this->errorHandler("Password is empty!");
      return false;
  }
  $username = trim($_POST['username']);
  $userPassword = trim($_POST['password']);
  if(!isset($_SESSION)){ session_start(); }
  if(!$this->CheckLoginInDB($username,$userPassword))
  {
    echo "User not found";
      return false;
  }
  echo "Logged in";
  return true;
  }

  function errorHandler($error){
    $this->error_message .= $error;
  }

//Insert into database for a new user
  function InsertIntoDB()
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userPassword = $_POST['password'];
    if($this->AccessDatabase() == true && $this->checkExistingUser() == true){
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
              "' . $this->SanitizeForSQL($userPassword) . '",
              "' . 1 . '"
              )';
        mysqli_query($this->connection, $insert_query);
    }
      else if(!mysqli_query($this->connection, $insert_query))
      {
          $this->errorHandler("Error inserting data to the table");
          return false;
      }
       return 1;
  }

function checkExistingUser(){
  $query = "SELECT username FROM user WHERE username='" . $username ."'";
  $result = mysqli_query($this->connection, $insert_query);
  if($result && mysqli_num_rows($result) > 0){
    // $this->errorHandler("Username already exists");
    echo "User exists";
    return "User exists";
  }
  return "User does not exist";
}
//Connect to database
  function AccessDatabase(){
    $this->connection = mysqli_connect($this->host,$this->user,$this->password,$this->db);

    if(!$this->connection)
    {
        $this->errorHandler("Database Login failed! Please make sure that the DB login credentials provided are correct");
        return false;
    }
    if(!mysqli_select_db($this->connection, $this->db))
    {
        $this->errorHandler('Failed to select database: '.$this->db.' Please make sure that the database name provided is correct');
        return false;
    }
    return "access";
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
    $query = "SELECT access FROM user WHERE username='" . $username . "' AND password='" . $userPassword . "'";

    $result = mysqli_query($this->connection, $query);

    if(!$result || mysqli_num_rows($result) <= 0)
    {
        $this->errorHandler("Error logging in. The username or password does not match");
        return false;
    }

    $row = mysqli_fetch_assoc($result);
if($query == '1'){
    return true;
  }
  else{
    return false;
  }
}

function GetErrorMessage()
{
    if(empty($this->error_message))
    {
        return '';
    }
    $errormsg = nl2br(htmlentities($this->error_message));
    // return $errormsg;
}


}
