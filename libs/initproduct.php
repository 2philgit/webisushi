<?php
	session_start(); 
	//unset($_SESSION['basket']);
	$productQty = 0;
	if (! isset($_SESSION['basket']) ) {
	 	$_SESSION['basket'][0]= $_POST;
	 	$productQty += $_POST['qty'];
	} else {
		$panier = $_SESSION['basket'];		
		foreach($panier as $key => $value) {
			$productQty += $_SESSION['basket'][$key]['qty'];	
		}
	};
	echo $productQty;