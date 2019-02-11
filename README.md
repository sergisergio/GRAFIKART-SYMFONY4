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
12) Security: utiliser UserInterface dans l'entité User ( méthodes: getRoles, getPassword et eraseCredentials)/
13) Ajout de l'interface \Serializable pour sauvegarder l'utilisateur en session.
14) Avec AuthenticationUtils, on peut mettre dans le value du champ input du formulaire value="{{ last_username }}"
15) Voir dans le terminal la commande config:dump-reference security
16) Pour les fixtures, on ajoute --append lors du chargement pour ne pas vider la BDD.
17) Utiliser UserPasswordEncoderInterface pour chiffrer le mot de passe.
18) (Pagination )[https://packagist.org/packages/knplabs/knp-paginator-bundle]
19) ***Filtrer les biens***: création d'une entité PropertySearch non reliée à Doctrine.
20) Puis création d'un formulaire relié à cette classe (mettre le chemin complet pour l'entité).
21) Passer la méthode en get et csrf_protection en false dans la méthode configureOptions().
22) Puis utiliser ce formulaire dans le controller.
23) Inclure ce formulaire dans Twig.
24) Voir la méthode getBlockPrefix() dans PropertySearchType (pour ne pas voir les varaibles dans l'URL).
25) Passer le paramètre $search dans la méthode find() du controller et modifier en conséquence cette méthode dans PropertyRepository.
26) ***Gestion des options***: création d'une entité Option liée à l'entité Property (relation ManyToMany)
27) Ajouter les options dans AdminPropertyController.
28) Création d'un nouveau contrôleur pour gérer les options (bin/console make:crud Option)
29) Dans la création d'un bien, on ajoute un champ select pour ajouter les options. Il faut donc modifier le PropertyType et ajouter un nouveau champ.
30) EntityType (class Option, choice_label name, multiple = true)
31) Faire très attention au owning-side et au inverse-side.
32) Utilisation de select2.min.css et select2.min.js pour le champ des options
33) Ajout d'un champ 'options' dans le PropertySearchType et donc ajout aussi dans l'entité PropertySearch
34) Ajout du champ options dans le formulaire de recherche dans Twig
35) Ajout du filtre dans PropertyRepository.
36) [DOCTRINE DQL](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/dql-doctrine-query-language.html)
37) ***Images à la une***: installation de [VichUploader](https://github.com/dustin10/VichUploaderBundle)
38) Remplir le fichier vich_uploader.yaml, modifier l'entité
39) Ajouter un nouveau champ permettant d'ajouter une image dans PropertyType ainsi que dans Twig.
40) A ce stade, les images ne sont pas encore persistées. (Voir known issues dans la doc de Vich): il faut ajouter un champ updated_at et modifier la méthode setImageFile().L'image devrait s'ajouter correctement.
41) Voir Les namers: VichUploaderBundle\Resources\doc\namers.md (pour générer une clé pour chaque fichier qui a été uploadé). Si on uploade un nouveau fichier, l'ancien fichier est supprimé !
42) Mise en place de l'image dans Twig ({{ vich_uploader_asset(property, 'imageFile') }})
43) Installation d'un Bundle pour le redimensionnement des images: [liip/imagine-bundle](https://github.com/liip/LiipImagineBundle)
44) Configuration du fichier Yaml et utilisation du filtre imagine_filter dans Twig.
45) Par contre, les images sont gardées dans le cache: il va donc falloir les supprimer...
46) Vérifier les contraintes dans l'entité pour téléchager le fichier ( @Assert\Image(....)).
47) Traitement de la logique de suppression des images en cache dans les controllers grâce à CacheManager et UploaderHelper.
48) Puis suppression de cette logique pour plutôt utiliser des évènements.
49) [Lifecycle Events](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/events.html)
50) Création de Listener/imageCacheSubscriber et mise en place des 2 events (preFlush et preUpdate). Ajout dans services.yaml.
51) Mettre en place une image par défaut si un bien n'a pas d'image.
52) Création du ContactType puis de la vue - Traitement du formulaire dans PropertyController.
53) Dans src, création d'un dossier Notification puis d'une classe ContactNotification pour avoir une représentation de la personne que l'on va contacter.
54) [GESTION DES EMAILS](https://symfony.com/doc/current/email.html)
55) Pour tester les mails en local, voir Maildev.
56) Utilisation de cette classe de notification dans le controller.
57) Utilisation d'un template Email [mjml](https://mjml.io/)

