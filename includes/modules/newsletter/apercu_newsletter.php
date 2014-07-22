<?php
  include '../../config.php';
  $link =@mysql_connect(SQL_SVR,SQL_LOGIN,SQL_PASS); 
  @mysql_select_db(SQL_DATABASE);
  mysql_query("SET CHARACTER SET 'utf8';", $link)or die(mysql_error());
  mysql_query("SET NAMES 'UTF8' ");
 
 // on recupere la newsletter
 $sql='select * from '.PREFIXE_BDD.'newsletter_archive where id_newsletter="'.(int)$_GET['id_newsletter'].'"';
 $res=mysql_query($sql);
 $row=mysql_fetch_array($res);
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo BASE_URL; ?>" />
<title><?php echo stripslashes($row['objet']); ?></title>
</head>
<body  <?php if($row['language']=='ar') echo 'dir="rtl"'; ?>>

<?php
  echo stripslashes(str_replace('../images/pages/',BASE_URL.'images/pages/',$row['texte']));
?>





</body>
</html>
