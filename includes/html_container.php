<?php



  if(isset($_GET['id_categorie']))
  {
      // on recupere text
      $sql='select * from '.PREFIXE_BDD.'catalogue_categories where id_page="'.(int)$_GET['id_categorie'].'"';
      $res=mysql_query($sql);
      $ro=mysql_fetch_array($res);
  
  
  // on teste si sous categorie
  if(isset($_GET['scat']))
  {
      $sql='select * from '.PREFIXE_BDD.'catalogue_categories where id_page="'.(int)$_GET['scat'].'"';
      $res_=mysql_query($sql);
      $ro_=mysql_fetch_array($res_);
      
      $TXT_TITRE=stripslashes($ro['titre'].' > '.$ro_['titre']);
      define('TXT1','');
      
  }
  else
  {
      $TXT_TITRE=stripslashes($ro['titre']);
      define('TXT1',stripslashes(''));
  }
  
  if(isset($_GET['id_produit_detail']))
  {
  // on recuper le titre du produit
  $sql='select * from '.PREFIXE_BDD.'catalogue_produits where id_produit="'.(int)$_GET['id_produit_detail'].'"';
  $res=mysql_query($sql);
  $roo=mysql_fetch_array($res);
  
  $TXT_TITRE=$TXT_TITRE.' > '.$roo['titre'];
  }
  if(isset($TXT_TITRE))
   define('TXT_TITRE',$TXT_TITRE);
  
  }
else
if(isset($id_categorie))
{
      // on recupere text
      $sql='select * from '.PREFIXE_BDD.'catalogue_categories where id_page="'.$id_categorie.'"';
      $res=mysql_query($sql);
      $ro=mysql_fetch_array($res);
      define('TXT_TITRE',stripslashes($ro['titre']));
      define('TXT1',stripslashes($ro['texte']));
}
else  if(isset($_GET['lecture_article']))
  {
      if(isset($_GET['spage']))
      {
        // on recupere les textes
        define('TXT_TITRE',getPageTitre((int)$_GET['spage']));
      }
      else
      if(isset($_GET['page']))
      {
        // on recupere les textes
        define('TXT_TITRE',getPageTitre((int)$_GET['page']));
      }
      define('TXT1',''); 
      
  
  }
  else if(isset($_GET['desinscription_newsletter']))
  {
      define('TXT_TITRE',NEWSLETTER_JE_SOUHAITE_ME_DESINSCRIRE);
      define('TXT1','');
  }
  else if(isset($_GET['action']))
  {
  
   define('TXT_TITRE',getPageStaticTitre((int)$_GET['action']));
    define('TXT1',getPageStaticText((int)$_GET['action']));
    if($_GET['action']==4 || $_GET['action']==5)
    $Module_FormulaireDeContact=true;
  }
  else
  if(isset($_GET['espace_membre']) && ESPACE_MEMBRE)
  {
    define('TXT_TITRE',MENU_ESPACE_MEMBRE);
    define('TXT1',''); 
  }
  else
  if(isset($_GET['page_sup']))
  {
    define('TXT_TITRE',getPageSuppTitre((int)$_GET['page_sup']));
    define('TXT1',getPageSuppText((int)$_GET['page_sup']));
   
  }
  else
  if(isset($_GET['spage']))
  {
  // on recupere les textes
    define('TXT_TITRE',getPageTitre((int)$_GET['spage']));
    define('TXT1',getPageText((int)$_GET['spage']));
    $id_page=(int)$_GET['spage'];
  }

  else
  if(isset($_GET['page']))
  {
    // on recupere les textes
    define('TXT_TITRE',getPageTitre((int)$_GET['page']));
    define('TXT1',getPageText((int)$_GET['page']));
    
    $id_page=(int)$_GET['page'];
  }

  else
  {
    define('TXT_TITRE','');
    define('TXT1','');
  }




  ?>
