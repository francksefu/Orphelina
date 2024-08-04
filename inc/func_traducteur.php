<?php

function tr($word) {
 switch ($word) {
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
    case 'Food favorite':
        return 'Nourriture favorite';
    case 'Hobbies':
        return 'Passe-temps';
    case 'Couleur':
        return 'Color';
    case 'Meilleur ami':
        return 'Best friend';
    case 'Quel est ton plus grand reve ou souhait?':
        return 'What is your biggest dream or wish?';
    case 'Fait ou caracter interessant sur l enfant':
        return 'Interesting Fact about child or chaterstic traits';
    return $word;
 }
}