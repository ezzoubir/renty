<?php
  if(isset($_GET['email_sent']))
  {
      echo '<div style="font-weight:bold;">Votre demande de réservartion a été envoyée.</div>';
  
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
  if(frm.elements['FORM_TEL'].value == "")
  {
    msg+=" Téléphone \r\n";
	   erreur=true;
  }
    if(frm.elements['FORM_NBR'].value == "")
  {
    msg+=" Nombre de personnes \r\n";
	   erreur=true;
  }
  
      if(frm.elements['FORM_DATE'].value == "")
  {
    msg+=" Date \r\n";
	   erreur=true;
  }
  
        if(frm.elements['FORM_HEURE'].value == "")
  {
    msg+=" Heure \r\n";
	   erreur=true;
  }
  
  

if(frm.elements['FORM_MESSAGE'].value == "") {
	 msg+=" <?php echo FORM_MESSAGE; ?> \r\n";
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
<table width="380" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td width="170" class="main" height="30"><?php echo FORM_NOM; ?> * :</td><td><input type="text" name="FORM_NOM" class="main" value="<?php if(isset($row['nom'])) echo stripslashes($row['nom']); ?>" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30"><?php echo FORM_PRENOM; ?> * :</td><td><input type="text" name="FORM_PRENOM" value="<?php if(isset($row['prenom'])) echo stripslashes($row['prenom']); ?>" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<!--<tr>
  <td width="170" class="main" height="30"><?php echo FORM_ADRESSE; ?>  :</td><td><input type="text" name="FORM_ADRESSE" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30"><?php echo FORM_CP; ?>  :</td><td><input type="text" name="FORM_CP" class="main" style="width:80px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30"><?php echo FORM_VILLE; ?>  :</td><td><input type="text" name="FORM_VILLE" class="main" style="width:100px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30"><?php echo FORM_PAYS; ?>  :</td><td><input type="text" name="FORM_PAYS" class="main" style="width:100px;border:1px solid #000;"></td>
</tr>-->
<tr>
  <td width="170" class="main" height="30"><?php echo FORM_EMAIL; ?> * :</td><td><input type="text" name="FORM_EMAIL" value="<?php if(isset($row['email'])) echo stripslashes($row['email']); ?>" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30">Téléphone * :</td><td><input type="text" name="FORM_TEL" value="<?php if(isset($row['FORM_TEL'])) echo stripslashes($row['FORM_TEL']); ?>" class="main" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30">Nombre de personnes * :</td><td><input type="text" name="FORM_NBR" value="" class="main" style="color:#000;width:50px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30">Date * :</td><td><input type="text" name="FORM_DATE" value="" class="main" style="color:#000;width:100px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" height="30">Heure * :</td><td><input type="text" name="FORM_HEURE" value="" class="main" style="color:#000;width:100px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="170" class="main" valign="top" style="padding-top:10px;">Commentaire * :</td>
  <td style="padding-top:10px;">
  <textarea class="main"  name="FORM_MESSAGE" style="width:200px;height:70px;border:1px solid #000;"></textarea>
  </td>
</tr>
<tr>
  <td colspan="2" height="30">(* <?php echo FORM_CHAMPS_OBLIGATOIRES; ?>)</td>
</tr>
<tr>
  <td></td><td class="main" style=""><br /><input type="submit" name="RESERVATION_FORM_ENVOYER" value="<?php echo FORM_ENVOYER; ?>" style="color:#000;border:1px solid #000;width:100px;"></td>
</tr>
</table>
<input type="hidden" name="URL_SRC" value="reservation-msg-envoye.html">

</form>
</div>
<?php
}
?>