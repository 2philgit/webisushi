<?php
session_start();
$error = '';
// $panierC = $_SESSION['basket'];
// print_r($panierC);  // pour test sur la variable session
// die();

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
	
	<div id="wrapper_connexion">

		<div class="wrapper style-form">
			

			<form id="form-login" action="connexion.php" method="post">
				
				<?php if ( $error ) { ?>
				<h2 style="color: red;"><?=$error?></h2>
				<?php } ?>

					<h2>Login client</h2>
					<br />
					
					<div class="line-form">
						<label for="new_client[name]">Votre nom :</label>
						<input
							type="text"
							placeholder="email"
							name="auth[email]"
							value="<?=!empty($_POST['auth']['email']) ? $_POST['auth']['email'] : ''?>"
						/>
					</div>
					
					<div class="line-form">
						<label for="new_client[name]">Votre nom :</label>
						<input type="password" placeholder="password" name="auth[password]" />
					</div>

					<input
						type="hidden"
						name="action[next]"
						value="<?=!empty($_GET['next']) ? $_GET['next'] : ( !empty($_POST['action']['next']) ? $_POST['action']['next'] : '' )?>"
					/>
					
					<div class="fake-label"></div>	<!-- classe fake-label pour pouvoir placer correctement le champ -->
					<input type="submit" name="action[connexion]" value="connexion" />
					<br />

					<div class="fake-label"></div>
					<a href="password.php">Mot de passe oublié</a>
				
			</form>
		</div>

		<?php include("inscription.php");?>
	</div>

	<?php include("includes/footer.html");?>

</body>

</html>