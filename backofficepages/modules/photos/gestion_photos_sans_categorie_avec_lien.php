<h1>Gestion des photos de la bannière</h1>
<?php
// ce module peut servir pour un diaporama, une banière.. etc ...
include '../class/upload.class.inc.php';
function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded && $handle->file_is_image) 
        {
            $FileName='photo_sans_cat_'.time();
            $Rep='../'.RepPhoto;
            $Rep2='../'.RepPhoto.'mins';
            $ext='.'.$handle->file_src_name_ext;
            $handle->file_new_name_body  = $FileName;
            
            $handle->process($Rep);
            $handle->file_new_name_body  = $FileName;
             

            $handle->process($Rep2);
            $charge=true;
            $handle->clean(); 
            unset($handle);
            $file=$FileName.$ext;
            return $file;
      }
      else return false;
    } 

if(isset($_POST['post']))
{
    $upload=ProposePhoto($_FILES['url']);
    if($upload!=false) 
    {
    // ajout sur la base de données
    $sql='insert into '.PREFIXE_BDD.'photos_sans_categorie_avec_lien  (fichier,lien) values("'.$upload.'","'.$_POST['lien'].'")';
    $r = @mysql_query($sql);
    }
}

if(isset($_POST['save']))
{
   $sql='update  '.PREFIXE_BDD.'photos_sans_categorie_avec_lien set ordre_affichage="'.$_POST['ordre'][GetImageButtonValue($_POST['save'])].'",lien="'.$_POST['url'][GetImageButtonValue($_POST['save'])].'" where id_photo="'.GetImageButtonValue($_POST['save']).'"';
  $r = @mysql_query($sql);
}

if(isset($_POST['delete']))
{
   // on recupere le nom du fichier
   $sql='select fichier from  '.PREFIXE_BDD.'photos_sans_categorie_avec_lien where id_photo="'.GetImageButtonValue($_POST['delete']).'"';
   $r = @mysql_query($sql);
   $res=mysql_fetch_assoc($r);
   @unlink('../'.RepPhoto.$res['fichier']);
   @unlink('../'.RepPhoto.'mins/'.$res['fichier']);

   $sql='delete from  '.PREFIXE_BDD.'photos_sans_categorie_avec_lien where id_photo='.GetImageButtonValue($_POST['delete']);
   mysql_query($sql);

}
?>
<h2>Ajouter une photo</h2>
<br /><br />
<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<div style="font-size:14px;">
<b>Lien</b> <input type="text" name="lien" style="border:1px solid #ccc;height:19px;width:200px;margin-left:30px;"><br /><br />
<b>Photo</b> <input type="file" name="url" style="border:1px solid #ccc;height:19px;width:200px;margin-left:15px;" value=""> <br /><br /><input type="submit" name="post" value="Ajouter" style="border:1px solid #ccc;"></div>
</form>
<h2>Liste des photos</h2>
<form name="form2"  action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php
  $sql='select * from '.PREFIXE_BDD.'photos_sans_categorie_avec_lien order by ordre_affichage ASC,id_photo DESC ';
  $r = @mysql_query($sql);
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
  <th style="text-align:left;">Fichier</th>
  <th style="text-align:left;">Lien</th>
  <th width="150">ordre</th>
  <th width="50"></th>
</tr>
<?php
  while ($res=@mysql_fetch_assoc($r))
	{
  ?>
    <tr>
     
      <td style="text-align:left;"><a href="../<?php echo RepPhoto.$res['fichier'] ?>" rel="lightbox1"  class="horizontal"  title="" target="blank" style="color:#000;font-weight:normal;"><img src="../<?php echo RepPhoto.'mins/'.$res['fichier'] ?>" border="0" height="50"></a></td>
      <td style="text-align:left;"><input type="text" name="url[<?php echo $res['id_photo']; ?>]" value="<?php echo $res['lien']; ?>" style="width:250px;"> </td>
      <td><input type="text" name="ordre[<?php echo $res['id_photo']; ?>]" value="<?php echo $res['ordre_affichage']; ?>" style="width:30px;"> <input type="image" name="save[<?php echo $res['id_photo']; ?>]" src="imgs/floppy_disk16.gif"></td>
      
      
      <td><input type="image" name="delete[<?php echo $res['id_photo']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer cette photo ?")){this.submit();} else return false;'></td>

    </tr>

  <?php

	}

?>

</table><br />

<em>Pour visioner la photo, cliquez sur le nom du fichier<br /></em>
<?php

?>
</form>