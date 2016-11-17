<?php
  function check_signup(){
    $errors = [];
    if(empty($_POST['login'])){
      $errors['login'] = 'login obligatoire';
    }
    if(empty($_POST['password'])){
      $errors['password'] = 'password obligatoire';
    }
    if(empty($_POST['password2']) || strcmp($_POST['password'], $_POST['password2']) !=0){
      $errors['password'] = 'password manquants ou diff&eacute;rents';
    }
    if(empty($_POST['mail'])){
      $errors['mail'] = 'mail obligatoire';
    }
    return $errors;
  }

  $errors = check_signup();
  if(empty($errors)){
    $query = 'INSERT INTO `users` (`login`, `email`, `password`) VALUES (\''.my_escape($_POST['login']).'\', \''.my_escape($_POST['mail']).'\', \''.sha1($_POST['password']).'\')';

    my_query($query);
    $message = 'Inscription r&eacute;ssie, bienvenue sur mon blog !';
    $template = 'home';

  }
  else{
    //errors
    $template = 'signup';
  }
 ?>
