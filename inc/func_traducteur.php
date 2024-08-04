<?php

function tr($word) {
    $langue = $_SESSION['langue'] == 'francais';
    if ($langue) {
        return $word;
    }
 switch ($word) {
    case 'Comptabilite' :
        return 'Accounting';
    case 'Ajouter' :
        return 'Add';
    case 'Voir' :
        return 'View';
    case 'Ajouter' :
        return 'Add';
    case 'Entrée' :
        return 'accounting entry';
    case 'Sortie' :
        return 'accounting exit';
    case 'Produit' :
        return 'product';
    case 'un' :
    case 'les' :
    case 'une' :
        return '';
    case 'entrée dans le depot' :
        return 'entry to the depot';
    case 'sortie dans le depot':
        return 'exit to the depot';
    case 'l inventaire des entrées dans le depot' :
        return 'the inventory of entries in the depot';
    case 'l inventaire des sorties dans le depot' :
        return 'the inventory of exits from the depot';
    case 'Entrée trié' :
        return 'Sorted accounting entry';
    case 'Sortie trié' :
        return 'Sorted accounting exit';
    case 'inventaire des entrées':
        return 'inventory of entries';
    case 'inventaire des sorties':
        return 'inventory of exits';
    case 'Inventaire':
        return 'Inventory';
    case 'enfant reunifie entre 2 date':
        return 'Reunified child between two dates';
    //

    case 'Date d arrivee' :
        return 'Date of entering';
    case 'Nom' :
        return 'Name';
    case 'Date de naissance' :
        return 'Birthday';
    case 'annee d ecole' :
        return 'Current class in school';
    case 'Siblings at home?':
        return 'Freres et soeurs?';
    case 'Age à l entrée':
        return 'Age entering';
    case 'Arriere-plan':
        return 'Story';
    case 'Sujet favori' :
        return 'Favorite Subjects';
    case 'Quel est le travail de tes reves?':
        return 'What occupation do you want to be when you grow up?';
    case 'Nourriture favorite':
        return 'Food favorite';
    case 'Passe-temps':
        return 'Hobbies';
    case 'Couleur':
        return 'Color';
    case 'Meilleur ami':
        return 'Best friend';
    case 'Quel est ton plus grand reve ou souhait?':
        return 'What is your biggest dream or wish?';
    case 'Fait ou caracter interessant sur l enfant':
        return 'Interesting Fact about child or chaterstic traits';
    case 'Status de reunification':
        return 'Reunification Status';
    case 'Status de reunification':
        return 'Reunification Status';
    case 'Description sur la reunification':
        return 'Description of the reunification';
    case 'Date de reunification':
        return 'Reunification date';
    case 'Enfant' :
        return 'Child';
    case 'enfants':
        return 'children';
    case 'Rechercher' :
        return 'Search';
    case 'Parametres' :
        return 'settings';
    case 'Rapports':
        return 'Reports';


    return $word;
 }
}