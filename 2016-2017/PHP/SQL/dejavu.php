<!DOCTYPE HTML>
<html>
	<head>
		<title>Exercice 0</title>
	</head>
	<body>

<?php
$link = mysqli_connect('localhost', 'root', 'root', 'cinema');

if (!$link) {
    die('Erreur de connexion (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

echo 'Succès... ' . mysqli_get_host_info($link) . "\n";

$query = 'SELECT * FROM films';
$first = mysqli_query($link, $query);
$query = 'SELECT `id_film`,`titre`,`resum` FROM `films`';
$second = mysqli_query($link, $query);
$query = 'SELECT `titre`,`resum`,`date_debut_affiche` FROM `films` ORDER BY `titre`';
$third = mysqli_query($link, $query);
$query = 'SELECT `id_film`,`titre`,`resum` FROM `films` LIMIT 10,10';
$fourth = mysqli_query($link, $query);
$query = 'SELECT `titre`,`resum` FROM `films` WHERE `id_genre` = 10';
$fifth = mysqli_query($link, $query);
$query = 'SELECT `titre` AS \'titre_film\',`resum` AS \'resum_film\' FROM `films` WHERE `titre` LIKE \'%28%\'';
$sixth = mysqli_query($link, $query);
$query = 'SELECT `titre`,`resum` FROM `films` WHERE `id_film` IN(4,8,15,16,23,42)';
$seventh = mysqli_query($link, $query);
$query = 'SELECT SUM(`places`) AS \'places\' FROM `salles`';
$eigth = mysqli_query($link, $query);
$query = 'SELECT `date_debut_affiche`,concat(\'nouveaute \',`titre`) AS \'titre film\' FROM `films` WHERE `date_debut_affiche` >= \'2011-11-16\' ORDER BY `id_film` DESC';
$nineth = mysqli_query($link, $query);

displayData($first);
echo '<hr>';
displayData($second);
echo '<hr>';
displayData($third);
echo '<hr>';
displayData($fourth);
echo '<hr>';
displayData($fifth);
echo '<hr>';
displayData($sixth);
echo '<hr>';
displayData($seventh);
echo '<hr>';
displayData($eigth);
echo '<hr>';
displayData($nineth);

mysqli_close($link);

function displayData($result){
	$head = 0;
	echo '<table>';
	foreach ($result as $row) {
		if($head == 0){
			echo '<tr>';
			foreach ($row as $key => $value) {
				echo '<th>'.$key.'</th>';
			}
			echo '</tr>';
			$head = 1;
		}
		else {
			echo '<tr>';
			foreach ($row as $key => $value) {
				echo '<td>'.$value.'</td>';
			}
			echo '</tr>';
		}
	}
	echo '</table>';
}

?>

	</body>
</html>