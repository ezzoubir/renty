 <?php
 
  include '../../config.php';
 
 $link =@mysql_connect(SQL_SVR,SQL_LOGIN,SQL_PASS); 
  @mysql_select_db(SQL_DATABASE);
  mysql_query("SET CHARACTER SET 'utf8';", $link)or die(mysql_error());
  mysql_query("SET NAMES 'UTF8' ");
  
 
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
  
  
  if($row_article['image']!='')
  $header_article_facebook.='<meta property="og:image" content="'.BASE_URL.RepPhoto.$row_article['image'].'"/>';



 // on recupere meta
  $sql='select * from '.PREFIXE_BDD.'metatags where language="'.$_GET['language'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res); 
  define('META_TITLE',$row['titre']);
  define('META_DESCRIPTION',$row['description']);
  define('META_KEYWORDS',$row['mots']);


?>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title><?php echo META_TITLE; ?></title>
    <meta property="og:title" content="<?php echo stripslashes($row_article['titre']); ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content=""/>
    <?php
      echo $header_article_facebook;
    ?>
    <meta property="og:site_name" content="IMDb"/>
    <meta property="fb:admins" content="<?php echo USER_ID_FACEBOOK; ?>"/>
    <meta property="og:description" content="<?php echo mysql_escape_string($row_article['texte']); ?>" />
  </head>
