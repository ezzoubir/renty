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
            $FileName='sp_'.time();
            $Rep='../'.RepPhoto;
            $ext='.'.$handle->file_src_name_ext;
            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>194)
            {
                //echo 'test';
                $handle->image_resize   = true;
                $handle->image_x        = 194;
                $handle->image_ratio_y  = true;
            } 
            $handle->process($Rep);

            
            $file=$FileName.$ext;
            return $file;
      }
      else return false;
    } 

if(isset($_POST['dell_image']))
{
      //$row_souspage['id_page']; 
      $id_page=GetImageButtonValue($_POST['dell_image']);
      $sql='select img from  '.PREFIXE_BDD.'pages where id_page="'.$id_page.'"';
      $res=mysql_query($sql);
      $ro=mysql_fetch_array($res);
      @unlink('../'.RepPhoto.$ro['img']);
      $sql='update '.PREFIXE_BDD.'pages set img=""  where id_page="'.$id_page.'"';
      mysql_query($sql);
}

if(isset($_POST['activate']))
{
     $sql='update  '.PREFIXE_BDD.'pages set autorisation_publication_articles=1 where id_page='.GetImageButtonValue($_POST['activate']);
    mysql_query($sql);
}
if(isset($_POST['desactivate']))
{
     $sql='update  '.PREFIXE_BDD.'pages set autorisation_publication_articles=0 where id_page='.GetImageButtonValue($_POST['desactivate']);
    mysql_query($sql);
}

if(isset($_POST['delete']))
{
    $id_page=GetImageButtonValue($_POST['delete']);
    
    // on recupere id parent
    $sql='select * from '.PREFIXE_BDD.'pages where parent_id="'. $id_page.'"';
    $res_=mysql_query($sql);
    while($row_=mysql_fetch_array($res_))
    {
        // on teste si image
        
        
        
        // supression des modules pouvant être present dans la page
        $sql='delete from '.PREFIXE_BDD.'module_to_page where id_page="'.$row_['id_page'].'"';
        mysql_query($sql);
        
        
    }
    
    $sql='delete from  '.PREFIXE_BDD.'pages where parent_id="'. $id_page.'"';
    mysql_query($sql);

      $sql='select img from '.PREFIXE_BDD.'pages where id_page="'. $id_page.'"';
      $res=mysql_query($sql);
      $ro=mysql_fetch_array($res);
      @unlink('../'.RepPhoto.$ro['img']);


$sql='select * from '.PREFIXE_BDD.'pages_photos where id_page="'. $id_page.'"';
$r=mysql_query($sql);
while($rooo=mysql_fetch_array($r))
{
    @unlink('../'.RepPhoto.$rooo['fichier']);
    @unlink('../'.RepPhoto.'mins/'.$rooo['fichier']);
}
$sql='delete from '.PREFIXE_BDD.'pages_photos where id_page="'. $id_page.'"';
mysql_query($sql);

    $sql='delete from  '.PREFIXE_BDD.'pages where id_page="'. $id_page.'"';
    mysql_query($sql);
    
    // on archive les articles associés
    $sql='update '.PREFIXE_BDD.'articles set id_page="0" where id_page="'.$id_page.'"';
    mysql_query($sql);
    
    
    // supression des modules pouvant être present dans la page
    $sql='delete from '.PREFIXE_BDD.'module_to_page where id_page="'.$id_page.'"';
    mysql_query($sql);

}

