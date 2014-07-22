<?php
  // on verifit que la langue existe
  $sql='select * from '.PREFIXE_BDD.'languages where symbol="'.$_GET['language'].'"';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)==1)
  {
?>
<h1>Galerie photos <?php echo $_GET['language']; ?></h1>
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
            $FileName='galerie_photos_'.time();
            $Rep='../'.RepPhoto;
            $Rep2='../'.RepPhoto.'mins';
            $ext='.'.$handle->file_src_name_ext;
            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>800)
            {
                 $handle->image_resize         = true;
                 $handle->image_x             =800;
                 $handle->image_ratio_y        = true;
              } 
            $handle->process($Rep);
            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>150)
            {
                 $handle->image_resize         = true;
                 $handle->image_x             =150;
                 
                 $handle->image_ratio_y        = true;
            } 

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
    $sql='insert into '.PREFIXE_BDD.'galerie_photos (fichier,titre,titre2,language,id_album) values("'.$upload.'","'.addslashes($_POST['titre']).'","'.addslashes($_POST['titre2']).'","'.$_POST['language'].'","'.$_POST['id_album'].'")';
    $r = @mysql_query($sql);
    }
}

if(isset($_POST['save']))
{
   $sql='update  '.PREFIXE_BDD.'galerie_photos set ordre_affichage="'.$_POST['ordre'][GetImageButtonValue($_POST['save'])].'",titre="'.addslashes($_POST['titre_'][GetImageButtonValue($_POST['save'])]).'" ,titre2="'.addslashes($_POST['titre2_'][GetImageButtonValue($_POST['save'])]).'"where id_photo="'.GetImageButtonValue($_POST['save']).'"';
  $r = @mysql_query($sql);
}

if(isset($_POST['delete']))
{
   // on recupere le nom du fichier
   $sql='select fichier from  '.PREFIXE_BDD.'galerie_photos where id_photo="'.GetImageButtonValue($_POST['delete']).'"';
   $r = @mysql_query($sql);
   $res=mysql_fetch_assoc($r);
   @unlink('../'.RepPhoto.$res['fichier']);
   @unlink('../'.RepPhoto.'mins/'.$res['fichier']);

   $sql='delete from  '.PREFIXE_BDD.'galerie_photos where id_photo='.GetImageButtonValue($_POST['delete']);
   mysql_query($sql);

}

if(isset($_POST['post_album']))
{
    
    //$upload=ProposePhoto($_FILES['url_album']);
    $upload='';
    if($upload!=false) 
    {
    // ajout sur la base de données
    $sql='insert into '.PREFIXE_BDD.'galerie_photos_album (fichier,titre,language) values("'.$upload.'","'.addslashes($_POST['titre_album']).'","'.$_POST['language'].'")';
    $r = @mysql_query($sql);
    }
    else
    {
    $sql='insert into '.PREFIXE_BDD.'galerie_photos_album (titre,language) values("'.addslashes($_POST['titre_album']).'","'.$_POST['language'].'")';
    $r = @mysql_query($sql);
    }
}

if(isset($_POST['save_ordre_album']))
{
      $id_album=GetImageButtonValue($_POST['save_ordre_album']);
      $sql='update '.PREFIXE_BDD.'galerie_photos_album  set ordre_affichage="'.$_POST['ordre_affichage_album'][$id_album].'"  where id_album="'.$id_album.'"';
      mysql_query($sql);

}

if(isset($_POST['delete_album']))
{
     $id_album=GetImageButtonValue($_POST['delete_album']);
    $sql='select * from '.PREFIXE_BDD.'galerie_photos where id_album="'.$id_album.'"';
    $res=mysql_query($sql);
    while($row=mysql_fetch_array($res))
    {
        @unlink('../'.RepPhoto.'mins/'.$row['fichier']);
        @unlink('../'.RepPhoto.''.$row['fichier']);
    }
    $sql='delete from  '.PREFIXE_BDD.'galerie_photos where id_album="'.$id_album.'"';
    mysql_query($sql);
    
    $sql='delete from '.PREFIXE_BDD.'galerie_photos_album  where id_album="'.$id_album.'"';
     mysql_query($sql);
}
if(CREATION_ALBUM_PHOTOS)
{
?>
<h2>Créer un album</h2>
<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<div style="font-size:14px;">

<b></b> <input type="hidden" name="url_album" style="border:1px solid #ccc;height:19px;width:200px;margin-left:15px;" value=""> 
Titre de l'album : <input type="text" name="titre_album" style="width:250px;">
<input type="hidden" name="language" value="<?php echo $_GET['language']; ?>">
<br /><br /><input type="submit" name="post_album" value="Ajouter"></div>

</form>
<hr />
<?php
}
?>
<h2>Ajouter une photo</h2>

<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<div style="font-size:14px;">
<b>Album</b> <select name="id_album">
  <option value="0">Aucun</option>
  <?php
    $sql='select * from '.PREFIXE_BDD.'galerie_photos_album where language="'.$_GET['language'].'"  order by ordre_affichage,id_album';
    $res=mysql_query($sql);
    while($ro=mysql_fetch_array($res))
    {
        echo '<option value="'.$ro['id_album'].'"';
        if(isset($_POST['id_album']) && $_POST['id_album']==$ro['id_album']) echo ' selected ';
        echo '>'.stripslashes($ro['titre']).'</option>';
    }
  ?>
