# GRAFIKART-SYMFONY4

***POINTS INTERESSANTS***

1) Utiliser cocur/slugify
2) CSS Bootstrap (.card-box, .card-title...)
3) Créer ses propres méthodes dans l'entité.
4) Instancier le repository et le manager dans le constructeur du controller
5) Méthode compact utilisable dans le rendu du controller
6) Paramconverter dès qu'il y a un id.
7) Au lieu de mettre les labels, on peut passer par un fichier forms.fr.yaml. On vérifie que la locale est FR
dans services.yaml, puis dans le formType, on utilise translation_domain en bas.
8) Pour éviter la duplication de code, on utilise un seul formulaire pour ajouter et éditer: on inclut un fichier _form.html.twig.
9) Dans les annotations du controller, il faut bien ajouter les méthodes GET POST et DELETE pour distinguer les routes.
10) Pour le bouton Supprimer, on crée un mini-formulaire avec un champ caché. ATTENTION! On doit utiliser le système de token CSRF pour ce mini-formulaire.
Puis il faut vérifier le token dans le controller avec la méthode isCsrfTokenValid.
11) Eviter de mettre les messages flash dans base.html.twig car il y a une vérification de session systématique.