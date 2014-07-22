<div style="margin-top:20px;">
<?php
  if(isset($_GET['action']))
  switch ($_GET['action'])
  {
      case 'page_don' :
      include 'modules/module_page_don.php';
      break;
      
      case 'config' :
      include 'modules/module_configuration.php';
      break;
      
      case 'meta-tags':
      include 'modules/module_metatags.php';
      break;
      
      /* module gestion de contenu */
      case 'gestion_contenu':
      include 'modules/gestion_contenu/module_gestion_contenu.php';
      break;  
	  case 'ajouter':
      include 'modules/gestion_contenu/ajouter.php';
      break;
      
      case 'catalogue':
      include 'modules/catalogue/module_gestion_catalogue.php';
      break;
      
      case 'catalogue_pack' :
      include 'modules/catalogue/catalogue_lise_packs.php';
      break;
      
      /* Pour 1 pack */
      case 'catalogue_pack_edit' :
      include 'modules/catalogue/catalogue_pack.php';
      break;
      
      case 'catalogue_produits':
      include 'modules/catalogue/catalogue_produits.php';
      break;
      
      case 'reservations_soiree':
      include 'modules/catalogue/reservations_soiree.php';
      break;
      
       case 'stream_on_tour':
      include 'modules/catalogue/stream_on_tour.php';
      break;
      
      case 'catalogue_add_product':
      include 'modules/catalogue/catalogue_add_produits.php';
      break;
      
      case 'gestion_article_modifier':
      include 'modules/gestion_contenu/articles_modifier.php';
      break;
      
      case 'gestion_article_archive':
      include 'modules/gestion_contenu/articles_archives.php';
      break;
      
      case 'livre_d_or':
      include 'modules/livre_d_or.php';
      break;
  
  
      case 'gestion_contenu_modifier':
      include 'modules/gestion_contenu/module_gestion_contenu_modifier_page.php';
      break;
      /* /module gestion de contenu */
      
      /* Photos */
      case 'photos':
      include 'modules/photos/gestion_photos_sans_categorie.php';
      break;
      
       case 'photos_avec_lien':
      include 'modules/photos/gestion_photos_sans_categorie_avec_lien.php';
      break;
      
      case 'galerie_photos_position':
      include 'modules/photos/galerie_photos_position.php';
      break;
      
      case 'galerie_photos':
      include 'modules/photos/galerie_photos.php';
      break;
      
      case 'galerie_videos_position':
      include 'modules/photos/galerie_videos_position.php';
      break;
      
      case 'galerie_videos':
      include 'modules/photos/galerie_videos.php';
      break;
      /*   */
      
      /* module formulaire de contact */
      case 'form_contact':
      include 'modules/module_form_contact.php';
      break;
  
      case 'pages_statiques':
      include 'modules/gestion_contenu/pages_statiques.php';
      break;
      
      case 'gestion_page_statique_modifier':
      include 'modules/gestion_contenu/pages_statiques_modifier.php';
      break;
      
      /* Module page membre */
      case 'espace_membre':
      include 'modules/espace_membres/module_espace_membres.php';
      break;
      
      case 'edit_espace_membre_accueil_non_connecte':
      include 'modules/espace_membres/edit_espace_membre_accueil.php';
      break;
      
      case 'edit_espace_membre_accueil':
      include 'modules/espace_membres/edit_espace_membre_accueil.php';
      break;
      
      case 'espace_membre_modifier':
      // gestion page perso du membre
      include 'modules/espace_membres/espace_membre_page_perso.php';
      break;
      /* Fin module */
      
      /* module page supplementaires */
      case 'pages_supplementaires':
      include 'modules/pages_supplementaires/module_pages_supplementaires.php';
      break;
      
      case 'pages_supplementaires_modifier':
      include 'modules/pages_supplementaires/module_pages_supplementaires_modifier.php';
      break;
       /* /module page supplementaires */
      
      /* NEwsletter **/
      case 'newsletter_mailing_list':
      include 'modules/newsletter/mailing_list.php';
      break;
      
      case 'newsletter_envoyer':
      include 'modules/newsletter/newsletter_envoyer.php';
      break;
      
      case 'archives_newsletter':
      include 'modules/newsletter/archives.php';
      break;
      /* /NEwsletter **/
	  
	  case 'villes':
      include 'modules/villes/villes.php';
      break;
	  
	  case 'categories':
      include 'modules/categories/categories.php';
      break; 
	  
	  case 'marchands':
      include 'modules/marchands/liste_marchands.php';
      break;
	  
	  case 'modif_marchand':
      include 'modules/marchands/modif_marchand.php';
      break;
	  
	  case 'add_marchand':
      include 'modules/marchands/add_marchand.php';
      break;
	  
	  case 'coupons':
      include 'modules/coupons/liste_coupons.php';
      break;
	  
	  case 'modif_coupon':
      include 'modules/coupons/modif_coupon.php';
      break;
	  
	  case 'add_coupon':
      include 'modules/coupons/add_coupon.php';
      break;
      
  }

?>
</div>