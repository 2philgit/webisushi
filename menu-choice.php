 <?php
 try {
	$pdo = include('data/pdo.php');

} catch (Exception $e) {


        die('Erreur');

}
		
$getimage = $pdo->query('SELECT image, name, description, price  FROM produits');
$donnees = $getimage->fetchall();
	

foreach ($donnees as $key => $value) {
	?>
	<button type="submit" value="text" >selectionner</button>
	<input type="number" name="howmuch">
	<img src="<?php echo $donnees[$key]['image'];?>"/>
	<h3><?php echo $donnees[$key]['name'];?></h3>
	<p><?php echo $donnees [$key]['description'];?></p>
	<p><?php echo $donnees [$key]['price'] . "€";?></p>
	<?php
}	
		
?>
