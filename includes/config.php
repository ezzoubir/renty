<?php

/* Configuration  GLOBAL */
define('FCKEDITOR',true);
define('SQL_SVR','localhost'); 
define('SQL_LOGIN','root');
define('SQL_PASS','');
define('SQL_DATABASE','rentycar');
Define("PREFIXE_BDD","cms_v2_");
define("BASE_URL","http://www.rentycartest.com/"); //url de base 
define("BASE_REP","/"); //url de base 
define("RepPhoto",'images/photos/');
define('NBR_ARTICLE_PAR_PAGE',20);
define ('LOGIN_ADMIN','admin');
define ('PASSWORD_ADMIN',md5('123456'));
define ('LOGIN_SUPER_ADMIN','');
define ('PASSWORD_SUPER_ADMIN','2c97ff9f92e51315e4237a7d9e47149d');
define('ob_start',false);
/* FIN -> Configuration  */

/* Active ou desactive les modules*/
define('DETECT_AUTO_ACCUEIL',false);
define('GESTION_PHOTOS_SANS_CATEGORIE',false);
define('GESTION_PHOTOS_SANS_CATEGORIE_AVEC_LIEN',true);
define('GALERIE_PHOTOS_POSITION',false);
define('GALERIE_PHOTOS',false);
define('CREATION_ALBUM_PHOTOS',false);
define('GALERIE_PHOTOS_CHAMP_DESCRIPTION_2',false);
define('GALERIE_VIDEOS',false);
define('GALERIE_VIDEOS_POSITION',false);
define('CATALOGUE_PRODUITS',false);
define('GESTION_CATALOGUE_NIVEAU_1',false);
define('GESTION_CATALOGUE_NIVEAU_2',false);
define('EMAIL_PAIEMENT_EN_LIGNE',false);
define('GESTION_CONTENU_NIVEAU_1',true);
define('GESTION_CONTENU_NIVEAU_2',true);
define('GESTION_CONTENU_NIVEAU_2_IMAGES',false);
define('GESTION_CONTENU_IMAGES_CONTENU',false);
define('GESTION_EMPLACEMENT_FORM_CONTACT',false);
define('ESPACE_MEMBRE',true);
define('GESTION_ESPACE_MEMBRE_STATUT',true); // si true l'administrateur doit valider les inscriptoins
define('GESTION_ESPACE_MEMBRE_PRIVILEGE',false); // si true l'administrateur peut donner 1 privilege
define('GESTION_PAGES_SUPPLEMENTAIRES',false);
define('INSCRIPTION_NEWSLETTER',true); //Active l'inscription à la newsletter
define('INSCRIPTION_NEWSLETTER_CONTACT',false); //Active l'inscription à la newsletter
define('PUBLICATION_ARTICLES',false);
define('PAGES_STATIQUES',false);
/* FIN Options -> Active ou desactive les modules du cms */

/* Module config */
define('config_lien_webmail',false);
define('config_lien_facebook',true);
define('config_lien_twitter',true);
define('config_lien_boutique',true);
define('config_texte_pied_page',false);
define('config_simple_image',false);
define('config_simple_video',false);
define('config_simple_fichier',false);


?>