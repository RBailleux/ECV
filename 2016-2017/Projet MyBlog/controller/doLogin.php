<?php

require_once('model/user.php');

function auth(){
  global $errors;

  $errors = [];

  if(empty($_POST['login'])){
    $errors['login'] = 'login obligatoire';
  }
  if(empty($_POST['password'])){
    $errors['password'] = 'password obligatoire';
  }
  if(!empty($errors)){
    return false;
  }

  $login = $_POST['login'];
  $password = $_POST['password'];

  return user_auth($login, $password);
}

$user = auth();

if(!$user){
  $errors['login'] = 'Identifiants incorrects';
  $template = 'login';
}
else{
  $_SESSION['user'] = $user['id'];
  $template = 'home';
}
?>
