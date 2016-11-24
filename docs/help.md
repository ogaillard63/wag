# Aide

++ Cas des champs liés par un id à une autre table ++
Ex :  section_id vers section->name

Objet 2 dans table permet de saisir le nom du champ externe (ex : section)

> Affichage
1 - Utiliser les fonctions optionnelles en remplacement des fonctions classiques


> Modification


<div class="form-group">
    <label>{#section#|ucfirst}</label>
    {if isset($item->section_id)}{html_options name=section_id options=$sections selected=$item->section_id class="form-control"}{else}{html_options name=section_id options=$sections class="form-control"}{/if}
</div>

Dans 

1 - Generation d'une fonction pour peupler un menu déroulant
2 - Generation de la colonne dans le gabarit list
3 - Generation du menu dans le gabarit edit
4 - Generation de la fonction permettant de rechercher le nom à partir de l'id  

Exemple : table article contenant categorie_id