if(isset($_POST['add0']))
{
      //insertion page principal
      $sql='insert into '.PREFIXE_BDD.'pages (parent_id,titre,language) values("0","'.$_POST['titre_page'].'","'.$_POST['language'].'")';
      mysql_query($sql);

}
if(isset($_POST['add1']))
{
      $parent_id=GetImageButtonValue($_POST['add1']);
      //insertion page principal
      $sql='insert into '.PREFIXE_BDD.'pages (parent_id,titre,language) values("'.$parent_id.'","'.$_POST['titre_1'][$parent_id].'","'.$_POST['language'].'")';
      mysql_query($sql);

}
if(isset($_POST['save']))
{
    $id_page=GetImageButtonValue($_POST['save']);
    $sql='update '.PREFIXE_BDD.'pages set ordre_affichage="'.$_POST['ordre_affichage'][$id_page].'",titre="'.$_POST['titre'][$id_page].'" where id_page="'.$id_page.'"';
    mysql_query($sql);

    // on teste si image
    //img_sp
    
    
    $upload=ProposePhoto($_FILES['img_sp_'.$id_page]);
    if($upload!=false)
    {
    $sql='update '.PREFIXE_BDD.'pages set img="'.$upload.'" where id_page="'.$id_page.'"';
    mysql_query($sql);
    }
}

if(isset($_POST['add_article']))
{
     $id_page=GetImageButtonValue($_POST['add_article']);
     $sql='insert into '.PREFIXE_BDD.'articles (titre,id_page,date_publication,language) values("'.addslashes($_POST['article_titre'][$id_page]).'","'.$id_page.'","'.date('Y-m-d').'","'.$_POST['language'].'")';
     mysql_query($sql);

}
if(isset($_POST['delete_article']))
{
     $id_article=GetImageButtonValue($_POST['delete_article']);
 
 // on recupere image pour supprimer
    $sql='select image from '.PREFIXE_BDD.'articles where id_article="'.$id_article.'"';
    $res_image=mysql_query($sql);
    $ro_image=mysql_fetch_array($res_image);
    @unlink('../'.RepPhoto.'mins/'.$ro_image['image']);
    @unlink('../'.RepPhoto.''.$ro_image['image']);


    $sql='delete from '.PREFIXE_BDD.'articles where id_article="'.$id_article.'"';
    mysql_query($sql);
}
if(isset($_POST['save_article']))
{
    $id_article=GetImageButtonValue($_POST['save_article']);
    $sql='update '.PREFIXE_BDD.'articles set titre="'.addslashes($_POST['article'][$id_article]).'",ordre_affichage="'.$_POST['article_ordre_affichage'][$id_article].'",date_modification="'.date('Y-m-d').'" where id_article="'.$id_article.'"';
    mysql_query($sql);
  
}
if(isset($_POST['archive_article']))
{
    $id_article=GetImageButtonValue($_POST['archive_article']);
    $sql='update '.PREFIXE_BDD.'articles set id_page="0" where id_article="'.$id_article.'"';
    mysql_query($sql);

}


