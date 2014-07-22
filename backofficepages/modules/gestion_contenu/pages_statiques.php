<h1>Gestion des pages statiques <?php echo $_GET['language']; ?></h1>

<?php
  
    // on recupere les articles de la pages
  $sql='select * from '.PREFIXE_BDD.'pages_statiques  where  language="'.$_GET['language'].'"';
  $res=mysql_query($sql);
  $total=mysql_num_rows($res);

?>
<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
  <th>Titre</th>
  <th>langue</th>
  <th>Fonction</th>
  </tr>
<?php
  while ($row=mysql_fetch_assoc($res))
	{
	 ?>
	 <tr>
	 <td><?php echo stripslashes($row['titre']); ?></td>
	 <td><?php echo stripslashes($row['language']); ?></td>

   <td>
   <a href="index.php?action=gestion_page_statique_modifier&id_page=<?php echo $row['id_page']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
   </td>
	 </tr>

<?php
}
?>
  
  </table>
</form>


