<!-- page header -->
<?php include('includes/header.php') ; ?>

<section class="products">
	<article>
		<h2>Les meilleurs Sushi de Paris !<span id="userhello"><?= !empty($nameUser) ? 'Bonjour '. $nameUser  : ''?></span></h2>
		 
		<div id="tease" class="clearfix">
			<img src="img/img-accueil.png" alt="Les meilleurs sushi de Paris">				
			<p>Chez vous en moins d'une demi-heure, déguster les meilleurs sushi de Paris, fabriqués des maîtres sushi d'exception</p>
		</div>
	</article>
</section>
<section id="menu-choice">
	<?php include('product.php'); ?>
</section>
<section class="products" id="nav-bottom">
	<nav>
		<ul>
			<li><a href="liste-menu.php" title="carte">carte <i class="fa fa-chevron-right"></i></a></li>
			<li><a href="#" title="compte">compte client<i class="fa fa-chevron-right"></i>
</a></li>
			<li><a href="#" title="contact">contact<i class="fa fa-chevron-right"></i>
</a></li>
		</ul>
	</nav>
	
</section>


<!-- pied de page du site -->
<?php include('includes/footer.html') ; ?>

