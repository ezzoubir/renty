<script type="text/javascript">
function valider_formulaire(frm){
 var erreur=false;
 var msg=" <?php echo FORM_CHAMPS_OBLIGATOIRES; ?> :\r\n";


  if(!echeck(frm.elements['FORM_REGISTER_NEWSLETTER_EMAIL'].value))
  {
    msg+=" <?php echo FORM_EMAIL; ?> \r\n";
	   erreur=true;
  }

  if(frm.elements['FORM_REGISTER_NEWSLETTER_VILLE'].value == "") {
	 msg+=" <?php echo FORM_VILLE; ?> \r\n";
	 erreur=true;
 }
  if(frm.elements['FORM_REGISTER_NEWSLETTER_PAYS'].value == "") {
	 msg+=" <?php echo FORM_PAYS; ?> \r\n";
	 erreur=true;
 }

 

 if(erreur){alert(msg);return false;}
 else{return true;}
 }

function echeck(str) {
 var at="@"
var dot="."
 var lat=str.indexOf(at)
 var lstr=str.length
 var ldot=str.indexOf(dot)
 if (str.indexOf(at)==-1){
 return false;
 }
 if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
 return false;
 }
 if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
 return false;
 }
 if (str.indexOf(at,(lat+1))!=-1){
 return false;
 }
 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
 return false;
 }
 if (str.indexOf(dot,(lat+2))==-1){
 return false;
 }
 if (str.indexOf(" ")!=-1){
 return false;
}
return true;
}
</script>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" onSubmit="return valider_formulaire(this);">
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="150"><?php echo FORM_NOM; ?> :</td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_NOM" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_PRENOM; ?> : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_PRENOM" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_TEL; ?> : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_TEL" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_EMAIL; ?> * : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_EMAIL" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_VILLE; ?> * : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_VILLE" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_PAYS; ?> * : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_PAYS" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
  <td></td>
  <td height="30"><input type="submit" name="FORM_REGISTER_NEWSLETTER_SUBMIT" value="<?php echo FORM_OK; ?>" class="main" style="border:1px solid #fff;background:url(images/global/bg_button.png);color:#fff;">
</td>
</tr>
<tr>
  <td style="font-size:10px;" colspan="2"><?php echo '* '. FORM_CHAMPS_OBLIGATOIRES;  ?></td>
</tr>
</table>

</form>
<?php


  if(isset($inscription_newsletter))
  {
      echo '<script type="text/javascript">alert("'.$inscription_newsletter.'");</script>';
  }
?>