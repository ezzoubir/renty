<?php

if(isset($_POST['save']))
{
    $sql='update '.PREFIXE_BDD.'pages_statiques set texte="'.addslashes($_POST['content']).'" where id_page="'.$_POST['id_page'].'"';
    mysql_query($sql);
}


// on recupere infos articles
  $sql='select * from '.PREFIXE_BDD.'pages_statiques where id_page="'.(int)$_GET['id_page'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  

?>
<h1>Modification de la page "<?php echo stripslashes($row['titre']); ?>"</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<?php
  include '../tiny_mce/header_tiny_mce_admin.php';
?>
<b>Texte</b>
<textarea style="width:100%;height:400px;" name="content"><?php echo stripslashes($row['texte']); ?></textarea>
<input type="submit" name="save" value="Enregistrer">
<input type="hidden" name="id_page" value="<?php echo (int)$_GET['id_page']; ?>">
</form>