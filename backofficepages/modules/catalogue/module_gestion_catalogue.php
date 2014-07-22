<?php


if(isset($_POST['delete']))
{
    $id_page=GetImageButtonValue($_POST['delete']);
    
    // on recupere id parent
    $sql='select * from '.PREFIXE_BDD.'catalogue_produits  where id_categorie="'. $id_page.'"';
    $res_=mysql_query($sql);
    while($row_=mysql_fetch_array($res_))
    {
        
       // on recupere image presentation pour suppr
       @unlink('../'.RepPhoto.'mins/'.$row_['image']);
       @unlink('../'.RepPhoto.''.$row_['image']);
       
    }
    $sql='delete from '.PREFIXE_BDD.'catalogue_categories where id_page="'. $id_page.'"';
    mysql_query($sql);
   

}

if(isset($_POST['add0']))
{
      //insertion page principal
      $sql='insert into '.PREFIXE_BDD.'catalogue_categories (parent_id,titre,language) values("0","'.$_POST['titre_page'].'","'.$_POST['language'].'")';
      mysql_query($sql);

}
if(isset($_POST['add1']))
{
      $parent_id=GetImageButtonValue($_POST['add1']);
      //insertion page principal
      $sql='insert into '.PREFIXE_BDD.'catalogue_categories (parent_id,titre,language) values("'.$parent_id.'","'.$_POST['titre_1'][$parent_id].'","'.$_POST['language'].'")';
      mysql_query($sql);

}
if(isset($_POST['save']))
{
    $id_page=GetImageButtonValue($_POST['save']);
    $sql='update '.PREFIXE_BDD.'catalogue_categories set ordre_affichage="'.$_POST['ordre_affichage'][$id_page].'",titre="'.$_POST['titre'][$id_page].'" where id_page="'.$id_page.'"';
    mysql_query($sql);

}

