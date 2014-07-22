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
	
	
 $upload=ProposeFichier($_FILES['image1']);
   
if(isset($_POST['save']))
{
    // maj du texte 
    $sql='Insert into  '.PREFIXE_BDD.'articles
(`texte` ,
`texte_suite` ,
`lien` ,
`titre` ,
`date_publication`,
`image` ,
`language`)
VALUES ("'.addslashes($_POST['content']).'","'.addslashes($_POST['texte_suite']).'","'.addslashes($_POST['lien']).'","'.addslashes($_POST['titre']).'","'.date('Y-m-d').'","'.$upload.'","'.$_GET['language'].'")';
    mysql_query($sql);
    // echo ($sql);

   
    // on teste si image précédente
    $sql='select image from  '.PREFIXE_BDD.'articles where id_article="'.$_POST['id_article'].'"';
    $res_=mysql_query($sql);
    $ro=mysql_fetch_array($res_);
    @unlink('../'.RepPhoto.'mins/'.$ro['image']);
    @unlink('../'.RepPhoto.''.$ro['image']);
    
    $sql='insert into  '.PREFIXE_BDD.'articles set image="'.$upload.'" where id_article="'.$_POST['id_article'].'"';
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


  // on recupere infos articles
  $sql='select * from '.PREFIXE_BDD.'articles where id_article="'.(int)$_GET['id_article'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
  

?>
<h1>Ajout d'article </h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<?php
  include '../tiny_mce/header_tiny_mce_admin.php';
?>

<b>Titre : </b><input type="text" name="titre" value="<?php echo stripslashes($row['titre']); ?>"><br /><br />
<b>Blog :</b>
<select name="texte_suite">
<option value="Publications-transports">Publications transports </option>
<option value="Autres-publications">Autres publications </option>
<option value="Etudes-diverses">Etudes diverses </option>
</select><br/><br/>
<b>Description</b><br/>
<textarea style="width:70%;height:200px;" name="content"><?php echo stripslashes($row['texte']); ?></textarea>
<br /><br />
<b>Lien : </b>http://<input type="text" name="lien" value="<?php echo stripslashes($row['lien']); ?>"><br /><br />
<br />
<br />

<b>Fichier</b> <input type="file" name="image1">
<br /><br />
<?php
  if($row['image']!='')
  {
      ?>
      <img src="../<?php echo RepPhoto.'mins/'.$row['image']; ?>" style="border:2px solid #fff;">
      <br />
      <input type="checkbox" name="delete_image"> Supprimer l'image<br /><br />
      <?php
  }
?>
<input type="submit" name="save" value="Enregistrer">
<input type="hidden" name="id_article" value="<?php echo (int)$_GET['id_article']; ?>">
</form><br /><br />
