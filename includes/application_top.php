<?php
  session_start();
  require 'includes/config.php';
  //if(ob_start)
    //ob_start("ob_gzhandler");   
  if(!isset($_GET['language']))
  {
    header('LOCATION:'.BASE_URL);
  }
  
  $link =@mysql_connect(SQL_SVR,SQL_LOGIN,SQL_PASS); 
  @mysql_select_db(SQL_DATABASE);
  mysql_query("SET CHARACTER SET 'utf8';", $link)or die(mysql_error());
  mysql_query("SET NAMES 'UTF8' ");
  
  
  // on recupere toutes les langues repertorié dans la base !
  $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
  $res=mysql_query($sql);
  $find_language=false;
  while($row=mysql_fetch_array($res))
  {
      if($_GET['language']==$row['symbol'])
      {
          $language=$row['symbol'];
          include 'includes/languages/'.$row['symbol'].'.php';    
          $find_language=true;
      }
  }
  if(!$find_language)
  {
      $language='fr';
      include 'includes/languages/fr.php';
  }

  $_SESSION['language']=$language; // -> information pour les popups 
  
  if(!isset($_GET['page']))
  {
  if($language!='ar')
  {
  // on determine page d'accueil
  $sql='select * from '.PREFIXE_BDD.'pages where language="'.$language.'" and parent_id="0" order by ordre_affichage,id_page ASC limit 1';
  }
  else
  {
  $sql='select * from '.PREFIXE_BDD.'pages where language="'.$language.'" and parent_id="0" order by ordre_affichage DESC,id_page DESC limit 1';
  }
  
  $res_home=mysql_query($sql);
  $row_page=mysql_fetch_array($res_home);
  
  if(DETECT_AUTO_ACCUEIL)
  {
  //echo 'index.php?language='.$language.'&page='.$row_page['id_page'];
  header('LOCATION:'.BASE_URL.'intro.html');

  }
  }
  
  // on recupere les infos contact
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_exp"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('EMAIL_EXP',$row['config_value']);
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_admin1"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('EMAIL_ADMIN',$row['config_value']);
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_admin2"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('EMAIL_ADMIN2',$row['config_value']);
  
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_paiement_en_ligne"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('MAIL_PAYPAL',$row['config_value']);

  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_webmail"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('WEBMAIL_URL',$row['config_value']);
  
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_facebook"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('LIEN_FACEBOOK',$row['config_value']);
 
   $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_twitter"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('LIEN_TWITTER',$row['config_value']);
  
     $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_boutique"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('LIEN_BOUTIQUE',$row['config_value']);
  
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="txt_pied_page"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('TXT_PIED_PAGE',$row['config_value']);

  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_image"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  if($row['config_value']!='')
  DEFINE ('CONFIG_SIMPLE_IMAGE',RepPhoto.$row['config_value']);
  else DEFINE ('CONFIG_SIMPLE_IMAGE','');
  
    $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_fichier"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  if($row['config_value']!='')
  DEFINE ('CONFIG_SIMPLE_FICHIER',RepPhoto.$row['config_value']);
  else DEFINE ('CONFIG_SIMPLE_FICHIER','');
  
  function strip_tags_only($str, $tags) { //balises interditent
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) $str = preg_replace('#</?'.$tag.'[^>]*>#is', '', $str);
    return $str;
}
  
   
    /*  FONCTIONS GLOBALES */
  function getPageTitre($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
  
        return stripslashes($row['titre']);
  }
  
  function getPageText($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
        //images n'a pas le bon repertoire
        
        $row['texte']=str_replace('../images/pages/','images/pages/',$row['texte']);
        return stripslashes($row['texte']);

  }

 function getPageSuppTitre($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages_supplementaires where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
  
        return stripslashes($row['titre']);
  }
  
  function getPageSuppText($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages_supplementaires where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
        //images n'a pas le bon repertoire
        
        $row['texte']=str_replace('../images/pages/','images/pages/',$row['texte']);
        return stripslashes($row['texte']);

  }  
  function getPageStaticTitre($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages_statiques  where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
  
  
        return stripslashes($row['titre']);
  }
  
  function getPageStaticText($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages_statiques  where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
        //images n'a pas le bon repertoire
        
        $row['texte']=str_replace('../images/pages/','images/pages/',$row['texte']);
        return stripslashes($row['texte']);

  }  
  
  function TestEmail($email)
  {
      $struct='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#';
      if(preg_match($struct,$email))
          return true;
      else 
          return false;
  }
  
  function ConvertDateToFr($DateUS)
  {
     $array=explode("-",$DateUS);
     $NewDate=$array[2].'/'.$array[1].'/'.$array[0];
      return $NewDate;
  }
  
  /*  /FONCTIONS GLOBALES */
  
  /* MODULES */
  /**********************************************************/
   if(isset($_GET['spage']))
  {
  // -1 Formulaire de contact
      // on teste si formulaire de contact est sur cette page
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['spage'].'" and id_module=1';
      $res=mysql_query($sql);
      $Module_FormulaireDeContact=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_FormulaireDeContact=true;  
      }
       //galerie photos
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['spage'].'" and id_module=2';
      $res=mysql_query($sql);
      $Module_galerie_photos=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_galerie_photos=true;
        
      }
      
      //galerie videos
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['spage'].'" and id_module=3';
      $res=mysql_query($sql);
      $Module_galerie_videos=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_galerie_videos=true;
        
      }
      
      //dons en ligne
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['spage'].'" and id_module=4';
      $res=mysql_query($sql);
      $Module_don_en_ligne=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_don_en_ligne=true;
        
      }
       
  }
  else
  if(isset($_GET['page']))
  {
      // -1 Formulaire de contact
      // on teste si formulaire de contact est sur cette page
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['page'].'" and id_module=1';
      $res=mysql_query($sql);
      $Module_FormulaireDeContact=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_FormulaireDeContact=true;  
      }
      //galerie photos
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['page'].'" and id_module=2';
      $res=mysql_query($sql);
      $Module_galerie_photos=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_galerie_photos=true;  
      }
      //galerie videos
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['page'].'" and id_module=3';
      $res=mysql_query($sql);
      $Module_galerie_videos=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_galerie_videos=true;  
      }
      
      //dons en ligne
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['page'].'" and id_module=4';
      $res=mysql_query($sql);
      $Module_don_en_ligne=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_don_en_ligne=true;
            
      }
	  
	    $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['page'].'" and id_module=5';
      $res=mysql_query($sql);
      $module_pro=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $module_pro=true;
            
      }
  }

   
  if(isset($_GET['page_sup']))
  {   
      // -1 Formulaire de contact
      // on teste si formulaire de contact est sur cette page
      $sql='select * from '.PREFIXE_BDD.'module_to_page_sup where id_page="'.(int)$_GET['page_sup'].'" and id_module=1';
      $res=mysql_query($sql);
      $Module_FormulaireDeContact=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_FormulaireDeContact=true;  
      }
      //galerie photos
      $sql='select * from '.PREFIXE_BDD.'module_to_page_sup where id_page="'.(int)$_GET['page_sup'].'" and id_module=2';
      $res=mysql_query($sql);
      $Module_galerie_photos=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_galerie_photos=true;  
      }
      //galerie videos
      $sql='select * from '.PREFIXE_BDD.'module_to_page_sup where id_page="'.(int)$_GET['page_sup'].'" and id_module=3';
      $res=mysql_query($sql);
      $Module_galerie_videos=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_galerie_videos=true;  
      }
      
	    //dons en ligne
      $sql='select * from '.PREFIXE_BDD.'module_to_page where id_page="'.(int)$_GET['page'].'" and id_module=4';
      $res=mysql_query($sql);
      $Module_don_en_ligne=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
          $Module_don_en_ligne=true;
            
      }
      //Rappel immédiat
      $sql='select * from '.PREFIXE_BDD.'module_to_page_sup where id_page="'.(int)$_GET['page_sup'].'" and id_module=5';
      $res=mysql_query($sql);
      $rappel_immediat=false;
      if(mysql_num_rows($res)==1)
      {
          // on affiche le formulaire de contact
        $rappel_immediat=true;

	
            
      }

  }
 
  if(isset($_POST['RESERVATION_FORM_ENVOYER']))
  {
    // formulaire de contact traitement
        include 'class/phpmailer.class.inc.php';
        
        if($language!='ar')
          $message='<div>';
        else
        $message='<div dir="rtl">';
        /*$message.=$_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM'].'<br /><br />
                 '.FORM_ADRESSE. ' : '.$_POST['FORM_ADRESSE'].'<br />
                 '.FORM_CP. ' : '.$_POST['FORM_CP'].'<br />
                 '.FORM_VILLE. ' : '.$_POST['FORM_VILLE'].'<br />
                 '.FORM_PAYS. ' : '.$_POST['FORM_PAYS'].'<br />
                 '.FORM_EMAIL. ' : '.$_POST['FORM_EMAIL'].'<br />
                 '.FORM_MESSAGE. ' : '.$_POST['FORM_MESSAGE'].'<br />';
        $message.='</div>';*/
        $message.=$_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM'].'<br /><br />
                
                 '.FORM_EMAIL. ' : '.$_POST['FORM_EMAIL'].'<br />
                 Tel  : '.$_POST['FORM_TEL'].'<br />
                 Nombre de personnes  : '.$_POST['FORM_NBR'].'<br />
                 Date  : '.$_POST['FORM_DATE'].'<br />
                 Heure  : '.$_POST['FORM_HEURE'].'<br />
                 '.FORM_MESSAGE. ' : '.$_POST['FORM_MESSAGE'].'<br />';
        $message.='</div>';
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes($_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM']);
        $mail->Subject=stripslashes('[CONTACT]['.$language.']['.BASE_URL.']');
        $mail->AddReplyTo($_POST['FORM_EMAIL']);//$EmailExp
        $mail->AddAddress(EMAIL_ADMIN);
        if(EMAIL_ADMIN2!='')
          $mail->AddAddress(EMAIL_ADMIN2);
        $mail->Body=stripslashes($message);
        $mail->Send();
        
         header('LOCATION:'.$_POST['URL_SRC'].'');
  
  
  }
  if(isset($_POST['CONTACT_FORM_ENVOYER']))
  {
      // formulaire de contact traitement
        include 'class/phpmailer.class.inc.php';
        
        if($language!='ar')
          $message='<div>';
        else
        $message='<div dir="rtl">';
        $message.=$_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM'].'<br /><br />
         Société : '.$_POST['FORM_COMPANY'].'<br />
         Téléphone : '.$_POST['FORM_TEL'].'<br />
                 '.FORM_ADRESSE. ' : '.$_POST['FORM_ADRESSE'].'<br />
                 '.FORM_CP. ' : '.$_POST['FORM_CP'].'<br />
                 '.FORM_VILLE. ' : '.$_POST['FORM_VILLE'].'<br />
                 
                 '.FORM_EMAIL. ' : '.$_POST['FORM_EMAIL'].'<br />
                 '.FORM_MESSAGE. ' : '.$_POST['FORM_MESSAGE'].'<br />';
        $message.='</div>';
        
        
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes($_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM']);
        
        
        $mail->Subject=stripslashes('[Message de :]['.$_POST['FORM_PRENOM'].']');
        
        $mail->AddReplyTo($_POST['FORM_EMAIL']);//$EmailExp
        $mail->AddAddress(EMAIL_ADMIN);
        if(EMAIL_ADMIN2!='')
          $mail->AddAddress(EMAIL_ADMIN2);
        $mail->Body=stripslashes($message);
        $mail->Send();
       
        
        
        //unset($message);
        
        //echo EMAIL_ADMIN.'<br />'.$message;
        header('LOCATION:'.$_POST['URL_SRC'].'');
      
  }
    if(isset($_POST['CLIENT_FORM_ENVOYER']))
  {
      // formulaire de contact traitement
        include 'class/phpmailer.class.inc.php';
        
        if($language!='ar')
          $message='<div>';
        else
        $message='<div dir="rtl">';
    if(@copy($_FILES['pj']['tmp_name'], 'repertoire/'.$_FILES['pj']['name']))
     {
    
	 $pj='	 Pièce joite  : <br />  				 
                 <img src="http://www.recnovit.fr/pj/'.$_FILES['pj']['name'].'"/>		<br />';
		 }else $pj='';
               
		
        $message.=$_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM'].'<br /><br />
         Société : '.$_POST['societe'].'<br />
         Téléphone : '.$_POST['FORM_TEL'].'<br />
                Descriptif du poste : '.$_POST['FORM_CP'].'<br />
                Fonction: '.$_POST['fonction'].'<br />
                Statut: '.$_POST['statut'].'<br />
                TJM/Rémunération: '.$_POST['TJM'].'<br />
                 '.FORM_EMAIL. ' : '.$_POST['FORM_EMAIL'].'<br />
				 '.$pj.'   
                 '.FORM_MESSAGE. ' : '.$_POST['FORM_MESSAGE'].'<br />';
        $message.='</div>';
        
        
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes($_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM']);
        
        if(isset($_GET['demande-de-devis']))
        $mail->Subject=stripslashes('[DEMANDE DE DEVIS]['.$language.']['.BASE_URL.']');
        else
        $mail->Subject=stripslashes('[CONTACT]['.$language.']['.BASE_URL.']');
        
        $mail->AddReplyTo($_POST['FORM_EMAIL']);//$EmailExp
        $mail->AddAddress(EMAIL_ADMIN);
        if(EMAIL_ADMIN2!='')
          $mail->AddAddress(EMAIL_ADMIN2);
        $mail->Body=stripslashes($message);
        $mail->Send();
        if(INSCRIPTION_NEWSLETTER_CONTACT)
        {
              // on teste si mail 
              $sql='select * from '.PREFIXE_BDD.'newsletter_emails where email="'.$_POST['FORM_EMAIL'].'"';
              $res=mysql_query($sql);
              if(mysql_num_rows($res)==0)
              {
                  // inscription
                  $sql='insert into '.PREFIXE_BDD.'newsletter_emails (email,language) values("'.$language.'","'.$_POST['FORM_EMAIL'].'")';
                  mysql_query($sql);
              }
        
        }
        
        
        //unset($message);
        
        //echo EMAIL_ADMIN.'<br />'.$message;
        header('LOCATION:'.$_POST['URL_SRC'].'');
      
  }
  
      if(isset($_POST['CANDIDAT_FORM_ENVOYER']))
  {
      // formulaire de contact traitement
        include 'class/phpmailer.class.inc.php';
        
        if($language!='ar')
          $message='<div>';
        else
        $message='<div dir="rtl">';
    if(@copy($_FILES['pj']['tmp_name'], 'pj/'.$_FILES['pj']['name']))
     {    
	 
	 $pj='Pièce joite  : <br />  				 
                 <img src="http://www.recnovit.fr/pj/'.$_FILES['pj']['name'].'"/>		<br />';
		 }else $pj='';
               
		
        $message.=$_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM'].'<br /><br />
         Code postal : '.$_POST['FORM_CP'].'<br />
                Statut: '.$_POST['statut'].'<br />
                Poste recherché : '.$_POST['post'].'<br />
                Technologies maitrisées : '.$_POST['techno'].'<br />
                TJM/Rémunération: '.$_POST['TJM'].'<br />
                Mobilité : '.$_POST['mobilite'].'<br />
                 '.FORM_EMAIL. ' : '.$_POST['FORM_EMAIL'].'<br />
				 '.$pj.'   
                 Commantaire  : '.$_POST['FORM_MESSAGE'].'<br />';
        $message.='</div>';
        
        
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes($_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM']);
        
        if(isset($_GET['demande-de-devis']))
        $mail->Subject=stripslashes('[DEMANDE DE DEVIS]['.$language.']['.BASE_URL.']');
        else
        $mail->Subject=stripslashes('[CONTACT]['.$language.']['.BASE_URL.']');
        
        $mail->AddReplyTo($_POST['FORM_EMAIL']);//$EmailExp
        $mail->AddAddress(EMAIL_ADMIN);
        if(EMAIL_ADMIN2!='')
          $mail->AddAddress(EMAIL_ADMIN2);
        $mail->Body=stripslashes($message);
        $mail->Send();
        if(INSCRIPTION_NEWSLETTER_CONTACT)
        {
              // on teste si mail 
              $sql='select * from '.PREFIXE_BDD.'newsletter_emails where email="'.$_POST['FORM_EMAIL'].'"';
              $res=mysql_query($sql);
              if(mysql_num_rows($res)==0)
              {
                  // inscription
                  $sql='insert into '.PREFIXE_BDD.'newsletter_emails (email,language) values("'.$language.'","'.$_POST['FORM_EMAIL'].'")';
                  mysql_query($sql);
              }
        
        }
        
        
        //unset($message);
        
        //echo EMAIL_ADMIN.'<br />'.$message;
        header('LOCATION:'.$_POST['URL_SRC'].'');
      
  }
  
  if(isset($_POST['CONTACTDEVIS_FORM_ENVOYER']))
  {
      // formulaire de contact traitement
        include 'class/phpmailer.class.inc.php';
        
        if($language!='ar')
          $message='<div>';
        else
        $message='<div dir="rtl">';
        $message.=$_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM'].'<br /><br />
                 
                 '.FORM_ADRESSE. ' : '.$_POST['FORM_ADRESSE'].'<br />
                 '.FORM_CP. ' : '.$_POST['FORM_CP'].'<br />
                 '.FORM_VILLE. ' : '.$_POST['FORM_VILLE'].'<br />
                  Téléphone : '.$_POST['FORM_TEL'].'<br />
                 '.FORM_EMAIL. ' : '.$_POST['FORM_EMAIL'].'<br />
                 Service demandé : '.$_POST['FORM_SERVICE'].'<br />
                 Détail de la demande : '.$_POST['FORM_MESSAGE'].'<br />';
        $message.='</div>';
        
        $message.='</div>';
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes($_POST['FORM_PRENOM'].' '.$_POST['FORM_NOM']);
        $mail->Subject=stripslashes('[DEMANDE DE DEVIS]['.$language.']['.BASE_URL.']');
        $mail->AddReplyTo($_POST['FORM_EMAIL']);//$EmailExp
        $mail->AddAddress(EMAIL_ADMIN);
        if(EMAIL_ADMIN2!='')
          $mail->AddAddress(EMAIL_ADMIN2);
        $mail->Body=stripslashes($message);
        $mail->Send();
        
        
        //unset($message);
        
        //echo EMAIL_ADMIN.'<br />'.$message;
        header('LOCATION:'.$_POST['URL_SRC'].'');
      
  }  
  
  /*  */
  /**********************************************************/
  if(ESPACE_MEMBRE)
  {
    include 'includes/modules/espace_membres/espace_membres_application_top.php';
  }
  
  if(INSCRIPTION_NEWSLETTER)
  {
    include 'includes/modules/newsletter/newsletter_appilcation_top.php';
  }
  if(PUBLICATION_ARTICLES)
  {
   include 'includes/modules/articles/articles_application_top.php';
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  if(isset($_POST['acheter_pass']))
  {
        // fo recuperer tous les id_pack !!!
        
        // on teste si pas deja enregistré
        //recherche nom pack
      /*  $sql='select * from cms_v2_catalogue_commandes where id_pack="'.$_POST['id_pack'].'" and email="'.$_POST['FORM_EMAIL'].'"';
        $res=mysql_query($sql);
        if(mysql_num_rows($res)==0)
        {
            // insertion informations globales
            $sql='insert into cms_v2_catalogue_commandes (nom_pack,nom,prenom,email,nbr_produits,prix_unitaire,stotal,frais_paypal,total,id_pack,language) 
                values 
                ("'.addslashes($_POST['nom_pack']).'","'.addslashes($_POST['FORM_NOM']).'","'.addslashes($_POST['FORM_PRENOM']).'","'.addslashes($_POST['FORM_EMAIL']).'",
                "'.$_POST['quantite'].'","'.$_POST['prix_unitaire'].'","'.$_POST['soustotal'].'","'.$_POST['frais_paypal'].'","'.$_POST['total'].'"
                ,"'.$_POST['id_pack'].'","'.$language.'")';
        
        //echo $sql;
            $res=mysql_query($sql);
            $id_commande=mysql_insert_id();
            $z=0;
            while(isset($_POST['FORM_NOM'.$z]))
            {
                $sql='insert into cms_v2_catalogue_commandes_amis (nom,prenom,id_commande) values("'.$_POST['FORM_NOM'.$z].'","'.$_POST['FORM_PRENOM'.$z].'","'.$id_commande.'")';
                mysql_query($sql);
                $z++;
            }
            
            // on peut afficher le bouton paypal
           
  require_once('class/paypal.class.php');  // include the class file
  $p = new paypal_class;             // initiate an instance of the class
  $p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
  $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  //echo $this_script;
  if (empty($_GET['action_'])) $_GET['action_'] = 'process';  
  
  global $language; 
  switch ($_GET['action_']) {
      case 'process':
		  $p->add_field('business', MAIL_PAYPAL);
		  $p->add_field('item_name',$_POST['quantite'].' '.$_POST['nom_pack']); 
		  $p->add_field('last_name', $_POST['FORM_NOM']);  
		  $p->add_field('first_name', $_POST['FORM_PRENOM']); 
		  $p->add_field('email', $_POST['FORM_EMAIL']);
		  $p->add_field('amount',$_POST['total']);
		  $p->add_field('currency_code', 'EUR');
		  $p->add_field('return', BASE_URL.$language.'/paiement-accepte.html');
		  $p->add_field('cancel_return', BASE_URL.$language.'/paiement-erreur.html');
		  $p->submit_paypal_post();
      break;
  
      
  
  }
           
            
            //$req="submit=true&cmd=test";

          






            
            
        }
        else
        {
            // ce pack a deja été commande !!!!
            $erreur_achat='<div style="margin-top:15px;margin-bottom:15px;font-weight:bold">'.DEJA_COMMANDER_PACK.'</div>';
        }*/ 
        
       //insertion commande 
       // on teste si pas deja enregistré
        //recherche nom pack ->id_pack=id_produit
       $sql='select * from cms_v2_catalogue_commandes where id_pack="'.(int)$_GET['prevente'].'" and email="'.$_POST['FORM_EMAIL'].'"';
        $res=mysql_query($sql);
        if(mysql_num_rows($res)==0)
        {
            // on recupere nom produit
            $sql='select titre from cms_v2_catalogue_produits where id_produit="'.(int)$_GET['prevente'].'"';
            $res=mysql_query($sql);
            $ro=mysql_fetch_array($res);
        
        $nom_produit=$ro['titre'];
        
         $sql='insert into cms_v2_catalogue_commandes (nom_pack,nom,prenom,email,nbr_produits,prix_unitaire,stotal,frais_paypal,total,id_pack,language) 
                values 
                ("'.addslashes($ro['titre']).'","'.addslashes($_POST['FORM_NOM']).'","'.addslashes($_POST['FORM_PRENOM']).'","'.addslashes($_POST['FORM_EMAIL']).'",
                "'.$_POST['quantite'].'","'.$_POST['prix_unitaire'].'","'.$_POST['soustotal'].'","'.$_POST['frais_paypal'].'","'.$_POST['total'].'"
                ,"'.(int)$_GET['prevente'].'","'.$language.'")';
        
        //echo $sql;
            $res=mysql_query($sql);
            $id_commande=mysql_insert_id();
        
        
        
       // on recupere la liste des pack opour ce produit
      $sql='select * from cms_v2_catalogue_produits_packs where id_produit="'.(int)$_POST['id_produit'].'" ';
     // echo $sql;
      $res=mysql_query($sql);
      while($row=mysql_fetch_array($res))
      {
          //  echo $ro['id_pack'].'<br />';
          
          // il faut tester pour chaque pack s'il y a des ventes !!!!!
          // nombre id_pack commandé : quantite_$row['id_pack']; 
          if(isset($_POST['quantite_'.$row['id_pack']]))
          {
                // nombre de id_pack commandé
                if($_POST['quantite_'.$row['id_pack']]>0)
                {
                
                //echo $_POST['quantite_'.$row['id_pack']];
                      // on traite !!
                      // on recvupere les noms et prénoms
                      //FORM_NOM_ echo $row['id_pack']; _'+z+'" name="FORM_NOM_ echo $row['id_pack'];  _'+z+'
                      for($n=1;$n<($_POST['quantite_'.$row['id_pack']]+1);$n++)
                      {
                          
                          
                          if(isset($_POST['FORM_NOM_'.$row['id_pack'].'_'.$n]))
                          {
                            //echo $_POST['FORM_NOM_'.$row['id_pack'].'_'.$n].'<br />';
                            // insertion amis
                            $nom=$_POST['FORM_NOM_'.$row['id_pack'].'_'.$n];
                            $prenom=$_POST['FORM_PRENOM_'.$row['id_pack'].'_'.$n];
                            $sql='insert into cms_v2_catalogue_commandes_amis (nom,prenom,id_commande,id_pack,titre_pack) values("'.addslashes($nom).'","'.addslashes($prenom).'","'.$id_commande.'","'.$row['id_pack'].'","'.addslashes($row['titre']).'")';
                            mysql_query($sql);
                          }
                      }
                }
          
          }
      
      }  
      
       // on peut afficher le bouton paypal
           
  require_once('class/paypal.class.php');  // include the class file
  $p = new paypal_class;             // initiate an instance of the class
  $p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
  $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  //echo $this_script;
  if (empty($_GET['action_'])) $_GET['action_'] = 'process';  
  
  $_SESSION['id_commande_paiement']=$id_commande;
  
  global $language; 
  switch ($_GET['action_']) {
      case 'process':
		  $p->add_field('business', MAIL_PAYPAL);
		  $p->add_field('item_name',$_POST['quantite'].' - pack(s) '.$nom_produit); 
		  $p->add_field('last_name', $_POST['FORM_NOM']);  
		  $p->add_field('first_name', $_POST['FORM_PRENOM']); 
		  $p->add_field('email', $_POST['FORM_EMAIL']);
		  $p->add_field('amount',$_POST['total']);
		  $p->add_field('currency_code', 'EUR');
		  $p->add_field('return', BASE_URL.$language.'/paiement-accepte.html');
		  $p->add_field('cancel_return', BASE_URL.$language.'/paiement-erreur.html');
		  $p->submit_paypal_post();
      break;
  
      
  
  }
      
      
      
      
      
      
      }  
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
?>