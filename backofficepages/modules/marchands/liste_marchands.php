<?php

if(isset($_POST['save']))
  {
      // id_membre =
      $id=GetImageButtonValue($_POST['save']);
      if(isset($_POST['statut'][$id]))
      {
          $sql='update  marchands set statut="1" where id="'.$id.'"';
          mysql_query($sql);
      }
      else
      {
      
        $sql='update  marchands set statut="0" where id="'.$id.'"';
        mysql_query($sql);
      }
	  
}

if(isset($_POST['delete']))
{
    $id=GetImageButtonValue($_POST['delete']);
    
    // on supprimer l'enregistrement
    $sql='delete from marchands where id="'.$id.'"';
    mysql_query($sql);
}

$sql='select * from marchands order by id desc';
$req=mysql_query($sql);

?>
<h2>Liste des marchands</h2>
<br/>
<a href="index.php?action=add_marchand"><img src="imgs/Add.gif" />&nbsp;Ajouter un marchand</a>
<br/>
<br/>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="5" cellpadding="0" class="display" id="example">
	<thead>
	<tr>	
		<th>marchand</th>
		<th>Logo</th>
		<th>Video</th>
		<th>Responsable</th>
		<th>Tél</th>
		<th>email</th>
		<th>Adresse</th>
		<th>Web site</th>
		<th>Ville</th>
		<th>Secteur</th>
		<th>statut</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tbody>
<?php while($data=mysql_fetch_array($req)) { ?>
	<tr>	
		<td><a href=""><?php echo $data['marchand']; ?></a></td>
		<td><img src="../images/photos/<?php echo $data['logo']; ?>"  width="80"/></td>
		<td><?php echo $data['fichier']; ?></td>
		<td><?php echo $data['responsable']; ?></td>
		<td><?php echo $data['tel']; ?></td>
		<td><?php echo $data['email']; ?></td>
		<td><?php echo $data['adresse']; ?></td>
		<td><?php echo $data['site']; ?></td>
		<td>
			<?php 
				$sq='select * from villes where id="'.$data['id_ville'].'"';
				$rq=mysql_query($sq);
				$fg=mysql_fetch_assoc($rq);
				echo $fg['ville']; 
			?>
		</td>
		<td>
			<?php 
				$sq='select * from categories where id="'.$data['id_cat'].'"';
				$rq=mysql_query($sq);
				$fg=mysql_fetch_assoc($rq);
				echo $fg['cat']; 
			?>
		</td>
		
   <td><input type="checkbox" name="statut[<?php echo $data['id']; ?>]" <?php if($data['statut']==1) echo ' checked '; ?>></td>
		<td><input type="image" name="save[<?php echo $data['id']; ?>]" src="imgs/floppy_disk16.gif">
	<a href="index.php?action=modif_marchand&id=<?php echo $data['id']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
     <input style="margin-left:10px;" type="image" name="delete[<?php echo $data['id']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Supprimer cette marchand ?")){this.submit();} else return false;'>
	 </td>
	</tr>
<?php } ?>
</tbody>	
</table>	
</form>