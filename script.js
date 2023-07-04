// Attendre que le contenu de la page soit chargé avant d'exécuter le code
window.addEventListener('DOMContentLoaded', function() {

    // Obtenir l'élément de formulaire avec l'ID 'apprenant-form'
    var form = document.getElementById('apprenant-form');

    // Ajouter un écouteur d'événement de soumission au formulaire
    form.addEventListener('submit', function(event){
        // Empêcher le comportement de soumission par défaut du formulaire
        event.preventDefault();

        // Validation du matricule
        var matriculeInput = document.getElementById('matricule');
        var matriculeRegex = /^P[1-3][A-Z0-9]{4}$/;
        //voir la concordance de l'age et de la date de naissance
        var dateNaissance = document.getElementById("date_naissance").value;
        var age = parseInt(document.getElementById("age").value);

        //calcule pour l'année de naissance
        var dateActuelle = new Date();
        var anneeActuelle = dateActuelle.getFullYear();
        var anneeNaissanceAttendue = anneeActuelle - age;

        // verification
        var anneeNaissanceFournie = new Date(dateNaissance).getFullYear();

        if (anneeNaissanceAttendue !== anneeNaissanceFournie) {
        alert("L'âge saisi ne correspond pas à la date de naissance.");
        // Empêcher la connexion ou l'enregistrement
        return;
        }

// Le formulaire est valide, continuer avec la connexion ou l'enregistrement



        // Si le matricule est valide, soumettre le formulaire
        form.submit();
    });

});
