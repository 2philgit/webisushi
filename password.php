<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>connexion</title>
</head>

<?php

$error = '';
$password = '';
$id = '';
$user ='';
$firstname = '';

if ( $_POST ) {

	if ( !empty($_POST['action']['password']) ) {
		
		if ( !empty($_POST['user']['email'])  ) {
			
			$pdo = include('data/pdo.php');
			$userQuery = $pdo->prepare('SELECT * FROM clients WHERE email = ?;');
			$userQuery->execute([$_POST['user']['email']]);
			$users = $userQuery->fetchAll();

			if ( $users ) {
				$id = $users[0]['id'];
				$firstname = $users[0]['firstname'];
				$password = $users[0]['password'];
				$user = $users[0]['email'];

			} else $error = "L'email n'est pas utilisé.";

		} else $error = "Tous les champs doivent être remplis.";

	} else $error = "Le formulaire n'a pas été correctement validé.";

}

?>
<html>
<head>
</head>
<body>

	<?php include("includes/header.php"); ?>

	<form action="password.php" method="post">
		
		<?php if ( $error ) { ?>
		<h2 style="color: red;"><?=$error?></h2>
		<?php } ?>
		<fieldset>
			<h2>Modification de votre mot de passe</h2>
			<input
				type="text"
				placeholder="email"
				name="user[email]"
				value="<?=!empty($_POST['user']['email']) ? $_POST['user']['email'] : ''?>"
			/>

		</fieldset>
		<fieldset>
			<input type="submit" name="action[password]" value="envoi" />
		</fieldset>

		<?php if ( $id ) { ?>
		<a href="newpassword.php?id=<?=$id?>&user=<?=$user?>&firstname=<?=$firstname?>">Changer le mot de passe</a>
		<?php } ?>
	</form>

	<?php include("includes/footer.html");?>

</body>

</html>