</select>
<br /><br />
<b>Photo</b> <input type="file" name="url" style="border:1px solid #ccc;height:19px;width:200px;margin-left:15px;" value=""> <br /><br />
Titre : <input type="text" name="titre" style="width:250px;">
<?php
if(GALERIE_PHOTOS_CHAMP_DESCRIPTION_2)
{
  ?>
  <br /><br />
  Titre : <input type="text" name="titre2" style="width:250px;">
  <?php
}
else
{
  ?>
  <input type="hidden" name="titre2">
  <?php
}
?>
<input type="hidden" name="language" value="<?php echo $_GET['language']; ?>">
<br /><br /><input type="submit" name="post" value="Ajouter"></div>
</form>
<hr />
<h2>Liste des photos</h2>

<form name="form2"  action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
<th style="color:red;text-align:left;" colspan="2">Sans album</th>
</tr>
<tr>
<td valign="top" colspan="2">
<?php
  $sql='select * from '.PREFIXE_BDD.'galerie_photos where language="'.$_GET['language'].'" and id_album="0" order by ordre_affichage ASC,id_photo DESC ';
  $r = @mysql_query($sql);
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
  <th style="text-align:left;">Fichier</th>
  <th style="text-align:left;">Titre </th>
  <th width="150">ordre</th>
  <th width="50"></th>
</tr>
<?php
  while ($res=@mysql_fetch_assoc($r))
	{
  ?>
    <tr>
     
      <td style="text-align:left;"><a href="../<?php echo RepPhoto.$res['fichier'] ?>" rel="lightbox1"  class="horizontal"  title="" target="blank" style="color:#000;font-weight:normal;"><img src="../<?php echo RepPhoto.'mins/'.$res['fichier'] ?>" border="0" height="50"></a></td>
      <td style="text-align:left;">
      
      <input type="text" name="titre_[<?php echo $res['id_photo']; ?>]" value="<?php echo stripslashes($res['titre']); ?>" style="width:250px;"><br />
      <?php
      if(GALERIE_PHOTOS_CHAMP_DESCRIPTION_2)
      {
      ?>
      <input type="text" name="titre2_[<?php echo $res['id_photo']; ?>]" value="<?php echo stripslashes($res['titre2']); ?>" style="width:250px;">
      <?php
      }
      ?>
       </td>
      <td><input type="text" name="ordre[<?php echo $res['id_photo']; ?>]" value="<?php echo $res['ordre_affichage']; ?>" style="width:30px;"> <input type="image" name="save[<?php echo $res['id_photo']; ?>]" src="imgs/floppy_disk16.gif"></td>
      <td><input type="image" name="delete[<?php echo $res['id_photo']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer cette photo ?")){this.submit();} else return false;'></td>

    </tr>

  <?php

	}

?>

</table></td></tr>
<?php
  $sql='select * from '.PREFIXE_BDD.'galerie_photos_album where  language="'.$_GET['language'].'"  order by ordre_affichage,id_album';
  $rers=mysql_query($sql);
  while($ro=mysql_fetch_array($rers))
  {
?>
<tr>
  <th style="color:red;text-align:left;"><?php echo stripslashes($ro['titre']); ?></th>
  <th style="text-align:left;"><em>Ordre affichage : <input type="text" name="ordre_affichage_album[<?php echo $ro['id_album'] ?>]" value="<?php echo $ro['ordre_affichage']; ?>" style="width:30px;"></em>
  <input type="image" name="save_ordre_album[<?php echo $ro['id_album']; ?>]" src="imgs/floppy_disk16.gif">
  <input type="image" style="margin-left:20px;margin-right:25px;" name="delete_album[<?php echo $ro['id_album']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer cet album ?")){this.submit();} else return false;'>
  </th>
</tr>
<tr>
  <td colspan="2">
  <?php
  $sql='select * from '.PREFIXE_BDD.'galerie_photos where language="'.$_GET['language'].'" and id_album="'.$ro['id_album'].'" order by ordre_affichage ASC,id_photo DESC ';
  $r = @mysql_query($sql);
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
  <th style="text-align:left;">Fichier</th>
  <th style="text-align:left;">titre / description </th>
  <th width="150">ordre</th>
  <th width="50"></th>
</tr>
<?php
  while ($res=@mysql_fetch_assoc($r))
	{
  ?>
    <tr>
     
      <td style="text-align:left;"><a href="../<?php echo RepPhoto.$res['fichier'] ?>" rel="lightbox1"  class="horizontal"  title="" target="blank" style="color:#000;font-weight:normal;"><img src="../<?php echo RepPhoto.'mins/'.$res['fichier'] ?>" border="0" height="50"></a></td>
      <td style="text-align:left;"><input type="text" name="titre_[<?php echo $res['id_photo']; ?>]" value="<?php echo stripslashes($res['titre']); ?>" style="width:250px;"> </td>
      <td><input type="text" name="ordre[<?php echo $res['id_photo']; ?>]" value="<?php echo $res['ordre_affichage']; ?>" style="width:30px;"> <input type="image" name="save[<?php echo $res['id_photo']; ?>]" src="imgs/floppy_disk16.gif"></td>
      <td><input type="image" name="delete[<?php echo $res['id_photo']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer cette photo ?")){this.submit();} else return false;'></td>

    </tr>

  <?php

	}

?>

</table>
  
  </td>
</tr>
<?php
  }
?>
</table><br />

<em>Pour visioner la photo, cliquez sur le nom du fichier<br /></em>
<?php

?>
</form>
<?php
  }
  else
  {
      ?>
        <h1>ERREUR SUR LA LANGUE</h1>
      <?php
  }
?>