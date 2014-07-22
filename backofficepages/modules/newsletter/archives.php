<h1>Archives</h1>
<?php
if(isset($_POST['delete_newsletter']))
{
    $id_newsletter=GetImageButtonValue($_POST['delete_newsletter']); 
    $sql='delete from  '.PREFIXE_BDD.'newsletter_archive where id_newsletter="'.$id_newsletter.'"';
    mysql_query($sql);

}

  $sql='select * from '.PREFIXE_BDD.'newsletter_archive order by id_newsletter';
  $res=mysql_query($sql);
?>
<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>  
    <th>Date envoie</th>
    <th>Public</th>
    <th>Langue</th>
    <th>Objet</th>
    <th>Statut</th>
    <th>Fonctions</th>
  </tr>
  <?php
    while($row=mysql_fetch_array($res))
    {
      ?>
      <tr>
        <td><?php echo ConvertDateToFr($row['date_expedition']); ?></td>
        <td><?php echo stripslashes($row['Public']); ?></td>
        <td><?php echo stripslashes($row['language']); ?></td>
        <td><?php echo stripslashes($row['objet']); ?></td>
        <td><?php if($row['statut']==0) echo '<span style="color:red;">ERREUR</span>';else echo '<span style="color:blue;">Envoyée</span>' ?></td>
        <td>
        <a href="../includes/modules/newsletter/apercu_newsletter.php?id_newsletter=<?php echo $row['id_newsletter']; ?>" title="aperçu" target="_blank"><img src="imgs/apercu.gif" border="0" /></a>
        <input style="margin-left:15px;" type="image" name="delete_newsletter[<?php echo $row['id_newsletter']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Supprimer  la lettre <?php echo stripslashes($row['objet']); ?>  ?")){this.submit();} else return false;'>
        </td>
      </tr>
      <?php
    }
  ?>
</table>
</form>