<?php
if(isset($_POST['delete']))
{
    $id_packs_delete=GetImageButtonValue($_POST['delete']);
    $sql='delete from cms_v2_catalogue_produits_packs where id_pack="'.$id_packs_delete.'"';
    mysql_query($sql);

}


  $sql='select * from cms_v2_catalogue_produits  where id_produit="'.(int)$_GET['id_produit'].'"';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)>0)
  {
  $ro=mysql_fetch_array($res);
?>
<h1>Gestion des packs pour la soirée : <?php echo stripslashes($ro['titre']); ?> </h1>
<?php
  // liste des packs
  $sql='select * from cms_v2_catalogue_produits_packs where id_produit="'.(int)$_GET['id_produit'].'" order by id_pack ';
  $res=mysql_query($sql);

?>
<h2><a href="index.php?action=catalogue_pack_edit&id_produit=<?php echo (int)$_GET['id_produit']; ?>&id_pack">Ajouter un pack</a></h2>
  
<br />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">

<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
  <th style="text-align:left;">titre </th>
  <th width="50">Prix</th>
  <th>Fonction(s)</th>
</tr>
<?php
    while($row=mysql_fetch_array($res))
    {
        ?>
          <tr>
            <td style="text-align:left;"><?php echo stripslashes($row['titre']); ?></td>
            <td><?php echo stripslashes($row['prix']); ?> €</td>
            <td>
          <a href="index.php?action=catalogue_pack_edit&id_produit=<?php echo $row['id_produit'] ?>&id_pack=<?php echo $row['id_pack'] ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
      
           <input type="image" name="delete[<?php echo $row['id_pack']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer ce pack ?")){this.submit();} else return false;'></td>
            
    
            </td>
          </tr>
        <?php
    }
?>
</table>
</form>
<?php
}

?>