$sql='select * from '.PREFIXE_BDD.'languages where symbol="'.$_GET['language'].'"';
$res_language=mysql_query($sql);
if(mysql_num_rows($res_language)>0)
{

$row_language=mysql_fetch_array($res_language);
?>
<h1>Catalogue <?php echo $row_language['symbol']; ?></h1>


<?php
if(GESTION_CATALOGUE_NIVEAU_1)
{
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <th></th>
      <th colspan="2" style="text-align:left;">Ajouter une catégorie</th>
    </tr>
    <tr>
      <th width="200">Titre  <?php echo $row_language['symbol']; ?></th><td style="text-align:left;"><input type="text" name="titre_page" style="width:300px;"></td>
      <td><input type="image" name="add0[]" src="imgs/Add2.gif" /></td>
    </tr>
  </table>
  <input type="hidden" name="parent_id" value="0">
  <input type="hidden" name="language" value="<?php echo $row_language['symbol']; ?>">
</form>

<?php
}
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php
// liste des pages principales
$sql='select * from '.PREFIXE_BDD.'catalogue_categories where language="'.$row_language['symbol'].'" and parent_id="0" order by ordre_affichage,id_page';
$res_pages=mysql_query($sql);
?>
<h2>Pages <?php echo $row_language['symbol']; ?></h2>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <th style="text-align:left;">Titre</th>
      <?php
      if(PUBLICATION_ARTICLES)
      {
      ?>
      <th style="text-align:center;">Autoriser la publication d'articles</th>
      <?php
      }
      ?>
      <th><?php if(GESTION_CATALOGUE_NIVEAU_1 || GESTION_CATALOGUE_NIVEAU_2) echo 'Ordre d\'affichage'; ?></th>
      <th>Fonction(s)</th>
    </tr>
    <?php
      while($row_page=mysql_fetch_array($res_pages))
      {
        if(GESTION_CATALOGUE_NIVEAU_1)
        {
        ?>
         
          <tr>
            <td style="text-align:left;"><input type="text" name="titre[<?php echo $row_page['id_page']; ?>]" value="<?php echo stripslashes($row_page['titre']); ?>"  style="width:300px;" /></td>

            <td style=""><input type="text" style="width:30px;" name="ordre_affichage[<?php echo $row_page['id_page']; ?>]" value="<?php echo $row_page['ordre_affichage']; ?>"></td>
            <td style="">
            
            <input type="image" name="save[<?php echo $row_page['id_page']; ?>]" src="imgs/floppy_disk16.gif">
            <a href="index.php?action=catalogue_produits&id_page=<?php echo $row_page['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
            <input style="margin-left:10px;" type="image" name="delete[<?php echo $row_page['id_page']; ?>]" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row_page['titre']); ?>  ?')){this.submit();} else return false;">
            </td>
          </tr>

        <?php
        }
        else
        {
          ?>
        <tr>
            <td style="text-align:left;"><?php echo stripslashes($row_page['titre']); ?></td>
            <td style=""></td>
            
            <td style="">
            <a href="index.php?action=catalogue_produits&id_page=<?php echo $row_page['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0"  /></a>
            </td>
          </tr>
          <?php
        }
        ?>
          <?php
            
            // on recupere les sous pages
            $sql='select * from  '.PREFIXE_BDD.'catalogue_categories where parent_id="'.$row_page['id_page'].'" order by ordre_affichage,id_page';
            $res_souspage=mysql_query($sql);
            while($row_souspage=mysql_fetch_array($res_souspage))
            {
              if(GESTION_CATALOGUE_NIVEAU_2)
              {
                ?>
                <tr>
                  <td style="text-align:left;padding-left:25px;"><b>-</b> <input style="font-size:11px;width:250px;" type="text" name="titre[<?php echo $row_souspage['id_page']; ?>]" value="<?php echo stripslashes($row_souspage['titre']); ?>"> </td>
                  
                  <td><input type="text" style="width:30px;font-size:11px;" name="ordre_affichage[<?php echo $row_souspage['id_page']; ?>]" value="<?php echo $row_souspage['ordre_affichage']; ?>"></td>
                  
                  <td>
                  <input type="image" name="save[<?php echo $row_souspage['id_page']; ?>]" src="imgs/floppy_disk16.gif" height="12">
                  <a href="index.php?action=catalogue_produits&id_page=<?php echo $row_souspage['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  <input style="margin-left:10px;" type="image" name="delete[<?php echo $row_souspage['id_page']; ?>]" height="12" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row_souspage['titre']); ?>  ?')){this.submit();} else return false;">
            
                  </td>
                </tr>
   
                <?php
              }
              else
              {
              ?>
                <tr>
                  <td style="text-align:left;padding-left:25px;"><b>-</b> <?php echo stripslashes($row_souspage['titre']); ?> </td>
                 
                  <td style=""></td>
                  <td>
                  <a href="index.php?action=gestion_contenu_modifier&id_page=<?php echo $row_souspage['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  
                  </td>
                </tr>
              <?php
              }
            }
            if(GESTION_CATALOGUE_NIVEAU_2)
            {
          ?>
           <tr>
            <th colspan="<?php
               echo '3';?>" style="border-bottom:2px solid #000;text-align:left;padding-left:50px;font-size:11px;">
            Ajouter une sous catégorie<input type="text" name="titre_1[<?php echo $row_page['id_page']; ?>]" style="width:250px;font-size:11px;margin-left:50px;"><input type="image" name="add1[<?php echo $row_page['id_page']; ?>]" src="imgs/Add.gif" style="margin-left:30px;" /></th>
          </tr>
        <?php
          }
          else
          {
            ?>
              <tr>
            <th colspan="<?php
               echo '3';?>" style="border-bottom:2px solid #000;text-align:left;padding-left:50px;font-size:11px;"></th></tr>
            <?php
          }
      }
    ?>
  </table>
  <input type="hidden" name="language" value="<?php echo $row_language['symbol']; ?>">
  </form>
<?php
}
?>