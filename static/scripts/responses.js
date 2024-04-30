function getBotResponse(input) {
	
	var myString =input;
    var res="";
	//example d'utilisation
    switch (myString) {
        case 'trouver' :
            res= "Vous pouvez trouver des services en utilisant la fonction de\
            recherche disponible en haut à droite de l'application ou en parcourant les catégories de services disponibles";
            break;
        case 'proposer':
            res= "Pour proposer vos services, vous devez créer un compte sur l'application.\
            Une fois connecté, vous pourrez créer une annonce pour vos services et la publier sur la plateforme.";
            break;
        case 'contacter':
            res= "Vous pouvez contacter un <br> utilisateur pour des services\
            en utilisant la fonction de chat disponible dans l'application. Vous pourrez ainsi discuter de votre projet et convenir des détails.";
            break;
        case 'evaluer':
            res= "Vous pouvez évaluer la qualité des services en consultant\
            les évaluations et les commentaires laissés par d'autres utilisateurs sur la page du fournisseur.";
            break;
        case 'supprimer':
            res= "Vous pouvez modifier ou supprimer une annonce pour vos services en accédant à votre compte sur l'application et en sélectionnant \
            l'annonce que vous souhaitez modifier ou supprimer.";
            break;
        default :
            var a = document.createElement('a');
            var linkText = document.createTextNode("Contacter support ici");
            a.appendChild(linkText);
            a.href = "mailto:projet.terd@gmail.com?subject=Assistance";
            $("#chatbox").append(a);
            return "Si votre question ne figure pas dans notre F.A.Q merci de nous envoyer votre question par email.";


    }
    return res;
    //autre possibilite d'utilisation mais moins efficace
	/*var result = myString.indexOf("trouv");
	if (result > -1) {
    return "Vous pouvez trouver des services en utilisant la fonction de\
    recherche disponible en haut à droite de l'application ou en parcourant les catégories de services disponibles";*/

}