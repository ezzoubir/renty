<h1>Modification du contenu</h1>
<?php

include '../class/upload.class.inc.php';
function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded && $handle->file_is_image) 
        {
           //le nom du fichier est de la forme : id_utilisateur_time().ext
            $FileName='page_'.time();
            $Rep='../'.RepPhoto;
            $Rep2='../'.RepPhoto.'mins';
            $ext='.'.$handle->file_src_name_ext;
            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>1024)
            {
                //echo 'test';
                $handle->image_resize   = true;
                $handle->image_x        = 1024;
                $handle->image_ratio_y  = true;
            } 
            $handle->process($Rep);

            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>110)
              {
                //echo 'test';
                 $handle->image_resize         = true;
                 $handle->image_x             =210;
                 $handle->image_ratio_y  = true;
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

if(isset($_POST['del_image']))
{
    $id_photo=GetImageButtonValue($_POST['del_image']);
    $sql='select fichier from '.PREFIXE_BDD.'pages_photos where id_photo="'.$id_photo.'"';
    $r=mysql_query($sql);
    $roo=mysql_fetch_array($r);
    @unlink('../'.RepPhoto.'mins/'.$roo['fichier']);
    @unlink('../'.RepPhoto.''.$roo['fichier']);
    
    $sql='delete from '.PREFIXE_BDD.'pages_photos where id_photo="'.$id_photo.'"';
    mysql_query($sql);
}


if(isset($_POST['save']))
{
    // maj du texte 
    $sql='update  '.PREFIXE_BDD.'pages set texte="'.addslashes($_POST['content']).'" where id_page="'.$_POST['id_page'].'"';
    mysql_query($sql);
    
    
    //$upload=ProposePhoto($_FILES['photo']);
    /*if($upload!=false)
    {
          $sql='insert into '.PREFIXE_BDD.'pages_photos (id_page,fichier) values("'.$_POST['id_page'].'","'.$upload.'")';
          mysql_query($sql);
    
    }*/
}

  // on recupere le(s) titre(s)
  $sql='select * from '.PREFIXE_BDD.'pages where id_page="'.(int)$_GET['id_page'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  
  $titre_h2=stripslashes($row['titre']);
  
  if($row['parent_id']!=0)
  {
      // on recupere titre page parent
      $sql_parent='select * from '.PREFIXE_BDD.'pages where id_page="'.$row['parent_id'].'"';
      $res_parent=mysql_query($sql_parent);
      $row_parent=mysql_fetch_array($res_parent);
      $titre_h2=stripslashes($row_parent['titre']).' > '.$titre_h2;
  }
  
  
?>
<h2>Page > <?php echo $titre_h2; ?></h2>
<?php
  include '../tiny_mce/header_tiny_mce_admin.php';
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<textarea style="width:100%;height:400px;" name="content"><?php echo stripslashes($row['texte']); ?></textarea>

<input type="hidden" name="id_page" value="<?php echo (int)$_GET['id_page']; ?>">
<?php
  if(GESTION_CONTENU_IMAGES_CONTENU && $row['parent_id']!=0)
  {
        // ajout de photos
        ?>
        
        <br/><br/>
        <b>Ajouter une photo</b><br/><br/>
        <input type="file" name="photo">
        <br/>
        <div style=" margin-top:25px;">
        <?php
          $sql='select * from '.PREFIXE_BDD.'pages_photos where id_page="'.(int)$_GET['id_page'].'" order by id_photo';
          $res=mysql_query($sql);
          while($row=mysql_fetch_array($res))
          {
            ?>
              <div style="border:1px solid #000;padding:5px;float:left;margin-right:15px;margin-bottom:15px;text-align:center;">
                <img src="../<?php echo RepPhoto.$row['fichier']; ?>" width="80" border="0">
                <br />
                <input type="submit" name="del_image[<?php echo $row['id_photo']; ?>]" value="Supprimer" style="border:1px solid #000;">
              </div>
          <?php
          }
  
        ?>
        <div style="clear:both;"></div>
        </div>
        <?php
  }
  else
  {
    ?>
      <input type="hidden" name="photo">
    <?php
  }

?>
<br />
<input type="submit" name="save" value="Enregistrer">
</form>