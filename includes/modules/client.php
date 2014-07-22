<?php
  if(isset($_GET['email_sent']))
  {
      echo '<div style="font-weight:bold;">'.FORM_MESSAGE_ENVOYE_SUCCES.'</div>';
  
  }
  else
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
  if(!echeck(frm.elements['societe'].value))
  {
    msg+=" Société\r\n";
	   erreur=true;
  }



   if(frm.elements['FORM_TEL'].value == "") {
	 msg+=" Téléphone \r\n";
	 erreur=true;
 }
   if(!echeck(frm.elements['fonction'].value))
  {
    msg+=" Fonction\r\n";
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
<?php
  if(isset($_SESSION['id_membre']))
  {
      // on recupere les infos
      $sql='select * from '.PREFIXE_BDD.'membres where id_membre="'.$_SESSION['id_membre'].'"';
      $res_=mysql_query($sql);
      $row=mysql_fetch_array($res_);
  
  }
?>
<div style="margin-bottom:15px;">
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" onSubmit="return valider_formulaire(this);" method="POST">

<table width="100%" border="0">
<tr>
<td>
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_NOM; ?> * :</td><td><input type="text" name="FORM_NOM" class="main" value="<?php if(isset($row['nom'])) echo stripslashes($row['nom']); ?>" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Société * :</td><td><input type="text" name="societe"  class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>

<tr>
  <td width="150" class="main" height="30"><?php echo FORM_TEL; ?> * :</td><td><input type="text" name="FORM_TEL" value="" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30">Descriptif du poste  :</td><td><input type="text" name="FORM_CP" class="main" style="color:#000;width:80px;border:1px solid #000;"></td>
</tr>



<tr>
  <td width="150" class="main" valign="top" style="padding-top:10px;">Message  :</td>
  <td style="padding-top:10px;">
  <textarea class="main"  name="FORM_MESSAGE" style="width:200px;height:70px;border:1px solid #000;color:#000;"></textarea>
  </td>
</tr>

<tr>
  <td colspan="2" height="30">(* <?php echo FORM_CHAMPS_OBLIGATOIRES; ?>)</td>
</tr>
<tr>
  <td></td><td class="main" style=""><br /><input type="submit" name="CLIENT_FORM_ENVOYER" value="Valider" style="color:#000;border:1px solid #000;width:100px;"></td>
</tr>
</table>
</td>
<td valign="top">
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_PRENOM; ?> * :</td><td><input type="text" name="FORM_PRENOM" value="<?php if(isset($row['prenom'])) echo stripslashes($row['prenom']); ?>" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>


<tr>
  <td width="150" class="main" height="30">Fonction * :</td><td> <input type="text" class="fonction"  name="fonction"  style="color:#000;width:150px;border:1px solid #000;">
</tr>
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_EMAIL; ?> * :</td><td><input type="text" name="FORM_EMAIL" value="<?php if(isset($row['email'])) echo stripslashes($row['email']); ?>" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>


<tr>
  <td width="150" class="main" height="30">Type de poste   :</td><td><select name="statut">
  <option value="CDI">CDI</option>
  <option value="freelance">Freelance</option>

  </select>
  </td>
</tr>
<tr>
  <td width="150" class="main" height="30">TJM/Rémunération   :</td><td><input type="text" name="TJM" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" valign="top" style="padding-top:10px;">Pièce joite :</td>
  <td style="padding-top:10px;">
 <input type="file" name="pj" value="" class="main" style="color:#000;width:130px;border:0px solid #000;height:25px;"></textarea>
  </td>
</tr>



</table>
</td>
</tr>
</table>

<input type="hidden" name="URL_SRC" value="contact-msg-envoye.html">

</form>
</div>
<?php
}
?>