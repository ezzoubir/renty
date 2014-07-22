<?php
  // on teste si session ouverte
  if(isset($_SESSION['id_membre']))
  {
        // on affiche la page d'accueil conncecté
        $statut_connecte=1;
  }
  else
  {
      // on affiche la page d'accueil non conncecté
      $statut_connecte=0;
  }
  
  if(!isset($_GET['mes_articles']) && !isset($_GET['page_perso'])&& !isset($_GET['archives']))
  {
  $sql='select * from '.PREFIXE_BDD.'membres_accueil where language="'.$language.'" and statut_connecte="'.$statut_connecte.'"';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)==1)
  {
      $row=mysql_fetch_array($res);
      define('TXT_ACCUEIL_MEMBRE',stripslashes($row['texte']));
  }
  else define('TXT_ACCUEIL_MEMBRE','');
  }
  else
  {
      define('TXT_ACCUEIL_MEMBRE','');
      
  }
?>

<?php
  if(isset($_SESSION['id_membre']))
  //le membre est connecté affichage de son menu
    include 'includes/modules/espace_membres/header_connected.php';
  
  
  
  // on affiche la page
  if(!isset($_GET['mot_de_passe_oublie']) && !isset($_GET['inscription']) && !isset($_GET['mes_infos']))
  echo TXT_ACCUEIL_MEMBRE;
?>

<?php
  
  if(!isset($_SESSION['id_membre']))
  {
      if(isset($_GET['mot_de_passe_oublie']))
      {
      include 'includes/modules/espace_membres/mot_de_passe_oublie.php';  
      }
      else
      if(isset($_GET['inscription']))
        include 'includes/modules/espace_membres/inscription.php';
      else
        include 'includes/modules/espace_membres/login.php';
      
      
  }
  //if(isset($_GET['mes_articles']))
  //include 'includes/modules/articles/list_article.php';
  
  if(isset($_GET['page_perso']) && isset($_SESSION['id_membre']))
  {
      include 'includes/modules/espace_membres/page_perso.php';
  }
  
  if(isset($_GET['mes_infos']))
  {
      include 'includes/modules/espace_membres/mes_infos.php';
  }
  
  /*if(isset($_GET['archives']))
  {
      include 'includes/modules/articles/list_article.php';
  }
  */
?>