<?php
  if(isset($_POST['ENREGSITRER_ARTICLE']))
  {
  include 'class/upload.class.inc.php';
  function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded && $handle->file_is_image) 
        {
           //le nom du fichier est de la forme : id_utilisateur_time().ext
            $FileName='article_'.time();
            $Rep=''.RepPhoto;
            $Rep2=''.RepPhoto.'mins';
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
  
  
        // on enregistre article
        if(isset($_POST['id_article']) && $_POST['id_article']!='')
        {
              // maj
              $sql='update  '.PREFIXE_BDD.'articles set titre="'.addslashes($_POST['titre']).'",texte="'.addslashes($_POST['content']).'",texte_suite="'.addslashes($_POST['content2']).'",date_modification="'.date('Y-m-d').'"
                    where id_article="'.$_POST['id_article'].'"';
              mysql_query($sql);
              //echo $sql;
              $id_article=$_POST['id_article'];
        
        }
        else
        {
              // insertion
              $sql='insert into  '.PREFIXE_BDD.'articles (id_utilisateur,titre,texte,texte_suite,id_page,language,date_publication,date_modification)
                    values("'.$_SESSION['id_membre'].'","'.addslashes($_POST['titre']).'","'.addslashes($_POST['content']).'","'.addslashes($_POST['content2']).'","'.$_POST['id_page'].'","'.$language.'","'.date('Y-m-d').'","'.date('Y-m-d').'")
              
              ';
              mysql_query($sql);
              
              $id_article=mysql_insert_id();
        }
  
      if(isset($_POST['delete_image']))
    {
          // on teste si image précédente
          $sql='select image from  '.PREFIXE_BDD.'articles where id_article="'.$_POST['id_article'].'"';
          $res_=mysql_query($sql);
          $ro=mysql_fetch_array($res_);
          @unlink(''.RepPhoto.'mins/'.$ro['image']);
          @unlink(''.RepPhoto.''.$ro['image']);
    
          $sql='update  '.PREFIXE_BDD.'articles set image="" where id_article="'.$_POST['id_article'].'"';
          mysql_query($sql);
    }    
  
      $upload=ProposePhoto($_FILES['image1']);
      if($upload!=false)
      { // on teste si image précédente
          $sql='select image from  '.PREFIXE_BDD.'articles where id_article="'.$id_article.'"';
          $res_=mysql_query($sql);
          $ro=mysql_fetch_array($res_);
          @unlink(''.RepPhoto.'mins/'.$ro['image']);
          @unlink(''.RepPhoto.''.$ro['image']);
    
          $sql='update  '.PREFIXE_BDD.'articles set image="" where id_article="'.$id_article.'"';
          mysql_query($sql);
      
      
          $sql='update '.PREFIXE_BDD.'articles set image="'.$upload.'" where id_article="'.$id_article.'"';
          mysql_query($sql);
      }
  }

?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"  enctype="multipart/form-data">
<?php
$sql='select privilege from '.PREFIXE_BDD.'membres where id_membre="'.$_SESSION['id_membre'].'" and privilege="1"';
            $res_=mysql_query($sql);
  if(mysql_num_rows($res_)==1)
  {
      if($_GET['rediger_article']!='' || isset($id_article))
      {
          if($_GET['rediger_article']!='')$id_article=(int)$_GET['rediger_article'];
      
          $sql='select * from '.PREFIXE_BDD.'articles where id_article="'.$id_article.'"';
          $res_article=mysql_query($sql);
          $row_article=mysql_fetch_array($res_article);
      }
      if((isset($row_article)  && $row_article['id_utilisateur']==$_SESSION['id_membre']) || (!isset($row_article)))
      {
      
      // le membre peut rédiger un article dans cet categorie
      $sql='';
      // on doit déterminer si sur cette page la redaction d'articles est autorisé :
      if(isset($_GET['spage']))
      {
        $sql='select * from '.PREFIXE_BDD.'pages where id_page="'.(int)$_GET['spage'].'"';
        $id_page=(int)$_GET['spage'];
      }
      else
      if(isset($_GET['page']))
       {
        $sql='select * from '.PREFIXE_BDD.'pages where id_page="'.(int)$_GET['page'].'"';
        $id_page=(int)$_GET['page'];
      }
      if($sql!='')
      {
        $res_=mysql_query($sql);
        $row_=mysql_fetch_array($res_);
        if($row_['autorisation_publication_articles']==1)
        {
           $_SESSION['language']=$language;
  
            // chaque membre avec privilege possede son dossier possede
            //nom du dossier avec email
            $sql='select * from '.PREFIXE_BDD.'membres where id_membre="'.$_SESSION['id_membre'].'"';
            $res_membre=mysql_query($sql);
            $row_membre=mysql_fetch_array($res_membre);
            //echo $row_membre['email'];
          
            $_SESSION['dossier_membre']='membres/'.$row_membre['id_membre'].'/';
            
            include 'tiny_mce/header_tiny_mce_client.php';
          ?>
          <b><?php echo REDIGER_UN_ARTICLE; ?></b>
          <br /><br />
          <?php echo ARTICLE_TITRE; ?> <input type="text" name="titre" style="boder:1px solid #000;width:250px;" value="<?php if(isset($row_article['titre'])) echo stripslashes($row_article['titre']); ?>">
          <br /><br />
          <?php echo ARTICLE_TEXTE_PRESENTATION; ?>
          <br /><br />
          <textarea name="content" style="height:300px;width:100%;"><?php
          if(isset($row_article['texte'])) echo stripslashes($row_article['texte']);
          ?></textarea>
          <br /><br />
          <?php echo ARTICLE_TEXTE_SUITE; ?>
          <br /><br />
          <textarea name="content2" style="height:300px;width:100%;"><?php
          if(isset($row_article['texte_suite'])) echo stripslashes($row_article['texte_suite']);
          ?></textarea>
          <br />
          <br />
          
          <?php echo IMAGE_PRESENTATION ?> <input type="file" name="image1">
          <br /><br />
          <?php
            if(isset($row_article['image']) && $row_article['image']!='')
            {
                ?>
                <img src="<?php echo RepPhoto.'mins/'.$row_article['image']; ?>" style="border:2px solid #fff;">
                <br />
                <input type="checkbox" name="delete_image"> Supprimer l'image<br /><br />
                <?php
            }
          ?>
          <br />
          <input type="submit" name="ENREGSITRER_ARTICLE" value="<?php echo FORM_VALIDER; ?>">
          <input type="hidden" name="id_page" value="<?php echo $id_page; ?>">
          <input type="hidden" name="id_article" value="<?php if(isset($_GET['rediger_article']) && $_GET['rediger_article']!=''){ echo (int)$_GET['rediger_article'];}else if(isset($id_article)) echo $id_article; ?>">
     <?php     
          
        }
      }
  }
  else
  {
      ?>
      <div style="color:red"><?php echo ARTICLE_MODIFICATION_INTERDITE; ?></div>
      <?php
  }
  }
  else
  {
      ?>
      <div style="color:red"><?php echo ARTICLE_MODIFICATION_INTERDITE; ?></div>
      <?php
  }
  
?>
 
</form>