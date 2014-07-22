<?php 
	if(isset($_POST['delete_cat']))
  {
     $id_event=GetImageButtonValue($_POST['delete_cat']);      
     $sql='delete from categories where id="'.$id_event.'"';
     mysql_query($sql);
  }
  
	if(isset($_POST['ajouter'])) {
		$sql='insert into categories (cat) values ("'.$_POST['cat'].'")';
		mysql_query($sql);
	}
	
	
	if(isset($_POST['modifier'])) {
		$sql='update categories set cat="'.$_POST['cat'].'" where id="'.$_POST['id'].'"';
		mysql_query($sql);
	}
	
	if(isset($_GET['id'])) {
		$sql=mysql_query('select * from categories where id="'.$_GET['id'].'"');
		$row=mysql_fetch_assoc($sql);
	}
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<table width="50%" cellspacing="0" cellpadding="0">
	<tr>
		<td>Catégorie : </td><td><input type="text" name="cat" value="<?php if(isset($_GET['id'])) { echo $row['cat']; } ?>" style="width:450px;"/></td>
	</tr>
	<?php if(isset($_GET['id'])) { ?>
	<tr>
		<td></td><td><input type="submit" name="modifier" value="Modifier" /></td>
	</tr>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	<?php } else { ?>
	<tr>
		<td></td><td><input type="submit" name="ajouter" value="Ajouter" /></td>
	</tr>
	<?php } ?>
</table>
<br/><br/>
<?php 
	$sqla='select * from categories order by id desc';
	$reqa=mysql_query($sqla);
?>
<table width="60%" cellspacing="0" cellpadding="0">
	<tr>
		<th>Catégorie</th>
		<th>Actions</th>
	</tr>
<?php while($data=mysql_fetch_array($reqa)){ ?>
	<tr>
		<td style="text-align:left"><?php echo $data['cat']; ?></td>
		<td><a href="index.php?action=categories&id=<?php echo $data['id']; ?>" title="Editer" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
   <input style="margin-left:10px;" type="image" name="delete_cat[<?php echo $data['id']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Etes vous sur de supprimer <?php echo stripslashes($data['cat']); ?>  ?")){this.submit();} else return false;'>
		</td>
	</tr>
<?php } ?>
</table>
</form>