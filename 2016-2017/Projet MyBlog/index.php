<?php

session_start();

require_once('utilit/utils.php');
my_mysqli_connect();

$action = 'home';
$layout = 'default';
if(!empty($_GET['action'])){
  $action = $_GET['action'];
}
$template = $action;

//controller

if(file_exists('controller/'.$action.'.php')){
  include('controller/'.$action.'.php');
}

include ('layout/'.$layout.'.phtml');
?>
