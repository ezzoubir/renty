<?php
if(isset($_POST['submit']))
{
      include '../class/upload.class.inc.php';
      function ProposePhotoPresentation($UploadingFile)
      {
              $charge=false;
              //insertion photo traitement 
              $handle = new upload($UploadingFile);
              //type fichier interdit
              $handle->allowed = array('image/*');
              if ($handle->uploaded && $handle->file_is_image) 
              {
                  //le nom du fichier est de la forme : id_utilisateur_time().ext
                  $FileName='photo_presentation_video_'.time();
                  $Rep='../'.RepPhoto;
                  $ext='.'.$handle->file_src_name_ext;
      
                  $handle->file_new_name_body  = $FileName;
                  if($handle->image_src_x>400)
                    {
                      //echo 'test';
                       $handle->image_resize         = true;
                       $handle->image_x              = 400;
                       $handle->image_ratio_y        = true;
                       
                    } 
                  $handle->process($Rep);
                  $charge=true;
                  $handle->clean(); 
                  unset($handle);
                
                  $file=$FileName.$ext;
                  
                  return $file;
            }
            else return false;
          } 
          
      function ProposeVideo($UploadingFile)
      {
              $charge=false;
              //insertion photo traitement 
              $handle = new upload($UploadingFile);
              //type fichier interdit
             
              if ($handle->uploaded) 
              {
                  //le nom du fichier est de la forme : id_utilisateur_time().ext
                  $FileName='video_'.time();
                  $Rep='../'.RepPhoto;
                  $ext='.'.$handle->file_src_name_ext;
                  $handle->file_new_name_body  = $FileName;
                  $handle->process($Rep);
                  $charge=true;
                  $handle->clean(); 
                  unset($handle);
                
                  $file=$FileName.$ext;
                  
                  return $file;
            }
            else return false;
          } 
      
      // ajout d'une video
      // on teste si fichier ou url
      if($_POST['video_youtube']=='')
      {
            
            $upload_video=ProposeVideo($_FILES['video']);
            if($upload_video!=false)
            {
              $upload_photo=ProposePhotoPresentation($_FILES['picture1']);
              
              // insertion
              $sql='insert into '.PREFIXE_BDD.'galerie_videos (titre,fichier,ordre_affichage,language) values("'.addslashes($_POST['titre']).'","'.$upload_video.'","'.$_POST['ordre'].'","'.$_POST['language'].'")';
              $res=mysql_query($sql);
              $id_video=mysql_insert_id();
              $sql='update '.PREFIXE_BDD.'galerie_videos set image_presentation="'.$upload_photo.'" where id_video="'.$id_video.'"' ;
              mysql_query($sql);
              
              
            }
      }
      else
      {
          $upload_photo=ProposePhotoPresentation($_FILES['picture1']);
          $sql='insert into '.PREFIXE_BDD.'galerie_videos (titre,image_presentation,ordre_affichage,language,url) values("'.addslashes($_POST['titre']).'","'.$upload_photo.'","'.$_POST['ordre'].'","'.$_POST['language'].'","'.$_POST['video_youtube'].'")';
          $res=mysql_query($sql);   
      }

}
if(isset($_POST['delete']))
{
    $id_video=GetImageButtonValue($_POST['delete']);
    // on recupere enregistrement
    $sql='select * from '.PREFIXE_BDD.'galerie_videos where id_video="'.$id_video.'"';
    $res=mysql_query($sql);
    $row_video=mysql_fetch_array($res);
    if($row_video['image_presentation']!='')
    {
        @unlink('../'.RepPhoto.$row_video['image_presentation']);
    }
    if($row_video['fichier']!='')
    {
        @unlink('../'.RepPhoto.$row_video['fichier']);
    }
    // on supprimer l'enregistrement
    $sql='delete from '.PREFIXE_BDD.'galerie_videos where id_video="'.$id_video.'"';
    mysql_query($sql);
}
if(isset($_POST['save']))
{
      // juste ordre affichage modifiable
      $id_video=GetImageButtonValue($_POST['save']);
      $sql='update  '.PREFIXE_BDD.'galerie_videos  set ordre_affichage="'.$_POST['ordre_affichage_'][$id_video].'" where id_video="'.$id_video.'"';
      mysql_query($sql);
}

  // on verifit que la langue existe
  $sql='select * from '.PREFIXE_BDD.'languages where symbol="'.$_GET['language'].'"';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)==1)
  {
?>
    <h1>Galerie vidéos <?php echo $language; ?></h1>
    <h2>Ajouter une vidéo</h2>
    <form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="language" value="<?php echo $_GET['language']; ?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <th style="text-align:left;width:200px;">Titre</th><td style="text-align:left;"><input type="text" name="titre" value="" style="width:300px;"></td>
    </tr>
    <tr>
      <th style="text-align:left;">Ordre affichage</th><td style="text-align:left;"><input type="text" name="ordre" value="" style="width:30px;"></td>
    </tr>
    <tr>
      <th style="text-align:left;width:200px;" valign="top">Image présentation vidéo</th><td style="text-align:left;">
      <input type="file" name="picture1" value=""></td>
    </tr>
    <tr>
  <th style="text-align:left;width:200px;" valign="top">Vidéo</th><td align="left" style="text-align:left;">
  <table align="left">
  <tr>
    <td align="left" style="text-align:left;">URL Youtube </td>
    <td align="left" style="text-align:left;">http://<input type="text" name="video_youtube" value="<?php if(isset($row__['video_url1'])) echo $row__['video_url1']; ?>"  style="width:400px;" /></td>
  </tr>
  
    <tr>
    <td colspan="2" height="20" style="text-align:left;"><b>ou</b></td>
    </tr>
    <tr>
      <td align="left" style="text-align:left;">Fichier</td>
      <td align="left" style="text-align:left;"><input type="file" name="video"  value=""><br /></td>
    </tr>
    </table>
    
    
    </td>
  </tr>
  <tr>
    <th style="text-align:left;width:200px;"></th><td style="text-align:left;"><input type="submit" name="submit" value="Enregistrer"></td>
  </tr>
      </table>
  
  <h2>Liste des vidéos</h2>   
  <?php
    $sql='select * from '.PREFIXE_BDD.'galerie_videos where language="'.$_GET['language'].'" order by ordre_affichage,id_video';
    $res=mysql_query($sql);
      
  
  ?>  
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th>Image de présentation</th>
        <th>Titre</th>
        <th>fichier</th>
        <th>url</th>
        <th>ordre d'affichage</th>
        <th>Fonctions</th>
    </tr>
    <?php
    while($row=mysql_fetch_array($res))
    {
        ?>
          <tr>
            <td><?php if($row['image_presentation']!='') echo '<img src="../'.RepPhoto.$row['image_presentation'].'" width="150">'; ?></td>
            <td><?php echo stripslashes($row['titre']); ?></td>
            <td><?php if($row['fichier']!=''){echo '<a href="../'.RepPhoto.$row['fichier'].'" target="_blank">'.$row['fichier'].'</a>';} ?></td>
            <td><?php if($row['url']!=''){echo '<a href="http://'.$row['url'].'" target="_blank">'.$row['url'].'</a>';} ?></td>
            <td><input type="text" name="ordre_affichage_[<?php echo $row['id_video']; ?>]" value="<?php echo $row['ordre_affichage']; ?>" style="width:35px;"></td>
            <td>
            <input type="image" name="save[<?php echo $row['id_video']; ?>]" src="imgs/floppy_disk16.gif">
            <input style="margin-left:10px;" type="image" name="delete[<?php echo $row['id_video']; ?>]" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row['titre']); ?>  ?')){this.submit();} else return false;">
            
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