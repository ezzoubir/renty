<?php

if(isset($_POST['save']))
  {
      // id_membre =
      $id=GetImageButtonValue($_POST['save']);
      if(isset($_POST['statut'][$id]))
      {
          $sql='update  coupons set statut="1" where id="'.$id.'"';
          mysql_query($sql);
      }
      else
      {
      
        $sql='update  coupons set statut="0" where id="'.$id.'"';
        mysql_query($sql);
      }
	  
}

if(isset($_POST['delete']))
{
    $id=GetImageButtonValue($_POST['delete']);
    
    // on supprimer l'enregistrement
    $sql='delete from coupons where id="'.$id.'"';
    mysql_query($sql);
}

$sql='select * from coupons order by id desc';
$req=mysql_query($sql);

?>
<h2>Liste des coupons</h2>
<br/>
<a href="index.php?action=add_coupon"><img src="imgs/Add.gif" />&nbsp;Ajouter un coupon</a>
<br/>
<br/>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="5" cellpadding="0" class="display" id="example">
	<thead>
	<tr>	
		<th>coupon</th>				<th>Marchand</th>
		<th>Photo</th>
		<th>Ville</th>
		<th>Catégorie</th>				<th>Réduction</th>
		<th>statut</th>
		<th>Actions</th>
	</tr>
	</thead>
	<tbody>
<?php while($data=mysql_fetch_array($req)) { ?>
	<tr>	
		<td><a href=""><?php echo $data['titre']; ?></a></td>		<td>			<?php 				$sq='select * from marchands where id="'.$data['id_marchand'].'"';				$rq=mysql_query($sq);				$fg=mysql_fetch_assoc($rq);				echo $fg['marchand']; 			?>		</td>
		<td><img src="../images/photos/<?php echo $data['logo']; ?>"  width="80"/></td>

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
		</td>		<td><?php echo $data['reduction']; ?></td>
		
   <td><input type="checkbox" name="statut[<?php echo $data['id']; ?>]" <?php if($data['statut']==1) echo ' checked '; ?>></td>
		<td><input type="image" name="save[<?php echo $data['id']; ?>]" src="imgs/floppy_disk16.gif">
	<a href="index.php?action=modif_coupon&id=<?php echo $data['id']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" /></a>
     <input style="margin-left:10px;" type="image" name="delete[<?php echo $data['id']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Supprimer cette coupon ?")){this.submit();} else return false;'>
	 </td>
	</tr>
<?php } ?>
</tbody>	
</table>	
</form>