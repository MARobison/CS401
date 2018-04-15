<?php
require_once('Dao.php');
session_start();

$dao = new Dao();
$dao->CollectRegistrationSubmission();

?>
