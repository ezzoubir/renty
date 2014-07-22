<?php

if(isset($_POST['save']))
{
    // maj du texte 
    $sql='update  '.PREFIXE_BDD.'pages_supplementaires set texte="'.addslashes($_POST['content']).'" where id_page="'.$_POST['id_page'].'"';
    mysql_query($sql);
}


// on recupere le(s) titre(s)
  $sql='select * from '.PREFIXE_BDD.'pages_supplementaires where id_page="'.(int)$_GET['id_page'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  
  $titre_h2=stripslashes($row['titre']);

?>
<h1>Modification</h1>
<h2>Page supplémentaire > <?php echo $titre_h2; ?></h2>
<?php
  include '../tiny_mce/header_tiny_mce_admin.php';
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<textarea style="width:100%;height:400px;" name="content"><?php echo stripslashes($row['texte']); ?></textarea>
<br />
<input type="submit" name="save" value="Enregistrer">
<input type="hidden" name="id_page" value="<?php echo (int)$_GET['id_page']; ?>">
</form>
