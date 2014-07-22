<?php 
	if(isset($_POST['delete_ville']))
  {
     $id_ville=GetImageButtonValue($_POST['delete_ville']);      
     $sql='delete from villes where id="'.$id_ville.'"';
     mysql_query($sql);
  }
  
	if(isset($_POST['ajouter'])) {
		$sql='insert into villes (ville) values ("'.$_POST['ville'].'")';
		mysql_query($sql);
	}
	
	
	if(isset($_POST['modifier'])) {
		$sql='update villes set ville="'.$_POST['ville'].'" where id="'.$_POST['id'].'"';
		mysql_query($sql);
	}
	
	if(isset($_GET['id'])) {
		$sql=mysql_query('select * from villes where id="'.$_GET['id'].'"');
		$row=mysql_fetch_assoc($sql);
	}
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<table width="30%" cellspacing="0" cellpadding="0">
	<tr>
		<td>Ville : </td><td><input type="text" name="ville" value="<?php if(isset($_GET['id'])) { echo $row['ville']; } ?>" /></td>
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
	$sqla='select * from villes order by id desc';
	$reqa=mysql_query($sqla);
?>
<table width="30%" cellspacing="0" cellpadding="0">
	<tr>
		<th>Ville</th>
		<th>Actions</th>
	</tr>
<?php while($data=mysql_fetch_array($reqa)){ ?>
	<tr>
		<td><?php echo $data['ville']; ?></td>
		<td><a href="index.php?action=villes&id=<?php echo $data['id']; ?>" title="Editer" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
   <input style="margin-left:10px;" type="image" name="delete_ville[<?php echo $data['id']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Etes vous sur de supprimer la <?php echo stripslashes($data['ville']); ?>  ?")){this.submit();} else return false;'>
		</td>
	</tr>
<?php } ?>
</table>
</form>