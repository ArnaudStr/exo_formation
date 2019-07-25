//création de 3 éléments HTMLElement
var $addButtonModule = $('<button type="button" class="add_collection_link">Ajouter un module</button>');
var $delButton = $('<button type="button" class="del_collection_link">Supprimer</button>');
//le premier élément li de la liste (celui qui contient le bouton 'ajouter')
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
function addModuleForm($module, $newLinkLiModule) {
    
    //contenu du data attribute prototype qui contient le HTML d'un champ
    var newFormModule = $module.data('prototype');
    //le nombre de champs déjà présents dans la collection
    var index = $module.data('index');
    //on remplace l'emplacement prévu pour l'id d'un champ par son index dans la collection
    newFormModule = newFormModule.replace(/__name__/g, index);
    //on modifie le data index de la collection par le nouveau nombre d'éléments
    $module.data('index', index+1);

    //on construit l'élément li avec le champ et le bouton supprimer
    var $newFormLiModule = $('<li></li>').append(newFormModule).append(generateDeleteButton($module));
    //on ajoute la nouvelle li au dessus de celle qui contient le bouton "ajouter"
    $newLinkLiModule.before($newFormLiModule);
}


//rendu de la collection au chargement de la page
$(document).ready(function() {

    //on pointe la liste complete (le conteneur de la collection)
    var $modules = $("ul#modules")
    var $stagli = $("ul#modules li")

     //pour chaque li déjà présente dans la collection (dans le cas d'une modification)
    $stagli.each(function(){
        //on génère et ajoute un bouton "supprimer"
        $(this).append(generateDeleteButton($modules));
    })
    //on y ajoute le bouton ajouter (à la fin du contenu)
    $modules.append($newLinkLiModule);
    //le data index de la collection est égal au nombre de input à l'intérieur
    $modules.data('index', $stagli.length);

    $addButtonModule.on('click', function() { // au clic sur le bouton ajouter

        //on appelle la fonction qui ajoute un nouveau champ
        addModuleForm($modules, $newLinkLiModule);
    });

});