$sql='select * from '.PREFIXE_BDD.'languages where symbol="'.$_GET['language'].'"';
$res_language=mysql_query($sql);
if(mysql_num_rows($res_language)>0)
{

$row_language=mysql_fetch_array($res_language);
?>
<h1>Gestion de contenu <?php echo $row_language['symbol']; ?></h1>


<?php
if(GESTION_CONTENU_NIVEAU_1)
{
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <th></th>
      <th colspan="2" style="text-align:left;">Ajouter une page</th>
    </tr>
    <tr>
      <th width="200">Titre page  <?php echo $row_language['symbol']; ?></th><td style="text-align:left;"><input type="text" name="titre_page" style="width:300px;"></td>
      <td><input type="image" name="add0[]" src="imgs/Add2.gif" /></td>
    </tr>
  </table>
  <input type="hidden" name="parent_id" value="0">
  <input type="hidden" name="language" value="<?php echo $row_language['symbol']; ?>">
</form>

<?php
}
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"  enctype="multipart/form-data">
<?php
// liste des pages principales
$sql='select * from '.PREFIXE_BDD.'pages where language="'.$row_language['symbol'].'" and parent_id="0" order by ordre_affichage,id_page';
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
      <th><?php if(GESTION_CONTENU_NIVEAU_1 || GESTION_CONTENU_NIVEAU_2) echo 'Ordre d\'affichage'; ?></th>
      <th>Fonction(s)</th>
    </tr>
    <?php
      while($row_page=mysql_fetch_array($res_pages))
      {
        if(GESTION_CONTENU_NIVEAU_1)
        {
        ?>
         
          <tr>
            <td style="text-align:left;"><input type="text" name="titre[<?php echo $row_page['id_page']; ?>]" value="<?php echo stripslashes($row_page['titre']); ?>"  style="width:300px;" /></td>
             <?php
              if(PUBLICATION_ARTICLES)
              {
              ?>
             <td style="text-align:center;">
             <?php
                    if($row_page['autorisation_publication_articles']==1) echo '<img src="imgs/icon_status_green.gif" border="0" style="margin-left:5px;">';else echo '<input type="image" name="activate['.$row_page['id_page'].']" src="imgs/icon_status_green_light.gif" style="margin-left:5px;">';
                    if($row_page['autorisation_publication_articles']==0) echo '<img src="imgs/icon_status_red.gif" style="margin-left:5px;" border="0" style="margin-left:25px;">';else echo '<input type="image" name="desactivate['.$row_page['id_page'].']" src="imgs/icon_status_red_light.gif" style="margin-left:5px;">';
            ?>
            </td>
            <?php 
            }
            ?>
            <td style=""><input type="text" style="width:30px;" name="ordre_affichage[<?php echo $row_page['id_page']; ?>]" value="<?php echo $row_page['ordre_affichage']; ?>"></td>
            <td style="">
            
            <input type="image" name="save[<?php echo $row_page['id_page']; ?>]" src="imgs/floppy_disk16.gif">
            <a href="index.php?action=gestion_contenu_modifier&id_page=<?php echo $row_page['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
            <input style="margin-left:10px;" type="image" name="delete[<?php echo $row_page['id_page']; ?>]" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row_page['titre']); ?>  ?')){this.submit();} else return false;">
            </td>
          </tr>
          <?php
                
                  if(PUBLICATION_ARTICLES && $row_page['autorisation_publication_articles']==1)
                  {
                    // on recupere les articles de la page
                    $sql='select * from '.PREFIXE_BDD.'articles where id_page="'.$row_page['id_page'].'" order by ordre_affichage,id_article';
                    $res_articles=mysql_query($sql);
                   
                    ?>
                          
                           <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;height:10px;"></td>
                          </tr>
                          <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;border-top:1px dashed #f60000;">Article(s)</td>
                          </tr>
                        
                            <tr>
                              <td style="font-size:12px;text-align:left;padding-left:35px;text-decoration:underline;color:#f60000" width="65"><input type="text" name="article_titre[<?php echo $row_page['id_page'];  ?>]" style="font-size:10px;width:250px;border:1px solid #f60000"></td>
                              <td style="text-align:left;" <?php if(PUBLICATION_ARTICLES) echo 'colspan="3"'; else echo 'colspan="2"'; ?>><input type="image" name="add_article[<?php echo $row_page['id_page'];  ?>]" src="imgs/Add.gif" /></td>
                             
                            </tr>
                            
                            <?php
                              while($row_article=mysql_fetch_array($res_articles))
                              {
                                  ?>
                                    <tr>
                                      <td style="text-align:left;padding-left:50px;font-size:11px;color:#f60000">
                                     
                                      <input type="text" name="article[<?php echo $row_article['id_article']; ?>]" style="border:1px solid #f60000;font-size:11px;width:205px;" value="<?php echo stripslashes($row_article['titre']); ?>">
                                      </td>
                                      <?php
                                      if(PUBLICATION_ARTICLES)
                                      {
                                        ?>
                                        <td style="color:#f60000;">
                                        Publié par 
                                        <?php
                                          if($row_article['id_utilisateur']==0) echo  'Admin';
                                          else
                                          {
                                              // on recupere email
                                              $sql='select * from  '.PREFIXE_BDD.'membres where id_membre="'.$row_article['id_utilisateur'].'"';
                                              $res_membre=mysql_query($sql);
                                              if(mysql_num_rows($res_membre)>0)
                                              {
                                                $row_membre=mysql_fetch_array($res_membre);
                                                echo stripslashes($row_membre['prenom'].'-'.$row_membre['nom'].' / '.$row_membre['email']);
                                              }
                                              else
                                              {
                                                echo 'Ancien membre (supprimé de la base de données).';
                                              }
                                          }
                                        ?>
                                        <br /> Date publication : <?php echo  ConvertDateToFr($row_article['date_publication']); ?>
                                        </td>
                                        <?php
                                      }
                                      ?>
                                      <td>
                                      <input type="text" name="article_ordre_affichage[<?php echo $row_article['id_article']; ?>]" style="border:1px solid #f60000;font-size:11px;width:30px;" value="<?php echo stripslashes($row_article['ordre_affichage']); ?>">
                                      </td>
                                      <td>
                                      <input type="image" name="save_article[<?php echo $row_article['id_article']; ?>]" src="imgs/floppy_disk16.gif" height="12">
                                      <a href="index.php?action=gestion_article_modifier&id_article=<?php echo $row_article['id_article']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  
                                      <input style="margin-left:10px;" type="image" name="delete_article[<?php echo $row_article['id_article']; ?>]" height="12" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row_article['titre']); ?>  ?')){this.submit();} else return false;">
                                      <input type="image" name="archive_article[<?php echo $row_article['id_article']; ?>]" src="imgs/param.gif" style="margin-left:20px;" title="Archiver" onclick="javascript: if(confirm('Attention vous allez archiver l\'article <?php echo addslashes($row_article['titre']); ?>. Etes vous sûre  ?')){this.submit();} else return false;">
                                      </td>
                                     
                                      
                                    </tr>
                                  <?php
                              }
                            ?>
                         
                        <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;border-bottom:1px dashed #f60000;"> </td>
                          </tr>
                          <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;height:10px;"></td>
                          </tr>
                      
                    <?php
                    
                  }
                ?>
        <?php
        }
        else
        {
          ?>
        <tr>
            <td style="text-align:left;"><?php echo stripslashes($row_page['titre']); ?></td>
            <td style=""></td>
            <?php
              if(PUBLICATION_ARTICLES)
              {
              ?>
            <td style=""></td>
            <?php
            }
            ?>
            <td style="">
            <a href="index.php?action=gestion_contenu_modifier&id_page=<?php echo $row_page['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0"  /></a>
            </td>
          </tr>
          <?php
        }
        ?>
          <?php
            
            // on recupere les sous pages
            $sql='select * from  '.PREFIXE_BDD.'pages where parent_id="'.$row_page['id_page'].'" order by ordre_affichage,id_page';
            $res_souspage=mysql_query($sql);
            while($row_souspage=mysql_fetch_array($res_souspage))
            {
              if(GESTION_CONTENU_NIVEAU_2)
              {
                ?>
                <tr>
                  <td style="text-align:left;padding-left:25px;">
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                  <tr>
                  
                    <td style="text-align:left;">
                    <b>-</b><input style="font-size:11px;width:250px;" type="text" name="titre[<?php echo $row_souspage['id_page']; ?>]" value="<?php echo stripslashes($row_souspage['titre']); ?>"> </td>
                    </td>
                    <?php
                    if(GESTION_CONTENU_NIVEAU_2_IMAGES)
                    {
                    $sql_image='select img from '.PREFIXE_BDD.'pages where id_page="'.$row_souspage['id_page'].'"';
                        $res_image=mysql_query($sql_image);
                        $row_image=mysql_fetch_array($res_image);
                         if($row_image['img']=='')
                        {
                        ?>
                          <td width="150" style="text-align:left;"><input type="file" name="img_sp_<?php echo $row_souspage['id_page']; ?>" style="font-size:10px;"></td>
                        
                        <?php
                        }
                        else
                        {
                          ?>
                            <td style="text-align:left;" width="150">
                              <a href="<?php echo '../'.RepPhoto.$row_image['img']; ?>" target="_blank"><img src="<?php echo '../'.RepPhoto.$row_image['img']; ?>" width="63" height="65" border="0"></a><br />
                              <input type="submit" name="dell_image[<?php echo $row_souspage['id_page']; ?>]" value="supprimer" style="font-size:10px;border:1px solid #000;" onclick="javascript: if(confirm('Supprimer l\'image de <?php echo addslashes($row_souspage['titre']); ?>  ?')){this.submit();} else return false;">
                            </td>
                          <?php
                        }
                        
                    }
                    else
                    {
                      ?>
                      <input type="hidden" name="img_sp_<?php echo $row_souspage['id_page']; ?>">
                      <?php
                    }
                  ?>
                  </tr>
                  </table>
                  <?php
                  if(PUBLICATION_ARTICLES)
                  {
                  ?>
                  <td style="text-align:center;">
                    <?php
                    if($row_souspage['autorisation_publication_articles']==1) echo '<img src="imgs/icon_status_green.gif" border="0" style="margin-left:5px;" height="8" >';else echo '<input type="image" name="activate['.$row_souspage['id_page'].']" src="imgs/icon_status_green_light.gif" style="margin-left:5px;height:8px;">';
                    if($row_souspage['autorisation_publication_articles']==0) echo '<img src="imgs/icon_status_red.gif" style="margin-left:5px;" border="0" height="8" style="margin-left:25px;">';else echo '<input type="image" name="desactivate['.$row_souspage['id_page'].']" src="imgs/icon_status_red_light.gif" style="margin-left:5px;height:8px;">';
                    ?>
                  </td>
                  <?php
                  }
                  ?>
                  <td><input type="text" style="width:30px;font-size:11px;" name="ordre_affichage[<?php echo $row_souspage['id_page']; ?>]" value="<?php echo $row_souspage['ordre_affichage']; ?>"></td>
                  
                  <td>
                  <input type="image" name="save[<?php echo $row_souspage['id_page']; ?>]" src="imgs/floppy_disk16.gif" height="12">
                  <a href="index.php?action=gestion_contenu_modifier&id_page=<?php echo $row_souspage['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  <input style="margin-left:10px;" type="image" name="delete[<?php echo $row_souspage['id_page']; ?>]" height="12" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row_souspage['titre']); ?>  ?')){this.submit();} else return false;">
            
                  </td>
                </tr>
                <?php
                
                  if(PUBLICATION_ARTICLES && $row_souspage['autorisation_publication_articles']==1)
                  {
                    // on recupere les articles de la page
                    $sql='select * from '.PREFIXE_BDD.'articles where id_page="'.$row_souspage['id_page'].'" order by ordre_affichage,id_article';
                    $res_articles=mysql_query($sql);
                   
                    ?>
                          
                           <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;height:10px;"></td>
                          </tr>
                          <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;border-top:1px dashed #f60000;">Article(s)</td>
                          </tr>
                        
                            <tr>
                              <td style="font-size:12px;text-align:left;padding-left:35px;text-decoration:underline;color:#f60000" width="65"><input type="text" name="article_titre[<?php echo $row_souspage['id_page'];  ?>]" style="font-size:10px;width:250px;border:1px solid #f60000"></td>
                              <td style="text-align:left;" <?php if(PUBLICATION_ARTICLES) echo 'colspan="3"'; else echo 'colspan="2"'; ?>><input type="image" name="add_article[<?php echo $row_souspage['id_page'];  ?>]" src="imgs/Add.gif" /></td>
                             
                            </tr>
                            
                            <?php
                              while($row_article=mysql_fetch_array($res_articles))
                              {
                                  ?>
                                    <tr>
                                      <td style="text-align:left;padding-left:50px;font-size:11px;color:#f60000">
                                     
                                      <input type="text" name="article[<?php echo $row_article['id_article']; ?>]" style="border:1px solid #f60000;font-size:11px;width:205px;" value="<?php echo stripslashes($row_article['titre']); ?>">
                                      </td>
                                      <?php
                                      if(PUBLICATION_ARTICLES)
                                      {
                                        ?>
                                        <td style="color:#f60000;">
                                        Publié par 
                                        <?php
                                          if($row_article['id_utilisateur']==0) echo  'Admin';
                                          else
                                          {
                                              // on recupere email
                                              $sql='select * from  '.PREFIXE_BDD.'membres where id_membre="'.$row_article['id_utilisateur'].'"';
                                              $res_membre=mysql_query($sql);
                                              if(mysql_num_rows($res_membre)>0)
                                              {
                                                $row_membre=mysql_fetch_array($res_membre);
                                                echo stripslashes($row_membre['prenom'].'-'.$row_membre['nom'].' / '.$row_membre['email']);
                                              }
                                              else
                                              {
                                                echo 'Ancien membre (supprimé de la base de données).';
                                              }
                                          }
                                        ?>
                                        <br /> Date publication : <?php echo  ConvertDateToFr($row_article['date_publication']); ?>
                                        </td>
                                        <?php
                                      }
                                      ?>
                                      <td>
                                      <input type="text" name="article_ordre_affichage[<?php echo $row_article['id_article']; ?>]" style="border:1px solid #f60000;font-size:11px;width:30px;" value="<?php echo stripslashes($row_article['ordre_affichage']); ?>">
                                      </td>
                                      <td>
                                      <input type="image" name="save_article[<?php echo $row_article['id_article']; ?>]" src="imgs/floppy_disk16.gif" height="12">
                                      <a href="index.php?action=gestion_article_modifier&id_article=<?php echo $row_article['id_article']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  
                                      <input style="margin-left:10px;" type="image" name="delete_article[<?php echo $row_article['id_article']; ?>]" height="12" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer <?php echo addslashes($row_article['titre']); ?>  ?')){this.submit();} else return false;">
                                      <input type="image" name="archive_article[<?php echo $row_article['id_article']; ?>]" src="imgs/param.gif" style="margin-left:20px;" title="Archiver" onclick="javascript: if(confirm('Attention vous allez archiver l\'article <?php echo addslashes($row_article['titre']); ?>. Etes vous sûre  ?')){this.submit();} else return false;">
                                      </td>
                                     
                                      
                                    </tr>
                                  <?php
                              }
                            ?>
                         
                        <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;border-bottom:1px dashed #f60000;"> </td>
                          </tr>
                          <tr>
                            <td <?php if(PUBLICATION_ARTICLES) echo 'colspan="4"'; else echo 'colspan="3"'; ?> style="text-decoration:underline;color:#f60000;text-align:left;padding-left:35px;height:10px;"></td>
                          </tr>
                      
                    <?php
                    
                  }
                ?>
                <?php
              }
              else
              {
              ?>
                <tr>
                  <td style="text-align:left;padding-left:25px;"><b>-</b> <?php echo stripslashes($row_souspage['titre']); ?> </td>
                  <?php
                  if(PUBLICATION_ARTICLES)
                  {
                  ?>
                  <td></td>
                  <?php
                  }
                  ?>
                  <td style=""></td>
                  <td>
                  <a href="index.php?action=gestion_contenu_modifier&id_page=<?php echo $row_souspage['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  
                  </td>
                </tr>
              <?php
              }
            }
            if(GESTION_CONTENU_NIVEAU_2)
            {
          ?>
           <tr>
            <th colspan="<?php
              if(PUBLICATION_ARTICLES)
              {
              ?>4<?php }else echo '3';?>" style="border-bottom:2px solid #000;text-align:left;padding-left:50px;font-size:11px;">
            Ajouter une sous page<input type="text" name="titre_1[<?php echo $row_page['id_page']; ?>]" style="width:250px;font-size:11px;margin-left:50px;"><input type="image" name="add1[<?php echo $row_page['id_page']; ?>]" src="imgs/Add.gif" style="margin-left:30px;" /></th>
          </tr>
        <?php
          }
          else
          {
            ?>
              <tr>
            <th colspan="<?php
              if(PUBLICATION_ARTICLES)
              {
              ?>4<?php }else echo '3';?>" style="border-bottom:2px solid #000;text-align:left;padding-left:50px;font-size:11px;"></th></tr>
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