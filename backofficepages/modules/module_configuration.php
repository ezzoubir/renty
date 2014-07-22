<?php
if(isset($_POST['save']))
  {
  
  include '../class/upload.class.inc.php';
function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded && $handle->file_is_image) 
        {
            $FileName='photo_accueil_'.time();
            $Rep='../'.RepPhoto;
            $Rep2='../'.RepPhoto.'mins';
            $ext='.'.$handle->file_src_name_ext;
            $handle->file_new_name_body  = $FileName;
            //if($handle->image_src_x>1000)
           // {
                 $handle->image_resize         = true;
                 $handle->image_x             =1000;
                 $handle->image_ratio_y        = true;
           //   } 
            $handle->process($Rep);
            $handle->file_new_name_body  = $FileName;
            if($handle->image_src_x>350)
            {
                 $handle->image_resize         = true;
                 $handle->image_x             =350;
                 
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


  
  
      $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['Email_exp']).'" where config_name="Email_exp"';
      mysql_query($sql);
      
      $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['Email_dest1']).'" where config_name="Email_admin1"';
      mysql_query($sql);
      
      $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['Email_dest2']).'" where config_name="Email_admin2"';
      mysql_query($sql);
      
      if(isset($_POST['Email_paiement_en_ligne']))
      {
      $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['Email_paiement_en_ligne']).'" where config_name="Email_paiement_en_ligne"';
      mysql_query($sql);
      }
        
       if(isset($_POST['lien_facebook']))
       {
       $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['lien_facebook']).'" where config_name="lien_facebook"';
      mysql_query($sql);
       
       } 
       if(isset($_POST['lien_twitter']))
       {
       $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['lien_twitter']).'" where config_name="lien_twitter"';
      mysql_query($sql);
       
       } 
       if(isset($_POST['lien_webmail']))
       {
       $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['lien_webmail']).'" where config_name="lien_webmail"';
      mysql_query($sql);
       
       } 
       
       if(isset($_POST['txt_pied_page']))
       {
       $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['txt_pied_page']).'" where config_name="txt_pied_page"';
      mysql_query($sql);
       }
        if(isset($_POST['lien_boutique']))
       {
       $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['lien_boutique']).'" where config_name="lien_boutique"';
      mysql_query($sql);
       }
       
       //lien_video
       if(isset($_POST['lien_video']))
       {
       $sql='update '.PREFIXE_BDD.'config set config_value="'.stripslashes($_POST['lien_video']).'" where config_name="lien_video"';
      mysql_query($sql);
       }
       
       if(isset($_POST['supprimer_photo']))
       {
       // on teste si ancienne image 
            $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_image"';
            $res=mysql_query($sql);
            $row=mysql_fetch_array($res);
            if($row['config_value']!='')
            {
                @unlink('../'.RepPhoto.$row['config_value']);
                 @unlink('../'.RepPhoto.'mins/'.$row['config_value']);
            }
       
             $sql='update '.PREFIXE_BDD.'config set config_value="" where config_name="config_simple_image"';
            mysql_query($sql);
       }
       
       
       $upload=ProposePhoto($_FILES['config_simple_image']);
       if($upload!=false)
       {
            // on teste si ancienne image 
            $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_image"';
            $res=mysql_query($sql);
            $row=mysql_fetch_array($res);
            if($row['config_value']!='')
            {
                @unlink('../'.RepPhoto.$row['config_value']);
                 @unlink('../'.RepPhoto.'mins/'.$row['config_value']);
            }
            
            $sql='update '.PREFIXE_BDD.'config set config_value="'.$upload.'" where config_name="config_simple_image"';
            mysql_query($sql);
       
       }
       
        $upload2=ProposeFichier($_FILES['config_simple_fichier']);
       if($upload2!=false)
       {
            // on teste si ancienne image 
            $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_fichier"';
            $res=mysql_query($sql);
            $row=mysql_fetch_array($res);
            if($row['config_value']!='')
            {
                @unlink('../'.RepPhoto.$row['config_value']);
                
            }
            
            $sql='update '.PREFIXE_BDD.'config set config_value="'.$upload2.'" where config_name="config_simple_fichier"';
            mysql_query($sql);
       
       }
       
              
       if(isset($_POST['supprimer_fichier']))
       {
       // on teste si ancienne image 
            $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_fichier"';
            $res=mysql_query($sql);
            $row=mysql_fetch_array($res);
            if($row['config_value']!='')
            {
                @unlink('../'.RepPhoto.$row['config_value']);
                
            }
       
             $sql='update '.PREFIXE_BDD.'config set config_value="" where config_name="config_simple_fichier"';
            mysql_query($sql);
       }
  }