<div class="" style="margin-left:23px;margin-right:40px;" <?php if($language=="ar") echo 'dir="RTL" '; ?>>
      <?php

				echo '<h2><span>'. TXT_TITRE.'</span></h2>'; 

	  ?> 
</div>

  <div class="main" style="margin: 10px 20px 0;" <?php if($language=="ar") echo 'dir="RTL" '; ?>>
  <?php
  
  if(isset($_GET['spage']) && $_GET['spage']!='')
  {
        // on teste si des images
        $sql='select * from '.PREFIXE_BDD.'pages_photos where id_page="'.(int)$_GET['spage'].'" order by id_photo';
        $res_photos=mysql_query($sql);
        $nbr_photos=mysql_num_rows($res_photos);
  
  }
  if(isset($nbr_photos) && $nbr_photos>0)
  {
    ?>
       <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
       <tr> 
        <td valign="top" width="450" class="main">
        
        
    <?php
  }
  
    if(!isset($_GET['rediger_article']))
    {
    echo TXT1; 
    }
    if($Module_FormulaireDeContact) 
    {
        // affichage du formulaire de contact
        // voir fichier langues pour traductions
        include 'includes/modules/ContactForm.php';
    }
    if(isset($_GET['demande-de-devis']))
    {
        // affichage du formulaire de contact
        // voir fichier langues pour traductions
        //include 'includes/modules/ContactFormDevis.php';
    }
    if (isset($rappel_immediat) && $rappel_immediat)
	{
	  include 'includes/modules/candidature.php';
	}
	   if (isset($client) && $client)
	{
	  include 'includes/modules/client.php';
	}
    if(isset($Module_galerie_photos) && $Module_galerie_photos)
    {
        include 'includes/modules/photos/galerie_photos.php';
    }
    if(isset($Module_galerie_videos) && $Module_galerie_videos)
    {
    include 'includes/modules/photos/galerie_videos.php';
    }
    if(isset($Module_don_en_ligne) && $Module_don_en_ligne)
    {
        switch($language)
        {
          case 'fr':
          $id_=1;
          break;
          case 'en':
          $id_=2;
          break;
          case 'al':
          $id_=3;
          break;
          case 'es':
          $id_=4;
          break;
          case 'ar':
          $id_=5;
          break;
          case 'tr':
          $id_=6;
          break;
          
        }
        echo getPageStaticText($id_);
        unset($id_);
    }
    if(isset($_GET['don']) || (isset($Module_don_en_ligne) && $Module_don_en_ligne ))
    {
        // inclusion du module de don
        include 'includes/modules/paiement/page_faire_don.php';
    }
    
    if(isset($_GET['espace_membre']) && ESPACE_MEMBRE)
    {
        include 'includes/modules/espace_membres/home.php';
    }

    if(isset($_GET['lecture_article']))
      include 'includes/modules/articles/lire_article.php';
    else if(!isset($_GET['rediger_article']))
      include 'includes/modules/articles/list_article.php';
    
    if(isset($_GET['rediger_article']))
      include 'includes/modules/articles/rediger_article.php';
    
    if(isset($_GET['desinscription_newsletter']))
    {
      include 'includes/modules/newsletter/desinscription.php';
    }
    
    if(isset($_GET['reservation']))
    {
        include 'includes/modules/reservations.php';
    }
      if(isset($_GET['blog']))
  {
      include 'includes/blog.php';
  }
  
  if(isset($_GET['BLOG']) && !isset($_GET['id_produit_detail']))
  {
      include 'includes/BLOG.php';
  }
  if(isset($_GET['id_produit_detail']))
  {
      include 'includes/details_produit.php';
  }
  
  
  
 // if(isset($_GET['contact']) || isset($_GET['nous-contacter']))
    //include 'includes/modules/ContactForm.php';
    
   if(isset($_GET['devis-personalise'])) 
   include 'includes/modules/ContactFormDevis.php';
    
    
  ?>
  
</div>
