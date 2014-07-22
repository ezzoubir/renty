<?php
include '../class/upload.class.inc.php';
function ProposePhoto($UploadingFile)
{
        $charge=false;
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        if ($handle->uploaded) 
        {
            $FileName='logo_coupon_'.time();
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
            $FileName='video_'.$_POST['titre'].'_'.time();
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
            $sql='select logo from coupons where id="'.$_POST['id'].'"';
            $res=mysql_query($sql);
            $row=mysql_fetch_array($res);
            if($row['logo']!='')
            {
                @unlink('../'.RepPhoto.$row['logo']);
                 @unlink('../'.RepPhoto.'mins/'.$row['logo']);
            }
       
             $sql='update coupons set logo="" where id="'.$_POST['id'].'"';
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
  
	$sql='update coupons set titre="'.$_POST['titre'].'",
		slug="'.$_POST['slug'].'",
		presentation="'.$_POST['presentation'].'",
		tags="'.$_POST['tags'].'",
		url="'.$_POST['url'].'",
		site="'.$_POST['site'].'",
		reduction="'.$_POST['reduction'].'",
		id_ville="'.$_POST['ville'].'",
		id_marchand="'.$_POST['marchand'].'",
		id_cat="'.$_POST['cat'].'" where id="'.$_POST['id'].'"';
		
	mysql_query($sql);
	
		
	$uploadlogo=ProposeFichier($_FILES['logo']);
	if($uploadfile!=false)
		{
			  $sql='update coupons set logo="'.$uploadfile.'" where id="'.$_POST['id'].'"';
			  mysql_query($sql);
	}
	
		
	$upload=ProposePhoto($_FILES['photo']);
    if($upload!=false)
    {
          $sql='insert into photos (id_coupon,photo) values("'.$_POST['id'].'","'.$upload.'")';
          mysql_query($sql);
    
    }
	
	
	
	$msg='<script>alert("Les données ont été modifié avec succès")</script>';
  }
  
  $sd='select * from coupons where id="'.$_GET['id'].'"';
  $fg=mysql_query($sd);
  $dr=mysql_fetch_assoc($fg);
?>
<h2>Ajouter une coupon</h2>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>Titre</td><td><input type="text" name="titre" value="<?php echo $dr['titre']; ?>" /></td></tr>
		<tr><td>Slug</td><td><input type="text" name="slug" value="<?php echo $dr['slug']; ?>" /></td></tr>
		<tr><td>Logo</td><td>
		<?php if($dr['logo']!='') { ?>
		<a href="<?php echo BASE_URL.RepPhoto.$dr['logo']; ?>"><img src="../images/photos/<?php echo $dr['logo']; ?>" height="110" width="200" style="border:2px solid #ccc;" /></a>
		<input type="checkbox" name="supprimer_logo"> Supprimer le logo
		<?php } else { ?>
		<input type="file" name="logo" />
		<?php } ?></td></tr>
		<tr><td>Présentation</td><td><textarea cols="15" rows="3" name="presentation"><?php echo $dr['presentation']; ?></textarea></td></tr>
		<tr><td>Video (url)</td><td><input type="text" name="url" value="<?php echo $dr['url']; ?>" /></td></tr>
		<tr><td>Web site</td><td><input type="text" name="site" value="<?php echo $dr['site']; ?>" /></td></tr>
		<tr><td>Réduction</td><td><input type="text" name="reduction" value="<?php echo $dr['reduction']; ?>" /></td></tr>
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
		<tr><td>Marchand</td><td><select name="marchand">
		<option value=""></option>
		<?php
			$sq='select * from marchands order by marchand asc';
			$rq=mysql_query($sq);
			while($dt=mysql_fetch_array($rq)){
		?>
		<option value="<?php echo $dt['id']; ?>" <?php if($dr['id_marchand']==$dt['id']) { echo 'selected';} ?>><?php echo $dt['marchand']; ?></option>
		<?php } ?>
		</select></td></tr>
		<tr><td>Catégorie</td><td><select name="cat">
		<option value=""></option>
		<?php
			$sq='select * from cats order by cat asc';
			$rq=mysql_query($sq);
			while($dt=mysql_fetch_array($rq)){
		?>
		<option value="<?php echo $dt['id']; ?>" <?php if($dr['id_cat']==$dt['id']) { echo 'selected';} ?>><?php echo $dt['cat']; ?></option>
		<?php } ?>
		</select></td></tr>
		<tr>
			<td><b>Ajouter une photo</b></td>
        <td><input type="file" name="photo">
        <br/>
        <div style=" margin-top:25px;">
        <?php
          $sql='select * from photos where id_coupon="'.(int)$_GET['id'].'" order by id_photo';
          $res=mysql_query($sql);
          while($row=mysql_fetch_array($res))
          {
            ?>
              <div style="border:1px solid #000;padding:5px;float:left;margin-right:15px;margin-bottom:15px;text-align:center;">
                <img src="../<?php echo RepPhoto.$row['photo']; ?>" width="80" border="0">
                <br />
                <input type="submit" name="del_image[<?php echo $row['id_photo']; ?>]" value="Supprimer" style="border:1px solid #000;">
              </div>
          <?php
          }
  
        ?>
        <div style="clear:both;"></div>
        </div>
			</td>
		</tr>
		<tr><td>Tags</td><td><textarea cols="15" rows="3" name="tags"><?php echo $dr['tags']; ?></textarea></td></tr>
		<tr><td></td><td><input type="submit" name="modifier" value="Modifier" /></td></tr>
</table>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
</form>
<?php
	if(isset($msg)) {
		echo $msg;
	}
?>
	