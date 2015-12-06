 <?php
 try {
	$pdo = include('data/pdo.php');

} catch (Exception $e) {
        die('Erreur');
}
		
$getimage = $pdo->query('SELECT id, image, name, description, price  FROM produits');
$donnees = $getimage->fetchall();
	

foreach ($donnees as $key => $value) {
	?>
	<div class="one-product" id="product-<?=$donnees[$key]['id']; ?>">
		<h3><?php echo $donnees[$key]['name'];?></h3>
		<button type="submit" value="text" data-product="<?=$donnees[$key]['id']; ?>">selectionner</button>
		<input id="qty" type="number" name="howmuch" value="1">
		<input id="price" type="hidden" value="<?=$donnees[$key]['price'] ?>">
		<img src="<?php echo $donnees[$key]['image'];?>"/>		
		<p><?php echo $donnees[$key]['description'];?></p>
		<p><?php echo $donnees[$key]['price'] . "€";?></p>
	</div>	
	<?php
}	
		
?>
