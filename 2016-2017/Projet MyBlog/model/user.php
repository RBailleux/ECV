<?php
global $errors;
function user_auth($login, $password){
  $query = 'SELECT * FROM `users` WHERE `login`=\''.my_escape($login).'\' AND `password`=\''.sha1($password).'\'';

  $result = my_fetch_all($query);
  if(count($result) < 1){
    $errors['login'] = 'Identifiants incorrects';
    return false;
  }
  return $result[0];
}
?>
