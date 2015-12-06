var contactFormHasError = false;

//affiche un message d'erreur dans le formulaire
function displayErrorMessage(errorMessage, fieldId){
	//change la booléenne pour garder en mémoire le fait que nous avons au moins une erreur
	contactFormHasError = true;

	//récupère l'élément parent
	var LineForm = $(fieldId).parent();

	//si notre contenant de message d'erreurs n'existe pas...
	if ( LineForm.has(".error-message").length == 0 ){
		//crée l'élément qui contiendra les messages d'erreur pour ce champs
		var errorMessageContainer = $("<div>").addClass("error-message");

		//l'ajoute dans le DOM
		LineForm.append(errorMessageContainer);
	}
	else {
		//récupère notre cotenant déjà présent dans le DOM, et recrée la var. errorMessageContainer
		var errorMessageContainer = LineForm.children(".error-message");
	}

	//ajoute une classe sur le form row
	//pour styliser les labels et les inputs automatiquement (voir le css)
	LineForm.addClass("has-error");
	
	//ajoute le message d'erreur dans son contenant
	errorMessageContainer.html(errorMessage);
}
 
//enlève les éventuelles traces des erreurs précédentes
function clearError(fieldId){
	var LineForm = $(fieldId).parent();
	LineForm.removeClass("has-error");
	LineForm.children(".error-message").remove();
}


//sera appelée sur soumission du form de contact
//déclenche la validation, affiche les messages d'erreurs s'il y a lieu
function validateContactForm(e){

	//remet la variable d'erreurs à false
	contactFormHasError = false;

	//empêche le comportement normal de l'événement de se produire
	//ici, bloque la soumission du formulaire
	//ne pas oublier le e dans les parenthèses, en argument de la fonction
	e.preventDefault();

	//validation du champ "nom"
	//on récupère la valeur tapée dans le champ
	var nameVal = $("#name").val().trim(); //trim() enlève les espaces au début et à la fin d'une chaîne
	var nameNumRegExp = /\d/;

	//le champs est vide ?
	if (nameVal == ""){
		displayErrorMessage("Veuillez renseigner votre nom", "#name");
	}
	//longueur minimale atteinte ?
	else if(nameVal.length <= 1){
		displayErrorMessage("Votre nom est trop court : 2 caractères minimum", "#name");
	}
	//chiffre présent dans le nom ?
	else if(nameNumRegExp.test(nameVal)){
		displayErrorMessage("Votre nom ne doit pas contenir de chiffre", "#name");
	}
	//pas d'erreur !!!
	else {
		clearError("#name");
	}


	//validation de l'email
	var emailVal = $("#email").val().trim();
	var emailRegexp = /^[a-zA-Z0-9._+-]+@[a-z0-9-]{1,67}\.[a-z]{2,67}$/;

	//champs requis
	if (emailVal == ""){
		displayErrorMessage("Veuillez renseigner votre email", "#email");
	}
	else if( emailRegexp.test(emailVal) === false ){
		displayErrorMessage("Votre email n'est pas valide", "#email");
	}
	//pas d'erreur !!!
	else {
		clearError("#email");
	}

	//validation du mot de passe
	var psVal = $("#password").val().trim();
	//var psRegexp = /^(\d{2}\.?){4}\d{2}$/; //attention, franco-centriste (avec point optionnels)

	//champs requis
	if (psVal == ""){
		displayErrorMessage("Veuillez définir un mot de passe", "#password");
	}
	// else if( telRegexp.test(telVal) === false ){
	// 	displayErrorMessage("Votre mot de passe n'est pas valide", "#password");
	// }
	//pas d'erreur !!!
	else {
		clearError("#password");
	}

	//validation de la confirmation du mot de passe
	var psConfVal = $("#password_conf").val().trim();
	//var psConfRegexp = /^(\d{2}\.?){4}\d{2}$/; //attention, franco-centriste (avec point optionnels)

	//champs requis
	if (psConfVal == ""){
		displayErrorMessage("Veuillez définir un mot de passe", "#password_conf");
	}
	// else if( psConfRegexp.test(psConfVal) === false ){
	// 	displayErrorMessage("Votre mot de passe n'est pas valide", "#password");
	// }
	//pas d'erreur !!!
	else {
		clearError("#password_conf");
	}

	//validation du téléphone
	var phoneVal = $("#phone").val().trim();
	var phoneRegexp = /^(\d{2}\.?){4}\d{2}$/; //attention, franco-centriste (avec point optionnels)

	//champs requis
	if (phoneVal == ""){
		displayErrorMessage("Veuillez renseigner votre téléphone", "#phone");
	}
	else if( phoneRegexp.test(phoneVal) === false ){
		displayErrorMessage("Votre téléphone n'est pas valide", "#phone");
	}
	//pas d'erreur !!!
	else {
		clearError("#phone");
	}

	//validation du n° de rue
	var nbStreetVal = $("#number_street").val().trim();
	var nbStreetRegexp = /\d/;

	//champs requis
	if (nbStreetVal == ""){
		displayErrorMessage("Veuillez renseigner le numéro de rue", "#number_street");
	}
	else if( nbStreetRegexp.test(nbStreetVal) === false ){
		displayErrorMessage("Votre numéro de rue n'est pas valide", "#number_street");
	}
	//pas d'erreur !!!
	else {
		clearError("#number_street");
	}


	//validation du nom de la rue
	var streetVal = $("#street").val().trim();
	// var streetRegexp = /\d/;

	//champs requis
	if (streetVal == ""){
		displayErrorMessage("Veuillez renseigner le nom de la rue", "#street");
	}
	// else if( streetRegexp.test(streetVal) === false ){
	// 	displayErrorMessage("Votre téléphone n'est pas valide", "#street");
	// }
	//pas d'erreur !!!
	else {
		clearError("#street");
	}

	//validation du code postal
	var zipVal = $("#zip").val().trim();
	var zipRegexp = /\d{5}/;

	//champs requis
	if (zipVal == ""){
		displayErrorMessage("Veuillez renseigner le code postal", "#zip");
	}
	else if( zipRegexp.test(zipVal) === false ){
		displayErrorMessage("Votre code postal n'est pas valide", "#zip");
	}
	//pas d'erreur !!!
	else {
		clearError("#zip");
	}


	//validation de la ville
	var cityVal = $("#city").val().trim();
	var cityRegexp = /[a-zA-Z-]/;

	//champs requis
	if (cityVal == ""){
		displayErrorMessage("Veuillez renseigner votre ville", "#city");
	}
	else if( cityRegexp.test(cityVal) === false ){
		displayErrorMessage("Le nom de votre ville n'est pas valide", "#city");
	}
	//pas d'erreur !!!
	else {
		clearError("#city");
	}


	//fin de la validation !

	//s'il y a des erreurs...

	//sinon, je dois soumettre le formulaire
	//méthode jQuery
	//if ($("#contact-form").find(".has-error").length <= 0){
	if (contactFormHasError == false){
		//soumission du formulaire
		//on retire d'abord la mise sous écoute du formulaire
		//pour éviter la boucle infinie
		$("#form-new-client").off("submit");
		$("#form-new-client").submit(); //déclenche la soumission du formulaire
	}
	else {
		//place le curseur dans le premier élément comportant une erreur
		$(".has-error input, .has-error select, .has-error textarea").first().focus();
		alert("Votre formulaire comporte des erreurs !");
	}
}

//mise sous écoute de l'événement de soumission du formulaire
$("#form-new-client").on("submit", validateContactForm);
