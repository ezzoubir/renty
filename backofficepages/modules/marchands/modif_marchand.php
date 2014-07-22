<?php
include '../class/upload.class.inc.php';
function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded) 
        {
            $FileName='logo_marchand_'.time();
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
	
	function ProposeFichier($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded) 
        {
            $FileName='video_'.$_POST['marchand'].'_'.time();
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
	
	if(isset($_POST['supprimer_logo']))
       {
       // on teste si ancienne image 
            $sql='select logo from marchands where id="'.$_POST['id'].'"';
            $res=mysql_query($sql);
            $row=mysql_fetch_array($res);
            if($row['logo']!='')
            {
                @unlink('../'.RepPhoto.$row['logo']);
                 @unlink('../'.RepPhoto.'mins/'.$row['logo']);
            }
       
             $sql='update marchands set logo="" where id="'.$_POST['id'].'"';
            mysql_query($sql);
       }
	if(isset($_POST['del_image']))
{
    $id_photo=GetImageButtonValue($_POST['del_image']);
    $sql='select photo from photos where id_photo="'.$id_photo.'"';
    $r=mysql_query($sql);
    $roo=mysql_fetch_array($r);
    @unlink(RepPhoto.'mins/'.$roo['photo']);
    @unlink(RepPhoto.''.$roo['photo']);
    
    $sql='delete from photos where id_photo="'.$id_photo.'"';
    mysql_query($sql);
}
	if(isset($_POST['modifier']))
  {
  
	$sql='update marchands set marchand="'.$_POST['marchand'].'",
		presentation="'.$_POST['presentation'].'",
		slug="'.$_POST['slug'].'",
		url="'.$_POST['url'].'",
		responsable="'.$_POST['responsable'].'",
		responsable_email="'.$_POST['responsable_email'].'",
		responsable_mobile="'.$_POST['responsable_mobile'].'",
		tel="'.$_POST['tel'].'",
		email="'.$_POST['email'].'",
		adresse="'.$_POST['adresse'].'",
		message="'.$_POST['message'].'",
		site="'.$_POST['site'].'",
		reduction="'.$_POST['reduction'].'",
		facebook="'.$_POST['facebook'].'",
		twitter="'.$_POST['twitter'].'",
		youtube="'.$_POST['youtube'].'",
		pinterest="'.$_POST['pinterest'].'",
		linkedin="'.$_POST['linkedin'].'",
		id_ville="'.$_POST['ville'].'",
		id_cat="'.$_POST['cat'].'" where id="'.$_POST['id'].'"';
		
	mysql_query($sql);
	
	@$uploadlogo=ProposePhoto($_FILES['logo']);
	if($uploadlogo!=false)
		{
			  $sql='update marchands set logo="'.$uploadlogo.'" where id="'.$_POST['id'].'"';
			  mysql_query($sql);
	}
	
	@$uploadfile=ProposeFichier($_FILES['fichier']);
	if($uploadfile!=false)
		{
			  $sql='update marchands set fichier="'.$uploadfile.'" where id="'.$_POST['id'].'"';
			  mysql_query($sql);
	}
	
	@$upload=ProposePhoto($_FILES['photo']);
    if($upload!=false)
    {
          $sql='insert into photos (id_marchand,photo) values("'.$_POST['id'].'","'.$upload.'")';
          mysql_query($sql);
    
    }
	
	
	
	$msg='<script>alert("Les données ont été modifié avec succès")</script>';
  }
  
  $sd='select * from marchands where id="'.$_GET['id'].'"';
  $fg=mysql_query($sd);
  $dr=mysql_fetch_assoc($fg);
?>
<h2>Ajouter une marchand</h2>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>marchand</td><td><input type="text" name="marchand" value="<?php echo $dr['marchand']; ?>" /></td></tr>
		<tr><td>Slug</td><td><input type="text" name="slug" value="<?php echo $dr['slug']; ?>" /></td></tr>
		<tr><td>Logo</td><td>
		<?php if($dr['logo']!='') { ?>
		<a href="<?php echo BASE_URL.RepPhoto.$dr['logo']; ?>"><img src="../images/photos/<?php echo $dr['logo']; ?>" height="110" width="200" style="border:2px solid #ccc;" /></a>
		<input type="checkbox" name="supprimer_logo"> Supprimer le logo
		<?php } else { ?>
		<input type="file" name="logo" />
		<?php } ?></td></tr>
		<tr><td>Présentation</td><td><textarea cols="15" rows="3" name="presentation"><?php echo $dr['presentation']; ?></textarea></td></tr>
		<tr><td>Video (fichier)</td><td><input type="file" name="fichier" value="" /></td></tr>
		<tr><td>Video (url)</td><td><input type="text" name="url" value="<?php echo $dr['url']; ?>" /></td></tr>
		<tr><td>Responsable</td><td><input type="text" name="responsable" value="<?php echo $dr['responsable']; ?>" /></td></tr>
		<tr><td>Email (Responsable)</td><td><input type="text" name="responsable_email" value="<?php echo $dr['responsable_email']; ?>" /></td></tr>
		<tr><td>Mobile (Responsable)</td><td><input type="text" name="responsable_mobile" value="<?php echo $dr['responsable_mobile']; ?>" /></td></tr>
		<tr><td>Tél</td><td><input type="text" name="tel" value="<?php echo $dr['tel']; ?>" /></td></tr>
		<tr><td>email</td><td><input type="text" name="email" value="<?php echo $dr['email']; ?>" /></td></tr>
		<tr><td>Adresse</td><td><input type="text" name="adresse" value="<?php echo $dr['adresse']; ?>" /></td></tr>
		<tr><td>Web site</td><td><input type="text" name="site" value="<?php echo $dr['site']; ?>" /></td></tr>
		<tr><td>Réduction</td><td><input type="text" name="reduction" value="<?php echo $dr['reduction']; ?>" /></td></tr>
		<tr><td>Map</td><td><textarea name="message"><?php echo $dr['message']; ?></textarea></td></tr>
		<tr><td>Ville</td><td><select name="ville">
		<option value=""></option>
		<?php
			$sq='select * from villes order by ville asc';
			$rq=mysql_query($sq);
			while($dt=mysql_fetch_array($rq)){
		?>
		<option value="<?php echo $dt['id']; ?>" <?php if($dr['id_ville']==$dt['id']) { echo 'selected';} ?>><?php echo $dt['ville']; ?></option>
		<?php } ?>
		</select></td></tr>
		<tr><td>cat</td><td><select name="cat">
		<option value=""></option>
		<?php
			$sq='select * from categories order by cat asc';
			$rq=mysql_query($sq);
			while($dt=mysql_fetch_array($rq)){
		?>
		<option value="<?php echo $dt['id']; ?>" <?php if($dr['id_cat']==$dt['id']) { echo 'selected';} ?>><?php echo $dt['cat']; ?></option>
		<?php } ?>
		</select></td></tr>
		<tr><td>Facebook</td><td><input type="text" name="facebook" value="<?php echo $dr['facebook']; ?>" /></td></tr>
		<tr><td>Twitter</td><td><input type="text" name="twitter" value="<?php echo $dr['twitter']; ?>" /></td></tr>
		<tr><td>Youtube</td><td><input type="text" name="youtube" value="<?php echo $dr['youtube']; ?>" /></td></tr>
		<tr><td>Pinterest</td><td><input type="text" name="pinterest" value="<?php echo $dr['pinterest']; ?>" /></td></tr>
		<tr><td>Linkedin</td><td><input type="text" name="linkedin" value="<?php echo $dr['linkedin']; ?>" /></td></tr>
		<tr><td></td><td><input type="submit" name="modifier" value="Modifier" /></td></tr>
</table>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
</form>
<?php
	if(isset($msg)) {
		echo $msg;
	}
?>
	