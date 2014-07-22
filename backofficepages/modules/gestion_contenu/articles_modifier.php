<?php
include '../class/upload.class.inc.php';
function ProposeFichier($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded) 
        {
            $FileName='qualification_'.time();
            $Rep='../'.RepPhoto;
            $Rep2='../'.RepPhoto.'mins';
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
	


if(isset($_POST['save']))
{
    // maj du texte 
    $sql='update  '.PREFIXE_BDD.'articles set texte="'.addslashes($_POST['content']).'",texte_suite="'.addslashes($_POST['texte_suite']).'",titre="'.addslashes($_POST['titre']).'",lien="'.addslashes($_POST['lien']).'",date_modification="'.date('Y-m-d').'" where id_article="'.$_POST['id_article'].'"';
    mysql_query($sql);
    // echo ($sql);
  	
 $upload=ProposeFichier($_FILES['image1']);
    if($upload!=false)
    {
    // on teste si image précédente
    $sql='select image from  '.PREFIXE_BDD.'articles where id_article="'.$_POST['id_article'].'"';
    $res_=mysql_query($sql);
    $ro=mysql_fetch_array($res_);
    @unlink('../'.RepPhoto.'mins/'.$ro['image']);
    @unlink('../'.RepPhoto.''.$ro['image']);
    
    $sql='update  '.PREFIXE_BDD.'articles set image="'.$upload.'" where id_article="'.$_POST['id_article'].'"';
    mysql_query($sql);
    }
    
    if(isset($_POST['delete_image']))
    {
          // on teste si image précédente
          $sql='select image from  '.PREFIXE_BDD.'articles where id_article="'.$_POST['id_article'].'"';
          $res_=mysql_query($sql);
          $ro=mysql_fetch_array($res_);
          @unlink('../'.RepPhoto.'mins/'.$ro['image']);
          @unlink('../'.RepPhoto.''.$ro['image']);
    
          $sql='update  '.PREFIXE_BDD.'articles set image="" where id_article="'.$_POST['id_article'].'"';
          mysql_query($sql);
    }    
}


  // on recupere infos articles
  $sql='select * from '.PREFIXE_BDD.'articles where id_article="'.(int)$_GET['id_article'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  

?>
<h1>Modification article "<?php echo stripslashes($row['titre']); ?>" <?php if($row['id_page']==0) echo ' -> ' ?></h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<?php
  include '../tiny_mce/header_tiny_mce_admin.php';
?>
<b>Titre : </b><input type="text" name="titre" value="<?php echo stripslashes($row['titre']); ?>"><br /><br />
<b>Blog : </b>
<select name="texte_suite">
<option value="<?php echo stripslashes($row['texte_suite']); ?>"><?php echo stripslashes($row['texte_suite']); ?></option>

</select>
<br />

<br />

<b>Description</b>
<textarea style="width:100%;height:400px;" name="content"><?php echo stripslashes($row['texte']); ?></textarea>
<br /><br />
<b>Lien : </b><input type="text" name="lien" value="<?php echo stripslashes($row['lien']); ?>"><br /><br />
<b>Fichier</b> <input type="file" name="image1">
<br /><br />
<?php
  if($row['image']!='')
  {
      ?>
      <a href="<?php echo RepPhoto.'mins/'.$row['image']; ?>" target="_blank"><?php echo $row['image']; ?></a>
      <br />
      <input type="checkbox" name="delete_image"> Supprimer le fichier <br /><br />
      <?php
  }
?>
<input type="submit" name="save" value="Enregistrer">
<input type="hidden" name="id_article" value="<?php echo (int)$_GET['id_article']; ?>">
</form><br /><br />
