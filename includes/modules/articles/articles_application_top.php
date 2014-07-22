<?php
  if(isset($_GET['supprimer_article']))
  {
      // on verfit que l'utilisateur à les droits
      $sql='select * from '.PREFIXE_BDD.'articles where id_article="'.(int)$_GET['supprimer_article'].'"';
      $res=mysql_query($sql);
      if(mysql_num_rows($res)==1)
      {
          $row=mysql_fetch_array($res);
          if($row['id_utilisateur']==$_SESSION['id_membre'])
          {
          // on verifi id_utilisateur
              //Autorisation de supprimer
              $sql='delete from  '.PREFIXE_BDD.'articles where id_article="'.(int)$_GET['supprimer_article'].'"';
              mysql_query($sql);
              // construction de l'url de redirection
              if(isset($_GET['page']) && $_GET['page']!='')
              {
              $url='index.php?language='.$language.'&page='.(int)$_GET['page'];
              if(isset($_GET['spage']))
               $url.='&spage='.(int)$_GET['spage'];
              }
              else
              {
                  // c'est un membre retour à la liste de ses article
                  $url='index.php?language='.$language.'&page&espace_membre&mes_articles';
              }
              
              header('LOCATION:'.$url);
          }
      }
  
  }
  if(isset($_GET['lecture_article']))
  {
  
    $sql='select * from '.PREFIXE_BDD.'metatags where language="'.$_GET['language'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res); 
  define('META_',$row['titre']);

        // on recupere id_article
  $id_article=(int)$_GET['lecture_article'];
  $sql='select * from '.PREFIXE_BDD.'articles where id_article="'. $id_article.'"';
  $res=mysql_query($sql);
  $row_article=mysql_fetch_array($res);
  $header_article_facebook='';
  /*$header='
  <html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  ';    */
  
  $declaration_entete_html=' xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml" ';

  if($row_article['image']!='')
  $header_article_facebook.='<meta property="og:image" content="'.BASE_URL.RepPhoto.$row_article['image'].'"/>';

  include 'class/class.html2text.inc.php';
  $h2t =& new html2text(stripslashes($row_article['texte']));
  $row_article['texte'] = $h2t->get_text();
  $h2t =& new html2text(stripslashes($row_article['texte_suite']));
  $row_article['texte_suite'] = $h2t->get_text();

  $header_article_facebook.="
  <meta property='og:title' content='".stripslashes($row_article['titre'])."' />
  <meta property='og:description' content='".stripslashes($row_article['texte'].$row_article['texte_suite'])."' />
  <meta property='og:type' content='article'/>
  <meta property='og:url' content='"."http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."'/>
  <meta property='og:site_name' content='".stripslashes(META_)."' />




";

// on cherche dans les articles si videos



/*$header_article_facebook='
<meta property="og:video" content="http://www.youtube.com/v/QVavrZoVHmU" />
        <meta property="og:video:height" content="365" />
        <meta property="og:video:width" content="365" />
        <meta property="og:video:type" content="application/x-shockwave-flash" />';

*/


  }
?>