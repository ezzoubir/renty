<a href="index.php?action=catalogue_pack&id_produit=<?php echo (int)$_GET['id_produit']; ?>">Retour</a>
<?php
  if(isset($_POST['id_produit']))
  {
      $id_produit=$_POST['id_produit'];
  }
  if(isset($_GET['id_produit']))
  {
      $id_produit=$_GET['id_produit'];
  
  }
  

  if(isset($_GET['id_pack']))
    $id_pack=$_GET['id_pack'];
  
     if(isset($_POST['id_pack']))
  {
      $id_pack=$_POST['id_pack'];
  }
  
  // on teste si pack existe
  $sql='select * from cms_v2_catalogue_produits_packs where id_pack="'.$id_pack.'"';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)==0)
  {
      // insertion du pack
      $sql='insert into cms_v2_catalogue_produits_packs (id_produit) values("'.$id_produit.'")';
      mysql_query($sql);
      $id_pack=mysql_insert_id();
  }
 
 // on recupere nom produit
 $sql='select * from '.PREFIXE_BDD.'catalogue_produits where id_produit="'.$id_produit.'"';
 $r=mysql_query($sql);
 $ro=mysql_fetch_array($r);
 
?>
<h1>Pack pour soirée "<?php echo stripslashes($ro['titre']); ?>"</h1>
<?php


if(isset($_POST['save']) && isset($id_produit))
{
    // maj du texte 
    $sql='update  '.PREFIXE_BDD.'catalogue_produits_packs set taxe="'.(3.5/100).'",prix="'.str_replace(',','.',$_POST['prix']).'", description="'.addslashes($_POST['tiny']).'",titre="'.addslashes($_POST['titre']).'" where id_pack="'.$id_pack.'"';
    mysql_query($sql);
    
    
    
    
}

if(isset($id_pack))
{
  // on recupere infos articles
  $sql='select * from '.PREFIXE_BDD.'catalogue_produits_packs where id_pack="'.$id_pack.'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
}  

?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">

<b>Titre : </b><input type="text" name="titre" value="<?php if(isset($id_pack)) echo stripslashes($row['titre']); ?>"><br /><br />
<b>Tarif : </b><input type="text" name="prix" value="<?php if(isset($id_pack)) echo stripslashes($row['prix']); ?>"> € / unité<br /><br />
<?php
  include '../tiny_mce/header_tiny_mce_admin_exact.php';
?>
<b>Description</b>
<textarea style="width:100%;height:400px;" name="tiny"><?php if(isset($id_pack)) echo stripslashes($row['description']); ?></textarea>
<br />
<br />

<input type="submit" name="save" value="Enregistrer">
<?php
if(isset($id_produit))
{
?>
<input type="hidden" name="id_produit" value="<?php if(isset($id_produit)) echo (int)$id_produit; ?>">
<?php
}
if(isset($id_pack))
{
?>
<input type="hidden" name="id_pack" value="<?php if(isset($id_pack)) echo (int)$id_pack; ?>">
<?php
}
?>
</form><br /><br />
