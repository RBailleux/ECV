<?php
function my_mysqli_connect ()
{
   global $link;
   $link = mysqli_connect('localhost', 'root', 'root', 'blog');

   if (!$link) {
       die('<br>Erreur de connexion ('.mysqli_connect_errno().') '. mysqli_connect_error());
   }
}

function my_query($query) {
 global $link;
 
 $result = mysqli_query($link, $query);
 if (!$result) {
   die('<br>Erreur lors de l\'éxécution de la requête ('.mysqli_errno($link).') '.mysqli_error($link));
 }
 return $result;
}

function my_fetch_all($query){
  $result = my_query($query);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $data;
}

function my_escape($data){
  global $link;
  return mysqli_escape_string($link, $data);
}

my_mysqli_connect();

?>
