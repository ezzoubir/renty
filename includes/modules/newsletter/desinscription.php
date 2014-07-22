<?php
  if(isset($_GET['ok']))
  {
   echo DESINSCRIPTION_NEWSLETTER_OK;
  }
  else
  {
  
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
  <div style="margin-top:15px;">
    <table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td><?php echo FORM_EMAIL; ?></td>
        <td height="25"><input type="text" name="FORM_EMAIL" class="main" style="border:1px solid #000;width:150px;"></td>
      </tr>
      <tr>
    <td></td>
    <td height="25"><input class="main" type="submit" name="FORM_NEWSLETTER_DESINSCRIPTION" value="<?php echo FORM_VALIDER; ?>" style="border:1px solid #000;"></td>
  </tr>
    </table>
</div>
<input type="hidden" name="URL_SRC" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
</form>
<?php

}
?>