?>
<h1>Configuration</h1>
<form name="form1" id='form1' action="index.php?action=config" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <th style="text-align:left;" width="250">Email expéditeur </th>
    <td style="text-align:left;"><input type="text" name="Email_exp" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_exp"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
  <tr>
    <th style="text-align:left;">Email destinataire 1 </th>
    <td style="text-align:left;"><input type="text" name="Email_dest1" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_admin1"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
  <tr>
    <th style="text-align:left;">Email destinataire 2 </th>
    <td style="text-align:left;"><input type="text" name="Email_dest2" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_admin2"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
  <?php
    if(EMAIL_PAIEMENT_EN_LIGNE)
    {
    ?>
    
      <tr>
    <th style="text-align:left;">Email Paypal </th>
    <td style="text-align:left;"><input type="text" name="Email_paiement_en_ligne" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_paiement_en_ligne"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    
    <?php
    }
    if(config_lien_facebook)
    {
        ?>
    
      <tr>
    <th style="text-align:left;">Lien facebook </th>
    <td style="text-align:left;"><input type="text" name="lien_facebook" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_facebook"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    
    <?php
    }
        
    if(config_lien_twitter)
    {
        ?>
    
      <tr>
    <th style="text-align:left;">Lien Twitter </th>
    <td style="text-align:left;"><input type="text" name="lien_twitter" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_twitter"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    
    <?php
    }
    if(config_lien_boutique)
    {
    ?>
     <tr>
    <th style="text-align:left;">Lien Viadeo </th>
    <td style="text-align:left;"><input type="text" name="lien_boutique" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_boutique"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    <?php
    }
    if(config_lien_webmail)
    {
        ?>
    
      <tr>
    <th style="text-align:left;">Lien linkedin</th>
    <td style="text-align:left;"><input type="text" name="lien_webmail" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_webmail"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    
    <?php
    }
  ?>
  <?php
    if(config_texte_pied_page)
    {
    ?>
    
      <tr>
    <th style="text-align:left;">Pied de page</th>
    <td style="text-align:left;"><input type="text" name="txt_pied_page" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="txt_pied_page"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    
    <?php
    
    }
  ?>
  <?php
    if(config_simple_image)
    {
        ?>
    
      <tr>
    <th style="text-align:left;">Image accueil</th>
    <td style="text-align:left;"><input type="file" name="config_simple_image" style="width:350px;">
    <?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_image"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      //echo stripslashes($row['config_value']);
      if($row['config_value']!='')
      {
          ?><br /><br />
            <img src="<?php echo '../'.RepPhoto.'mins/'.$row['config_value']; ?>" width="150"><br />
            <input type="checkbox" name="supprimer_photo"> Supprimer la photo
          <?php
      }
    ?><br /><br /></td>
  </tr>
    
    <?php
    
    }
  
  ?>
    <?php
    if(config_simple_fichier)
    {
        ?>
    
      <tr>
    <th style="text-align:left;">Fichier qualification</th>
    <td style="text-align:left;"><input type="file" name="config_simple_fichier" style="width:350px;">
    <?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="config_simple_fichier"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      //echo stripslashes($row['config_value']);
      if($row['config_value']!='')
      {
          ?><br /><br />
            <a href="<?php echo '../'.RepPhoto.''.$row['config_value']; ?>" target="_blank">Fichier</a><br />
            <input type="checkbox" name="supprimer_fichier"> Supprimer le fichier
          <?php
      }
    ?><br /><br /></td>
  </tr>
    
    <?php
    
    }
  
  ?>
  <?php
    if(config_simple_video)
    {
    ?>
    
      <tr>
    <th style="text-align:left;">Lien vidéo</th>
    <td style="text-align:left;"><input type="text" name="lien_video" style="width:350px;" value="<?php
      $sql='select config_value from '.PREFIXE_BDD.'config where config_name="lien_video"';
      $res=mysql_query($sql);
      $row=mysql_fetch_assoc($res);
      echo stripslashes($row['config_value']);
    ?>"></td>
  </tr>
    
    <?php
    
    }
  ?>
  <tr>
    <td style="background:#ccc;"></td>
    <td style="text-align:left;"><input type="submit" name="save" value="Enregistrer"></td>
  </tr>
</table>
</form>