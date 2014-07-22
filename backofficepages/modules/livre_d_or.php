<h1>Livre d'or</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
<?php
if(isset($_POST['delete']))
{
    $id=GetImageButtonValue($_POST['delete']);
    $sql='delete from cms_v2_livre where id="'.$id.'"';
    mysql_query($sql);

}
if(isset($_POST['activate']))
{
     $sql='update  cms_v2_livre set statut=1 where id='.GetImageButtonValue($_POST['activate']);
    mysql_query($sql);
}
if(isset($_POST['desactivate']))
{
     $sql='update  cms_v2_livre set statut=0 where id='.GetImageButtonValue($_POST['desactivate']);
    mysql_query($sql);
}




  $sql='select * from  cms_v2_livre order by statut,id';
  $res=mysql_query($sql);
?>
  <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <th width="250" style="text-align:left;">Pseudo</th>
    <th width="400" style="text-align:left;">Message</th>
    <th>Statut</th>
    <th>Fonction</th>
  
  </tr>
  <?php
    while($ro=mysql_fetch_array($res))
    {
      ?>
      <tr>
        <td style="text-align:left;"><?php echo stripslashes($ro['pseudo']); ?></td>
         <td style="text-align:left;"><?php echo stripslashes($ro['message']); ?></td>
         <td>
         <?php
                    if($ro['statut']==1) echo '<img src="imgs/icon_status_green.gif" border="0" style="margin-left:5px;">';else echo '<input type="image" name="activate['.$ro['id'].']" src="imgs/icon_status_green_light.gif" style="margin-left:5px;">';
                    if($ro['statut']==0) echo '<img src="imgs/icon_status_red.gif" style="margin-left:5px;" border="0" style="margin-left:25px;">';else echo '<input type="image" name="desactivate['.$ro['id'].']" src="imgs/icon_status_red_light.gif" style="margin-left:5px;">';
            ?>
         
         
         </td>
         <td>
          <input type="image" name="delete[<?php echo $ro['id']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Êtes-vous certain de supprimer ce message ?")){this.submit();} else return false;'></td>
            
         </td>
      </tr>
      <?php
    }
  ?>
  </table>
  </form>