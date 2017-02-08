
# Memo fonctionnalités

- L'option $exclude_notchecked permet de ne pas faire figurer certaines colonnes (par exemple dans les listes)

- La méthode get#Objets#ByParent permet d'afficher une liste de catégories ou un menu déroulant en respectant la hiérarchie.
des catégories. La table doit comporter un champ parent_id.

- la table de l'objet lié doit avoir un champ name

# Bugs
+ Le bouton ANNULER des formulaires fait un submit
+ Pas de notification lors de l'effacement

# Todo
+ Normalisaition des id en uid
+ Debug du problème avec les objets ayant un underscore dans le nom
+ Ajout d'un moteur de recherche
+ Gestion des erreurs liés aux contraintes d'intégritées
+ Ajout de clés etrangères sur les tables

ALTER TABLE `articles`
	ADD CONSTRAINT `FK_articles_types` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);


# Idées
Generer plusieurs versions de codes 
 - Gestion simple d'un objet  
 - Gestion simple d'un objet + recherche
 - Gestion simple d'un objet + objet lié
 - Gestion simple d'un objet + objet lié + recherche





