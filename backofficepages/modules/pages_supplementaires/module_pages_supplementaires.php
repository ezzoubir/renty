<?php
  if(isset($_POST['add0']))
  {
        //insertion page principal
        $sql='insert into '.PREFIXE_BDD.'pages_supplementaires (titre,language) values("'.$_POST['titre_page'].'","'.$_GET['language'].'")';
        mysql_query($sql);
  }
  if(isset($_POST['delete']))
{
    $id_page=GetImageButtonValue($_POST['delete']);
    
    

    $sql='delete from  '.PREFIXE_BDD.'pages_supplementaires where id_page="'. $id_page.'"';
    mysql_query($sql);
    
}

?>

<h1>Gestion pages supplémentaires</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

<?php
  if(isset($_GET['language']) && $_GET['language']!='null')
  {
?>
<div style="margin-top:15px;margin-bottom:15px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <th></th>
      <th colspan="2" style="text-align:left;">Ajouter une page</th>
    </tr>
    <tr>
      <th width="200">Titre page  <?php echo $_GET['language']; ?></th><td style="text-align:left;"><input type="text" name="titre_page" style="width:300px;"></td>
      <td><input type="image" name="add0[]" src="imgs/Add2.gif" /></td>
    </tr>
  </table>
</div>

<?php

  // on affiche les pages associés
  $sql='select * from '.PREFIXE_BDD.'pages_supplementaires where language="'.$_GET['language'].'"';
  $res_pages=mysql_query($sql);
  ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <th style="text-align:left;">Titre</th>
      <th>lien</th>
      <th>Fonction(s)</th>
    </tr>
    <?php
      while($row_page=mysql_fetch_array($res_pages))
      {
        ?>
      <tr>
            <td style="text-align:left;"><input type="text" name="titre[<?php echo $row_page['id_page']; ?>]" value="<?php echo stripslashes($row_page['titre']); ?>"  style="width:300px;" /></td>
            <td style="">
            <?php
              // construction du lien
              $lien=BASE_URL.'index.php?language='.$_GET['language'].'&page_sup='.$row_page['id_page'].'&page';
              echo '<a href="'.$lien.'" target="_blank">'.$lien.'</a>';
            ?>
            </td>
            <td style="">
            <input type="image" name="save[<?php echo $row_page['id_page']; ?>]" src="imgs/floppy_disk16.gif">
            <a href="index.php?action=pages_supplementaires_modifier&id_page=<?php echo $row_page['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
            <input style="margin-left:10px;" type="image" name="delete[<?php echo $row_page['id_page']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Supprimer <?php echo stripslashes($row_page['titre']); ?>  ?")){this.submit();} else return false;'>
            </td>
          </tr>
        <?php
      }
    ?>
  </table>
  <?php
    
  }
?>
  


</form>