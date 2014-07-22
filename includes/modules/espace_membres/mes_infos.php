<!-- on recupere les infos membre -->
<?php
  $sql='select * from '.PREFIXE_BDD.'membres where id_membre="'.$_SESSION['id_membre'].'"';
  $res=mysql_query($sql);
  $ro=mysql_fetch_array($res);

?>
<?php
if(!isset($_GET['ok']))
{
?>
<script type="text/javascript">
function valider_formulaire(frm){
 var erreur=false;
 var msg=" <?php echo FORM_CHAMPS_OBLIGATOIRES; ?> :\r\n";

 if(frm.elements['FORM_NOM'].value == "") {
	 msg+=" <?php echo FORM_NOM; ?> \r\n";
	 erreur=true;
 }
 
  if(frm.elements['FORM_PRENOM'].value == "") {
	 msg+=" <?php echo FORM_PRENOM; ?> \r\n";
	 erreur=true;
 }

  if(!echeck(frm.elements['FORM_EMAIL'].value))
  {
    msg+=" <?php echo FORM_EMAIL; ?> \r\n";
	   erreur=true;
  }

  if(frm.elements['FORM_PASSWORD'].value!=frm.elements['FORM_PASSWORD2'].value) 
  {
	 msg+=" <?php echo FORM_NEW_PASSWORD; ?> \r\n";
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
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" onSubmit="return valider_formulaire(this);" method="POST">
<table width="450" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td width="150" class="main" height="30">Societ&eacute; :</td><td><input type="text" value="<?php if(isset($ro['societe'])) echo stripslashes($ro['societe']); ?>" name="societe" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Adresse :</td><td><input type="text" value="<?php if(isset($ro['adresse'])) echo stripslashes($ro['adresse']); ?>" name="adresse" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Siren :</td><td><input type="text" value="<?php if(isset($ro['siren'])) echo stripslashes($ro['siren']); ?>" name="siren" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Fax :</td><td><input type="text" value="<?php if(isset($ro['fax'])) echo stripslashes($ro['fax']); ?>" name="fax" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>

<tr>
  <td width="150" class="main" height="30">Site internet :</td><td><input type="text" value="<?php if(isset($ro['site'])) echo stripslashes($ro['site']); ?>" name="site" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Zone de challendise dpt/r&eacute;gion :</td><td><input type="text" value="<?php if(isset($ro['zone'])) echo stripslashes($ro['zone']); ?>" name="zone" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Fonction :</td><td><input type="text" value="<?php if(isset($ro['fonction'])) echo stripslashes($ro['fonction']); ?>" name="fonction" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="200" class="main" height="30"><?php echo FORM_NOM; ?> * :</td><td><input type="text" value="<?php if(isset($ro['nom'])) echo stripslashes($ro['nom']); ?>" name="FORM_NOM" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td class="main" height="30"><?php echo FORM_PRENOM; ?> * :</td><td><input type="text" value="<?php if(isset($ro['prenom'])) echo stripslashes($ro['prenom']); ?>" name="FORM_PRENOM" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td class="main" height="30"><?php echo FORM_EMAIL; ?> * :</td><td><input type="text" value="<?php if(isset($ro['email'])) echo stripslashes($ro['email']); ?>"  name="FORM_EMAIL" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td class="main" height="30"><?php echo FORM_NEW_PASSWORD; ?>  :</td><td><input type="password" name="FORM_PASSWORD" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td  class="main" height="30"><?php echo FORM_NEW_PASSWORD; ?>  :</td><td><input type="password" name="FORM_PASSWORD2" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td colspan="2" height="30">(* <?php echo FORM_CHAMPS_OBLIGATOIRES; ?>)</td>
</tr>
<tr>
  <td></td><td class="main" style=""><br /><input type="submit" name="ESPACE_MEMBRE_FORM_MODIF_COMPTE" value="<?php echo FORM_VALIDER; ?>" style="border:1px solid #000;width:100px;"></td>
</tr>
</table>
<input type="hidden" name="URL_SRC" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
</form>
<?php
}
else
{
    echo MAJ_COMPTE_MEMBRE_OK;
}
?>