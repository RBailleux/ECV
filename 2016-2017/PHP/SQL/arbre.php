<?php
$link = mysqli_connect('localhost', 'root', 'root', 'cinema');
mysqli_set_charset($link, 'utf8');
if (!$link) {
    die('Erreur de connexion (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

echo 'Succès... ' . mysqli_get_host_info($link) . "\n";

if(!isset($_GET['idDistributeur']) && !isset($_GET['idFilm'])){
	$distributeursQuery = 'SELECT `nom`, `id_distributeur` FROM `distributeurs`';
	$distributeurResults = mysqli_query($link, $distributeursQuery);

	while ($distributeursArray=mysqli_fetch_array($distributeurResults)){
		echo '<br><a href="?idDistributeur='.$distributeursArray['id_distributeur'].'">'.$distributeursArray['nom'].'</a>';
	}
}
else if(isset($_GET['idDistributeur'])){
	$idDistributeur = $_GET['idDistributeur'];
	$filmsDistributeursQuery = 'SELECT films.id_film, films.titre, genres.nom as genre, films.annee_production, distributeurs.nom as distributeur FROM films, genres, distributeurs WHERE films.id_distributeur = distributeurs.id_distributeur AND distributeurs.id_distributeur='.$idDistributeur.' AND films.id_genre = genres.id_genre ORDER BY genres.nom, films.annee_production, films.titre ';
	$filmsDistributeursResults = mysqli_query($link, $filmsDistributeursQuery);
	displayListFilm($filmsDistributeursResults);
}
else if(isset($_GET['idFilm'])){
	$idFilm = $_GET['idFilm'];
	$filmsQuery = 'SELECT films.id_film, films.titre, SUBSTRING_INDEX(films.resum, " ", 10) as short_resum, films.resum, genres.nom as genre, distributeurs.nom as distributeur, films.annee_production, YEAR(films.date_debut_affiche) as date_debut_affiche, films.id_distributeur, films.id_genre FROM films, genres, distributeurs WHERE (films.id_distributeur IS NULL OR films.id_distributeur=distributeurs.id_distributeur) AND (films.id_genre IS NULL OR films.id_genre=genres.id_genre) AND films.id_film='.$idFilm.' GROUP BY films.id_film';
	$filmsResults = mysqli_query($link, $filmsQuery);
	displayFilmsFromDistributeurs($filmsResults);
}

mysqli_close($link);

function displayListFilm($result){
	echo '<!DOCTYPE HTML>
			<html>
				<head>
					<title>Exercice 1</title>
				</head>
				<body>';
	$currentGenre = '';
	foreach ($result as $row) {
		foreach ($row as $column => $value) {
			if($column == 'genre' && $value != $currentGenre){
				$currentGenre = $value;
				echo '<h1>'.$value.'</h1>';
			}	
			if($column == 'genre' && $value == $currentGenre){
				echo '<a href="?idFilm='.$row['id_film'].'">'.$row['titre'].'</a><br>';
			}	
		}
	}
}
function displayFilmsFromDistributeurs($result){
	$index = 0;
	$currentGenre = '';
	foreach ($result as $row) {
		$titre = $row['titre'];
		$genre = $row['genre'];
		$idGenre = $row['id_genre'];
		$anneeProd = $row['annee_production'];
		$distributeur = $row['distributeur'];
		$idDistributeur = $row['id_distributeur'];
		$short_resum = $row['short_resum'];
		$resum = $row['resum'];
		$affiche = $row['date_debut_affiche'];
	}
	if(is_null($idDistributeur)){
		$distributeur = 'Inconnu';
	}
	if(is_null($idGenre)){
		$genre = 'Inconnu';
	}
	echo '<!DOCTYPE HTML>
			<html>
				<head>
					<title>'.$titre.'</title>
				</head>
				<body>';
	echo '<h1>'.$titre.'</h1>';
	echo '<ul>';
	echo '<li><b>Court r&eacute;sum&eacute; : </b>'.$short_resum.'</li>';
	echo '<li><b>R&eacute;sum&eacute; : </b>'.$resum.'</li>';
	echo '<li><b>Genre : </b>'.$genre.'</li>';
	echo '<li><b>Distributeur : </b>'.$distributeur.'</li>';
	echo '<li><b>Ann&eacute;e de production : </b>'.$anneeProd.'</li>';
	echo '<li><b>Ann&eacute;e de d&eacute;but d\'affiche : </b>'.$affiche.'</li>';
	echo '</ul>';
}

?>

	</body>
</html>