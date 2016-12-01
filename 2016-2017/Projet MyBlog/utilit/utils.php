<?php
function my_mysqli_connect ()
{
   global $link;
   $link = mysqli_connect('localhost', 'root', '', 'blog');

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

function randomText($size = 6){
	$chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','-','$','!','?'];
	$text = '';
	for($i = 0; $i<$size; $i++){
		$text.=$chars[rand(0,count($chars)-1)];
	}
	return $text;
}
?>
