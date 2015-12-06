function handleAjaxError(){
	console.log("fail");
}

// initialisation du panier si celui-ci est vide => on le cache
function init(){
	$.ajax({
		"url": "libs/initproduct.php",
		"type": "POST",
	})
	.done(function(response){
		$add = $("#fix-menu sup").html(response);
		if (response > 9) {
			$("#fix-menu sup").css("padding","6");	
		}
		$add.show();
	})
	.fail(handleAjaxError)	
}
init();




function addBasket(e){
	e.preventDefault();
	$product = this.dataset.product;
	$elem = $("#product-"+$product);
	$qty = $elem.children("#qty").val();
	$price = $elem.children("#price").val();
	$.ajax({
		"url": "libs/addproduct.php",
		"type": "POST",
		"data": {
			"product":$product,
			"price":$price,
			"qty":$qty
		},
	})
	.done(function(response){
		$add = $("#fix-menu sup").html(response);
		if (response > 9) {
			$("#fix-menu sup").css("padding","6");	
		}
		$add.show();
	})
	.fail(handleAjaxError);
}



$(".one-product button").on("click", addBasket);

