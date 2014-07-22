

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
<div style="margin-top:15px;">

<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
  <?php
  if(isset($erreur_identification))
  {
    echo '<tr><td colspan="2" height="25"><div style="color:red;">'.ECHEC_IDENTIFICATION.'</div></td>';
  }
?>
  <tr>
    <td><?php echo FORM_EMAIL; ?></td>
    <td height="25"><input type="text" name="FORM_EMAIL" class="main" style="border:1px solid #000;width:150px;"></td>
  </tr>
    <tr>
    <td height="25"><?php echo FORM_PASSWORD; ?></td>
    <td><input type="password" name="FORM_PASSWORD" class="main" style="border:1px solid #000;width:150px;"></td>
  </tr>
 <tr>
 <td></td>
  <td height="15"><a href="index.php?language=<?php echo $language ?>&page&espace_membre&inscription" style="font-size:10px;color:red;"><?php echo INSCRIPTION_ESPACE_MEMBRE; ?></a></td>
  </tr>
  <tr>
  <td></td>
  <td height="15"><a href="index.php?language=<?php echo $language ?>&page&espace_membre&mot_de_passe_oublie" style="font-size:10px;"><?php echo MOT_DE_PASSE_OUBLIE; ?></a></td>
  </tr>
  <tr>
    <td></td>
    <td height="35"><input class="main" type="submit" name="LOGIN_FORM_ENVOYER" value="<?php echo FORM_VALIDER; ?>" style="border:1px solid #000;"></td>
  </tr>
</table>
</div>
</form>