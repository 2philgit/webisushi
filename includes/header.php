<?php

$connect = "Connexion";
$connectPage = "connexion.php";
if(!isset($_SESSION)) 
{
    session_start(); 
} 
if (isset($_SESSION['auth'])) {
	$connect = "Déconnexion";
	$connectPage = "deconnexion.php";
	$nameUser = $_SESSION['auth']['firstname'];
}
echo "<pre>";
//var_dump($_SESSION);
echo "</pre>" ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>iSushi.fr Cath!</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:600">	
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="container">
		<header class="page-header clearfix">

			<h1>
				<a href="index.php" title="Back to home">iSuShi</a>
			</h1>

			<nav class="isushi-nav" id="large-menu">
				<ul>
					<li><a href="liste-menu.php" title="carte">carte</a></li>
					<li><a href="#" title="compte">compte client</a></li>
					<li><a href="#" title="contact">contact</a></li>
				</ul>
			</nav>

			<nav class="isushi-nav" id="fix-menu">
				<ul>
					<li><a href="panier.php" title="panier"><i class="fa fa-cart-plus fa-2x"><sup></sup></i></a></li>
					<li><a href="<?=$connectPage?>" title=""><?=$connect?></a></li>
				</ul>
			</nav>

		</header>