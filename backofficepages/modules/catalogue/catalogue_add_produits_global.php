<?php
  if(isset($_POST['id_produit']))
  {
      $id_produit=$_POST['id_produit'];
  }
  if(isset($_GET['id_produit']))
  {
      $id_produit=$_GET['id_produit'];
  
  }
  
  if(!isset($id_produit))
  {
      // insertion
  }
?>
<a href="index.php?action=catalogue_produits&id_page=<?php echo (int)$_GET['id_page']; ?>">Retour</a>
<?php
    if(!isset($id_produit))
  {
     ?>
    <h1>Insertion d'un produit</h1>
  <?php
  }
  else
  {
  ?>
    <h1>Modification d'un produit</h1>
  <?php
  }
?>
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
            $FileName='article_'.time();
            $Rep='../'.RepPhoto;
            $Rep2='../'.RepPhoto.'mins';
            $ext='.'.$handle->file_src_name_ext;
            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>800)
            {
                //echo 'test';
                $handle->image_resize   = true;
                $handle->image_x        = 800;
                $handle->image_ratio_y  = true;
            } 
            $handle->process($Rep);

            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>110)
              {
                //echo 'test';
                 $handle->image_resize         = true;
                 $handle->image_x             =110;
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

if(isset($_POST['save']) && isset($id_produit))
{
    // maj du texte 
    $sql='update  '.PREFIXE_BDD.'catalogue_produits set texte="'.addslashes($_POST['presentation']).'",texte_suite="'.addslashes($_POST['tiny']).'",titre="'.addslashes($_POST['titre']).'" where id_produit="'.$id_produit.'"';
    mysql_query($sql);
    
    $upload=ProposePhoto($_FILES['image1']);
    if($upload!=false)
    {
    // on teste si image précédente
    $sql='select image from  '.PREFIXE_BDD.'catalogue_produits where id_produit="'.$_POST['id_produit'].'"';
    $res_=mysql_query($sql);
    $ro=mysql_fetch_array($res_);
    @unlink('../'.RepPhoto.'mins/'.$ro['image']);
    @unlink('../'.RepPhoto.''.$ro['image']);
    
    $sql='update  '.PREFIXE_BDD.'catalogue_produits set image="'.$upload.'" where id_produit="'.$_POST['id_produit'].'"';
    mysql_query($sql);
    }
    
    if(isset($_POST['delete_image']))
    {
          // on teste si image précédente
          $sql='select image from  '.PREFIXE_BDD.'catalogue_produits where id_produit="'.$_POST['id_produit'].'"';
          $res_=mysql_query($sql);
          $ro=mysql_fetch_array($res_);
          @unlink('../'.RepPhoto.'mins/'.$ro['image']);
          @unlink('../'.RepPhoto.''.$ro['image']);
    
          $sql='update  '.PREFIXE_BDD.'catalogue_produits set image="" where id_produit="'.$_POST['id_produit'].'"';
          mysql_query($sql);
    }    
}
else if(isset($_POST['save']))
{
      $sql='insert into '.PREFIXE_BDD.'catalogue_produits (texte,texte_suite,titre,id_categorie) values("'.addslashes($_POST['presentation']).'","'.addslashes($_POST['tiny']).'","'.addslashes($_POST['titre']).'","'.(int)$_GET['id_page'].'")';
      mysql_query($sql);
      
      $id_produit=mysql_insert_id();
      
    $upload=ProposePhoto($_FILES['image1']);
    if($upload!=false)
    {

    $sql='update  '.PREFIXE_BDD.'catalogue_produits set image="'.$upload.'" where id_produit="'.$id_produit.'"';
    mysql_query($sql);
    }
}
if(isset($id_produit))
{
  // on recupere infos articles
  $sql='select * from '.PREFIXE_BDD.'catalogue_produits where id_produit="'.$id_produit.'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_array($res);
}  

?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">

<b>Titre : </b><input type="text" name="titre" value="<?php if(isset($id_produit)) echo stripslashes($row['titre']); ?>"><br /><br />
<b>Texte de présentation</b>
<textarea style="width:100%;height:400px;" name="presentation" ><?php if(isset($id_produit)) echo stripslashes($row['texte']); ?></textarea>
<br /><br />
<?php
  include '../tiny_mce/header_tiny_mce_admin_exact.php';
?>
<b>Description</b>
<textarea style="width:100%;height:400px;" name="tiny"><?php if(isset($id_produit)) echo stripslashes($row['texte_suite']); ?></textarea>
<br />
<br />

<b>Image de présentation</b> <input type="file" name="image1">
<br /><br />
<?php
  if(isset($id_produit) && $row['image']!='')
  {
      ?>
      <img src="../<?php echo RepPhoto.'mins/'.$row['image']; ?>" style="border:2px solid #fff;">
      <br />
      <input type="checkbox" name="delete_image"> Supprimer l'image<br /><br />
      <?php
  }
?>
<input type="submit" name="save" value="Enregistrer">
<?php
if(isset($id_produit))
{
?>
<input type="hidden" name="id_produit" value="<?php if(isset($id_produit)) echo (int)$id_produit; ?>">
<?php
}
?>
</form><br /><br />
