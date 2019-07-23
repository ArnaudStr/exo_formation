//création de 3 éléments HTMLElement
var $addButtonStagiaire = $('<button type="button" class="add_collection_link">Ajouter un stagiaire</button>');
var $addButtonModule = $('<button type="button" class="add_collection_link">Ajouter un module</button>');
var $delButton = $('<button type="button" class="del_collection_link">Supprimer</button>');
//le premier élément li de la liste (celui qui contient le bouton 'ajouter')
var $newLinkLiStagiaire = $('<li></li>').append($addButtonStagiaire);
var $newLinkLiModule = $('<li></li>').append($addButtonModule);

function generateDeleteButton($collection){
    var $btn = $delButton.clone();
    $btn.on("click", function(){//événement clic du bouton supprimer
        $(this).parent("li").remove();
        $collection.data('index', $collection.data('index')-1)

    })

    return $btn;
}

//fonction qui ajoute un nouveau champ li (en fonction de l'entry_type du collectionType) dans la collection
function addStagiaireForm($stagiaire, $newLinkLiStagiaire) {
    
    //contenu du data attribute prototype qui contient le HTML d'un champ
    var newFormStagiaire = $stagiaire.data('prototype');
    //le nombre de champs déjà présents dans la collection
    var index = $stagiaire.data('index');
    //on remplace l'emplacement prévu pour l'id d'un champ par son index dans la collection
    newFormStagiaire = newFormStagiaire.replace(/__name__/g, index);
    //on modifie le data index de la collection par le nouveau nombre d'éléments
    $stagiaire.data('index', index+1);

    //on construit l'élément li avec le champ et le bouton supprimer
    var $newFormLiStagiaire = $('<li></li>').append(newFormStagiaire).append(generateDeleteButton($stagiaire));
    //on ajoute la nouvelle li au dessus de celle qui contient le bouton "ajouter"
    $newLinkLiStagiaire.before($newFormLiStagiaire);
}

//fonction qui ajoute un nouveau champ li (en fonction de l'entry_type du collectionType) dans la collection
function addModuleForm($module, $newLinkLiModule) {
    
    //contenu du data attribute prototype qui contient le HTML d'un champ
    var newFormModule = $module.data('prototype');

    var index = $module.data('index');

    //on remplace l'emplacement prévu pour l'id d'un champ par son index dans la collection
    newFormModule = newFormModule.replace(/__name__/g, index);

    $module.data('index', index+1);

    //on construit l'élément li avec le champ et le bouton supprimer
    var $newFormLiModule = $('<li></li>').append(newFormModule).append(generateDeleteButton($module));
    //on ajoute la nouvelle li au dessus de celle qui contient le bouton "ajouter"
    $newLinkLiModule.before($newFormLiModule);
}

//rendu de la collection au chargement de la page
$(document).ready(function() {

    //on pointe la liste complete (le conteneur de la collection)
    var $stagiaires = $("ul#stagiaires")
    var $stagli = $("ul#stagiaires li")

    var $modules = $("ul#modules")
    var $modli = $("ul#modules li")
     //pour chaque li déjà présente dans la collection (dans le cas d'une modification)
    $stagli.each(function(){
        //on génère et ajoute un bouton "supprimer"
        // console.log($(this.li))
        $(this).append(generateDeleteButton($stagiaires));
    })
    //on y ajoute le bouton ajouter (à la fin du contenu)
    $stagiaires.append($newLinkLiStagiaire);
    console.log($stagiaires)
    //le data index de la collection est égal au nombre de input à l'intérieur
    $stagiaires.data('index', $stagli.length);
    console.log($stagiaires.data('index'))

    $addButtonStagiaire.on('click', function() { // au clic sur le bouton ajouter
        var nbPlaces = $('input#formation_nbPlaces').val();

        //si la collection n'a pas encore autant d'élément que le maximum autorisé
        if(nbPlaces != ""){
            if($stagiaires.data('index') < nbPlaces){
                
                //on appelle la fonction qui ajoute un nouveau champ
                addStagiaireForm($stagiaires, $newLinkLiStagiaire);
                // addCollectionForm($collection2, $newLinkLi);
            }
            else alert("Nb max atteint !")
        }
    });

    $modli.each(function(){
        //on génère et ajoute un bouton "supprimer"
        // console.log($(this.li))
        $(this).append(generateDeleteButton($modules));
    })
    //on y ajoute le bouton ajouter (à la fin du contenu)
    $modules.append($newLinkLiModule);

    $modules.data('index', $modli.length);


    $addButtonModule.on('click', function() { // au clic sur le bouton ajouter

                addModuleForm($modules, $newLinkLiModule);
    });

});