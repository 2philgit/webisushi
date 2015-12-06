<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>connexion</title>
</head>

<?php

$error = '';
$msg = '';

if ( $_POST ) {

	if ( !empty($_POST['action']['newpassword']) ) {
		
		if (!empty($_POST['action']['id']) && !empty($_POST['user']['newpassword']) && !empty($_POST['user']['password_conf']) ) {
			
			if ( $_POST['user']['newpassword'] === $_POST['user']['password_conf'] ) {

				$pdo = include('data/pdo.php');
				$userQuery = $pdo->prepare('UPDATE clients SET password = ? WHERE id = ?;');
				$userQuery->execute([
					$_POST['user']['newpassword'],
					$_POST['action']['id'],
				]);

				$msg = "Votre mot de passe a bien été modifié !";
				echo $msg;


				session_start();
				$_SESSION['auth'] = $_POST['user'];
				var_dump($_SESSION['auth']);
				//die(header('Location: ./' . ( !empty($_POST['action']['next']) ? $_POST['action']['next'] : '' ) ));

			} else $error = "Les mots de passes ne sont pas identiques.";

		} else $error = "Tous les champs doivent être remplis.";

	} else $error = "Le formulaire n'a pas été correctement validé.";

}

?><html>
<head>
</head>
<body>

	<?php include("includes/header.php"); ?>

	<form action="newpassword.php" method="post">
		
		<?php if ( $error ) { ?>
		<h2 style="color: red;"><?=$error?></h2>
		<?php } ?>

		<?php if ( $msg ) { ?>
		<h2 style="color: red;"><?=$msg?></h2>
		<a href="./">Revenir à l'accueil</a>
		<?php } ?>

		<fieldset>
			<h2>Choix d'un nouveau mot de passe</h2>
			<input
				type="password"
				placeholder="nouveau mot de passe"
				name="user[newpassword]"
			/>
			<br />
			<input
				type="password"
				placeholder="confirmation du mot de passe"
				name="user[password_conf]"
			/>

		</fieldset>
		<fieldset>
			<!-- <input
				type="hidden"
				name="action[token]"
				value="<?=!empty($_GET['token']) ? $_GET['token'] : ( !empty($_POST['action']['token']) ? $_POST['action']['token'] : '' )?>"
			/> -->
			<input
				type="hidden"
				name="action[id]"
				value="<?=!empty($_GET['id']) ? $_GET['id'] : ( !empty($_POST['action']['id']) ? $_POST['action']['id'] : '' )?>"
			/>

			<input
				type="text"
				name="action[user]"
				value="<?=!empty($_GET['user']) ? $_GET['user'] : ( !empty($_POST['action']['user']) ? $_POST['action']['user'] : '' )?>"
			/>

			<input
				type="text"
				name="action[firstname]"
				value="<?=!empty($_GET['firstname']) ? $_GET['firstname'] : ( !empty($_POST['action']['firstname']) ? $_POST['action']['firstname'] : '' )?>"
			/>


			<input type="submit" name="action[newpassword]" value="changer le mot de passe" />
		</fieldset>

	</form>

	<?php include("includes/footer.html");?>

</body>

</html>