//création de 3 éléments HTMLElement
var $addButtonFormation = $('<button type="button" class="add_collection_link">Ajouter une formation</button>');
var $delButton = $('<button type="button" class="del_collection_link">Supprimer</button>');
//le premier élément li de la liste (celui qui contient le bouton 'ajouter')
var $newLinkLiFormation = $('<li></li>').append($addButtonFormation);

function generateDeleteButton($collection){
    var $btn = $delButton.clone();
    $btn.on("click", function(){//événement clic du bouton supprimer
        $(this).parent("li").remove();
        $collection.data('index', $collection.data('index')-1)

    })

    return $btn;
}

//fonction qui ajoute un nouveau champ li (en fonction de l'entry_type du collectionType) dans la collection
function addFormationForm($formation, $newLinkLiFormation) {
    
    //contenu du data attribute prototype qui contient le HTML d'un champ
    var newFormFormation = $formation.data('prototype');
    //le nombre de champs déjà présents dans la collection
    var index = $formation.data('index');
    //on remplace l'emplacement prévu pour l'id d'un champ par son index dans la collection
    newFormFormation = newFormFormation.replace(/__name__/g, index);
    //on modifie le data index de la collection par le nouveau nombre d'éléments
    $formation.data('index', index+1);

    //on construit l'élément li avec le champ et le bouton supprimer
    var $newFormLiFormation = $('<li></li>').append(newFormFormation).append(generateDeleteButton($formation));
    //on ajoute la nouvelle li au dessus de celle qui contient le bouton "ajouter"
    $newLinkLiFormation.before($newFormLiFormation);
}


//rendu de la collection au chargement de la page
$(document).ready(function() {

    //on pointe la liste complete (le conteneur de la collection)
    var $formations = $("ul#formations")
    var $stagli = $("ul#formations li")

     //pour chaque li déjà présente dans la collection (dans le cas d'une modification)
    $stagli.each(function(){
        //on génère et ajoute un bouton "supprimer"
        $(this).append(generateDeleteButton($formations));
    })
    //on y ajoute le bouton ajouter (à la fin du contenu)
    $formations.append($newLinkLiFormation);
    //le data index de la collection est égal au nombre de input à l'intérieur
    $formations.data('index', $stagli.length);

    $addButtonFormation.on('click', function() { // au clic sur le bouton ajouter

        //on appelle la fonction qui ajoute un nouveau champ
        addFormationForm($formations, $newLinkLiFormation);
    });

});