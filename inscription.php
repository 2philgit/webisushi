
<?php

$error = '';
$address = '';
$allFields = !empty($_POST['new_client']['name']) && !empty($_POST['new_client']['firstname']) && !empty($_POST['new_client']['email']) && !empty($_POST['new_client']['password'])&& !empty($_POST['new_client']['password_conf']) && !empty($_POST['new_client']['phone']) && !empty($_POST['new_client']['number_street']) && !empty($_POST['new_client']['street']) && !empty($_POST['new_client']['zip']) && !empty($_POST['new_client']['city']);

$tab_error = [];

if ( $_POST ) {

	 $keys = ["new_client['name']", "new_client['email']", "new_client['phone']"];
	    foreach ( $keys as $key ) {
	        if ( empty($_POST[$key]) || !trim($_POST[$key]) ) {  // trim() supprime les espaces avt et après ds une chaîne
	                                                             // ici, gère le fait que l'utilisateur est mis des espaces uniquement
	            // si le champ est vide, on crée l'index correspondant à
	            // ce champ dans le tableau $error, de manière à le réutiliser plus bas.
	            $tab_error[$key] = "le champ $key est manquant !\n";
	        }
	   } 

	if (empty($_POST['action']['connexion'])) { // test en premier si le bouton "connexion" n'a pas été cliqué


		if ( !empty($_POST['action']['registred'])) {
			
			if ($allFields) {

				$pdo = include('data/pdo.php');
				$address = $_POST['new_client']['number_street'] . ", " . $_POST['new_client']['street'] . ", " . $_POST['new_client']['zip'] . " " . $_POST['new_client']['city'];

				$statement = $pdo->prepare('INSERT INTO clients (`name`, `firstname`, `email`, `password`, `phone`, `address`, `created`) 
											VALUES (:name, :firstname, :email, :password, :phone, :address, NOW()) ;');
				$statement->execute([
					':name' => $_POST['new_client']['name'],
					':firstname' => $_POST['new_client']['firstname'],
					':email' => $_POST['new_client']['email'],
					':password' => $_POST['new_client']['password'],
					':phone' => $_POST['new_client']['phone'],
					':address' => $address,
				]);

				if ( $_POST['new_client']['password'] === $_POST['new_client']['password_conf'] ) {

				$statement = $pdo->prepare('SELECT * FROM clients WHERE email = ? ;');
				$statement->execute([$_POST['new_client']['email']]);
				$users = $statement->fetchAll();
		
				// if ( count($users) ) {
					
					session_start();
					$_SESSION['auth'] = $users[0];
					die(header('Location: ./' . ( !empty($_POST['action']['next']) ? $_POST['action']['next'] : '' ) ));

				} else $error = "Les mots de passes ne sont pas identiques.";

				// } else $error = "Email ou mot de passe erroné.";

			} else $error = "Tous les champs doivent être remplis.";

		} else $error = "Le formulaire n'a pas été correctement validé.";
	}

}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>inscription</title>
	<link rel="stylesheet" href="css/style_phil.css">
</head>

<body>
	<div class="wrapper style-form ">
		<h2>Nouveau client</h2>
		<h3>Remplissez le formulaire d'inscritpion :</h3>
		<br />
		<P>* : champs obligatoires</P>
		<br />

		<form id="form-new-client" action="connexion.php" method="POST">

			<?php if ( $error ) { ?>
				<h3 style="color: red;"><?=$error?></h3>
			<?php } ?>

			

			<div class="line-form">
				<label for="new_client[name]" class="<?=!empty($tab_error["new_client['name']"]) ? 'error' : '' ?>">Votre nom :</label>

				<!-- <label for="new_client[name]">Votre nom :</label> -->
				<input
					id="name"
					type="text"
					placeholder="nom"
					name="new_client[name]"
					value="<?=!empty($_POST['new_client']['name']) ? $_POST['new_client']['name'] : ''?>"
				/>
			</div>

			<div class="line-form">	
				<label for="new_client[firstname]">Votre prénom :</label>
				<input
					id="firstname"
					type="text"
					placeholder="prénom"
					name="new_client[firstname]"
					value="<?=!empty($_POST['new_client']['firstname']) ? $_POST['new_client']['firstname'] : ''?>"
				/>
			</div>

			<div class="line-form">
				<label for="new_client[email]">Votre email :</label>
				<input
					id="email"
					type="text"
					placeholder="email"
					name="new_client[email]"
					value="<?=!empty($_POST['new_client']['email']) ? $_POST['new_client']['email'] : ''?>"
				/>
			</div>

			<div class="line-form">
				<label for="new_client[password]">Votre mot de passe :</label>
				<input id="password" type="password" placeholder="password" name="new_client[password]" />
			</div>	

			<div class="line-form">
				<label for="new_client[password_conf]">Confirmation du mot de passe :</label>
				<input id="password_conf" type="password" placeholder="confirmation password" name="new_client[password_conf]" />
			</div>

			<div class="line-form">
				<label for="new_client[phone]">Votre téléphone :</label>
				<input
					id="phone"
					type="tel"
					placeholder="téléphone"
					name="new_client[phone]"
					value="<?=!empty($_POST['new_client']['phone']) ? $_POST['new_client']['phone'] : ''?>"
				/>
			</div>

			<div class="line-form">
				<label>Votre adresse :</label>
				<input
					id="number_street"
					type="int"
					placeholder="n° de rue"
					name="new_client[number_street]"
					value="<?=!empty($_POST['new_client']['number_street']) ? $_POST['new_client']['number_street'] : ''?>"
				/>
			</div>

			<div class="line-form">	
				<div class="fake-label"></div> <!-- classe fake-label pour pouvoir placer correctement le champ -->
				<input
					id="street"
					type="text"
					placeholder="rue"
					name="new_client[street]"
					value="<?=!empty($_POST['new_client']['street']) ? $_POST['new_client']['street'] : ''?>"
				/>
			</div>		

			<div class="line-form">
				<div class="fake-label"></div>
				<input
					id="zip"
					type="int"
					placeholder="code postal"
					name="new_client[zip]"
					value="<?=!empty($_POST['new_client']['zip']) ? $_POST['new_client']['zip'] : ''?>"
				/>
			</div>

			<div class="line-form">
				<div class="fake-label"></div>	
				<input
					id="city"
					type="text"
					placeholder="ville"
					name="new_client[city]"
					value="<?=!empty($_POST['new_client']['city']) ? $_POST['new_client']['city'] : ''?>"
				/>
			</div>

			<input
				type="hidden"
				name="action[next]"
				value="<?=!empty($_GET['next']) ? $_GET['next'] : ( !empty($_POST['action']['next']) ? $_POST['action']['next'] : '' )?>"
			/>

			<div class="fake-label"></div>	
			<input type="submit" name="action[registred]" value="inscription" />

		</form>
	</div>  <!-- FIN div wrapper -->

	<script src="js/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<!--<script src="js/main_phil.js"></script> -->
</body>
</html>