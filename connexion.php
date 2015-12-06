<?php

$error = '';

if ( $_POST ) {

if (empty($_POST['action']['registred'])) { // test en premier si le bouton "inscription" n'a pas été cliqué

	if ( !empty($_POST['action']['connexion']) ) {
		
		if ( !empty($_POST['auth']['email']) && !empty($_POST['auth']['password']) ) {

			$pdo = include('data/pdo.php');
			$statement = $pdo->prepare('SELECT * FROM clients WHERE email = :email AND password = :password;');
			$statement->execute([
				':email' => $_POST['auth']['email'],
				':password' => $_POST['auth']['password'],
			]);
			$users = $statement->fetchAll();
			if ( count($users) ) {
				
				session_start();
				$_SESSION['auth'] = $users[0];
				die(header('Location: ./' . ( !empty($_POST['action']['next']) ? $_POST['action']['next'] : '' ) ));

			} else $error = "Email ou mot de passe erroné.";

		} else $error = "Tous les champs doivent être remplis.";

	} else $error = "Le formulaire n'a pas été correctement validé.";

}
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>connexion</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_phil.css">
</head>
<body>

<?php include("includes/header.php"); ?>
<div class="products container">
	

	<form id="form-login" action="connexion.php" method="post">
		
		<?php if ( $error ) { ?>
		<h2 style="color: red;"><?=$error?></h2>
		<?php } ?>
		<fieldset>
			<h2>Login client</h2>
			<input
				type="text"
				placeholder="email"
				name="auth[email]"
				value="<?=!empty($_POST['auth']['email']) ? $_POST['auth']['email'] : ''?>"
			/>

			<br />
			<input type="password" placeholder="password" name="auth[password]" />

			<input
				type="hidden"
				name="action[next]"
				value="<?=!empty($_GET['next']) ? $_GET['next'] : ( !empty($_POST['action']['next']) ? $_POST['action']['next'] : '' )?>"
			/>

			<br />
			<input type="submit" name="action[connexion]" value="connexion" />
			<br />
			<a href="password.php">Mot de passe oublié</a>

		</fieldset>
		
	</form>

	<?php include("inscription.php");?>
</div>
	<?php include("includes/footer.html");?>

</body>

</html>