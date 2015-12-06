<?php
	session_start(); 
	//unset($_SESSION['basket']);
	$productQty = 0;
	if (! isset($_SESSION['basket']) ) {
	 	$_SESSION['basket'][0]= $_POST;
	 	$productQty += $_POST['qty'];
	} else {
		$panier = $_SESSION['basket'];
		$add = 1;		
		foreach($panier as $key => $value) {
			if ($value['product'] === $_POST['product'] ) {
				$_SESSION['basket'][$key]['qty'] += $_POST['qty'];
				$_SESSION['basket'][$key]['price'] += $_POST['price'];
				$add = 0; 
			}
			$productQty += $_SESSION['basket'][$key]['qty'];	
		}
		if ($add) {
			$productQty += $_POST['qty'];
			array_push($_SESSION['basket'], $_POST);
		}
	};
	echo $productQty;