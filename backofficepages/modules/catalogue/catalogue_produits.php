<?php
  $sql='select titre from '.PREFIXE_BDD.'catalogue_categories where id_page="'. (int)$_GET['id_page'].'"';
  $res=mysql_query($sql);
  $ro=mysql_fetch_array($res);
  if(mysql_num_rows($res)>0)
  {
  
  if(isset($_POST['save']))
{
   $sql='update '.PREFIXE_BDD.'catalogue_produits set ordre_affichage="'.$_POST['ordre'][GetImageButtonValue($_POST['save'])].'" where id_produit="'.GetImageButtonValue($_POST['save']).'"';
  $r = @mysql_query($sql);
}
if(isset($_POST['delete']))
{
   // on recupere le nom du fichier
   $sql='select image from  '.PREFIXE_BDD.'catalogue_produits where id_produit="'.GetImageButtonValue($_POST['delete']).'"';
   $r = @mysql_query($sql);
   $res=mysql_fetch_assoc($r);
   @unlink('../'.RepPhoto.$res['image']);
   @unlink('../'.RepPhoto.'mins/'.$res['image']);

   $sql='delete from  '.PREFIXE_BDD.'catalogue_produits  where id_produit='.GetImageButtonValue($_POST['delete']);
   mysql_query($sql);

   $sql='delete from  '.PREFIXE_BDD.'catalogue_produits_packs where id_produit='.GetImageButtonValue($_POST['delete']);
   mysql_query($sql);
}
  
  
?>
<h1>Produit(s) <?php echo stripslashes($ro['titre']); ?></h1>
<a href="index.php?action=catalogue_add_product&id_page=<?php echo (int)$_GET['id_page']; ?>">Ajouter un produit</a>
  <h2>Liste des produits</h2>

<form name="form2"  action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php
$sql='select * from '.PREFIXE_BDD.'catalogue_produits where id_categorie="'.(int)$_GET['id_page'].'" order by ordre_affichage,id_produit';
$r = @mysql_query($sql);
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
  <th style="text-align:left;">Image</th>
  <th style="text-align:left;">titre </th>
  <th width="150">ordre</th>
  <th width="50"></th>
</tr>
<?php
  while ($res=mysql_fetch_assoc($r))
	{
  ?>
    <tr>
     
      <td style="text-align:left;"><?php if($res['image']!=''){ ?><a href="../<?php echo RepPhoto.$res['image'] ?>" rel="lightbox1"  class="horizontal"  title="" target="blank" style="color:#000;font-weight:normal;"><img src="../<?php echo RepPhoto.'mins/'.$res['image'] ?>" border="0" height="50"></a><?php } ?></td>
      <td style="text-align:left;"><?php echo stripslashes($res['titre']); ?></td>
      <td><input type="text" name="ordre[<?php echo $res['id_produit']; ?>]" value="<?php echo $res['ordre_affichage']; ?>" style="width:30px;"> <input type="image" name="save[<?php echo $res['id_produit']; ?>]" src="imgs/floppy_disk16.gif"></td>
      
    <td>
    <div><a href="index.php?action=catalogue_pack&id_produit=<?php echo $res['id_produit'] ?>" style="">Packs</a></div>
    <a href="index.php?action=catalogue_add_product&id_page=<?php echo (int)$_GET['id_page']; ?>&id_produit=<?php echo $res['id_produit'] ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                 
    <input type="image" name="delete[<?php echo $res['id_produit']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer ?")){this.submit();} else return false;'></td>

    </tr>

  <?php

	}

?>

</table><br />
<?php
}
?>