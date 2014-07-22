<?php
include '../class/upload.class.inc.php';
function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded) 
        {
            $FileName='logo_'.time();
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
	
	if(isset($_POST['ajouter']))
  {
  
	@$uploadlogo=ProposePhoto($_FILES['logo']);
	
	$uploadfile=ProposeFichier($_FILES['fichier']);
	if($uploadfile!=false){
	$uploadfile=ProposeFichier($_FILES['fichier']);
	}else{
	$uploadfile="Null";
	}
	$slug = strtolower(str_replace(" ", "-", $_POST['marchand']));
	$sql='insert into marchands (marchand,slug,logo,presentation,fichier,url,responsable,responsable_email,responsable_mobile,tel,email,reduction,adresse,site,id_ville,id_cat,message,facebook,twitter,youtube,pinterest,linkedin,date_creation) 
			values 
		  ("'.$_POST['marchand'].'","'.$slug.'","'.$uploadlogo.'","'.$_POST['presentation'].'","'.$uploadfile.'","'.$_POST['url'].'","'.$_POST['responsable'].'","'.$_POST['responsable_email'].'","'.$_POST['responsable_mobile'].'","'.$_POST['tel'].'","'.$_POST['email'].'","'.$_POST['reduction'].'","'.$_POST['adresse'].'","'.$_POST['site'].'","'.$_POST['ville'].'","'.$_POST['cat'].'","'.$_POST['message'].'","'.$_POST['facebook'].'","'.$_POST['twitter'].'","'.$_POST['youtube'].'","'.$_POST['pinterest'].'","'.$_POST['linkedin'].'","'.date('Y-m-d').'")';
		  
	mysql_query($sql);
	
	$msg='<script>alert("Les données ont été enregistré avec succès")</script>';
  }
?>
<h2>Ajouter une marchand</h2>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>marchand</td><td><input type="text" name="marchand" value="" /></td></tr>
		<tr><td>Logo</td><td><input type="file" name="logo" value="" /></td></tr>
		<tr><td>Présentation</td><td><textarea cols="20" rows="3" name="presentation"></textarea></td></tr>
		<tr><td>Video (fichier)</td><td><input type="file" name="fichier" value="" /></td></tr>
		<tr><td>Video (url)</td><td><input type="text" name="url" value="" /></td></tr>
		<tr><td>Responsable</td><td><input type="text" name="responsable" value="" /></td></tr>
		<tr><td>Email (Responsable)</td><td><input type="text" name="responsable_email" value="" /></td></tr>
		<tr><td>Mobile (Responsable)</td><td><input type="text" name="responsable_mobile" value="" /></td></tr>
		<tr><td>Tél</td><td><input type="text" name="tel" value="" /></td></tr>
		<tr><td>email</td><td><input type="text" name="email" value="" /></td></tr>
		<tr><td>Adresse</td><td><input type="text" name="adresse" value="" /></td></tr>
		<tr><td>Web site</td><td><input type="text" name="site" value="" /></td></tr>		
		<tr><td>Réduction</td><td><input type="text" name="reduction" value="" /></td></tr>
		<tr><td>Map</td><td><textarea name="message"></textarea></td></tr>
		<tr><td>Ville</td><td><select name="ville">
		<option value=""></option>
		<?php
			$sq='select * from villes order by ville asc';
			$rq=mysql_query($sq);
			while($dt=mysql_fetch_array($rq)){
		?>
		<option value="<?php echo $dt['id']; ?>"><?php echo $dt['ville']; ?></option>
		<?php } ?>
		</select></td></tr>
		<tr><td>Secteur</td><td><select name="cat">
		<option value=""></option>
		<?php
			$sq='select * from categories order by cat asc';
			$rq=mysql_query($sq);
			while($dt=mysql_fetch_array($rq)){
		?>
		<option value="<?php echo $dt['id']; ?>"><?php echo $dt['cat']; ?></option>
		<?php } ?>
		</select></td></tr>
		<tr><td>Facebook</td><td><input type="text" name="facebook" value="" /></td></tr>
		<tr><td>Twitter</td><td><input type="text" name="twitter" value="" /></td></tr>
		<tr><td>Youtube</td><td><input type="text" name="youtube" value="" /></td></tr>
		<tr><td>Pinterest</td><td><input type="text" name="pinterest" value="" /></td></tr>
		<tr><td>Linkedin</td><td><input type="text" name="linkedin" value="" /></td></tr>
		<tr><td></td><td><input type="submit" name="ajouter" value="Ajouter" /></td></tr>
</table>
</form>
<?php
	if(isset($msg)) {
		echo $msg;
	}
?>
	