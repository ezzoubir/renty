<?php

  if(isset($_GET['valide']))

  {

    echo '<b>'.SUCCES_INSCRIPTION_MEMBRE.'</b>';

  }

  else

  {

  

  if(isset($erreur_inscription_compte_existe))

  {

      ?>

      <div style="color:red;margin-top:15px;margin-bottom:15px;"><?php echo ERREUR_INSCRIPTION_COMPTE_EXISTE; ?></div>

      <?php

  }

  if(isset($erreur_inscription_champs))

  {

      ?>

      <div style="color:red;margin-top:15px;margin-bottom:15px;"></div>

      <?php

  }

  

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

  }  if(!frm.elements['engage'].checked)

  {

    msg+=" Contrat d'engagement \r\n";

	   erreur=true;

  }



  if(frm.elements['FORM_PASSWORD'].value == "" || frm.elements['FORM_PASSWORD'].value!=frm.elements['FORM_PASSWORD2'].value) 

  {

	 msg+=" <?php echo FORM_PASSWORD; ?> \r\n";

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

<table border="0" width="100%">

<tr>

<td width="65%">

<table width="550" border="0" cellpadding="0" cellspacing="0" align="center">

<tr>

  <td width="150" class="main" height="30">Societ&eacute; :</td><td><input type="text" value="<?php if(isset($_POST['societe'])) echo stripslashes($_POST['societe']); ?>" name="societe" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30">Adresse :</td><td><input type="text" value="<?php if(isset($_POST['adresse'])) echo stripslashes($_POST['adresse']); ?>" name="adresse" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30">Siren :</td><td><input type="text" value="<?php if(isset($_POST['siren'])) echo stripslashes($_POST['siren']); ?>" name="siren" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30">Fax :</td><td><input type="text" value="<?php if(isset($_POST['fax'])) echo stripslashes($_POST['fax']); ?>" name="fax" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30"><?php echo FORM_EMAIL; ?> * :</td><td><input type="text" value="<?php if(isset($_POST['FORM_EMAIL'])) echo stripslashes($_POST['FORM_EMAIL']); ?>"  name="FORM_EMAIL" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30">Site internet :</td><td><input type="text" value="<?php if(isset($_POST['site'])) echo stripslashes($_POST['site']); ?>" name="site" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30">Zone de challendise dpt/r&eacute;gion :</td><td><input type="text" value="<?php if(isset($_POST['zone'])) echo stripslashes($_POST['zone']); ?>" name="zone" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30">Typologie client :  <br/><br/><br/><br/></td><td>

															<input type="radio" name="typologie"  value="residentiel"> R&eacute;sidentiel

														    <br/><input type="radio" name="typologie"  value="tertiaire"> Tertiaire   

														     <br/><input type="radio" name="typologie"  value="prescripteur"> Prescripteur    

														     <br/><input type="radio" name="typologie"  value="CHR"> CHR

  </td>

</tr>



<tr>

  <td width="150" class="main" height="30">Fonction :</td><td><input type="text" value="<?php if(isset($_POST['fonction'])) echo stripslashes($_POST['fonction']); ?>" name="fonction" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30"><?php echo FORM_NOM; ?> * :</td><td><input type="text" value="<?php if(isset($_POST['FORM_NOM'])) echo stripslashes($_POST['FORM_NOM']); ?>" name="FORM_NOM" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30"><?php echo FORM_PRENOM; ?> * :</td><td><input type="text" value="<?php if(isset($_POST['FORM_PRENOM'])) echo stripslashes($_POST['FORM_PRENOM']); ?>" name="FORM_PRENOM" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>



<tr>

  <td width="150" class="main" height="30"><?php echo FORM_PASSWORD; ?> * :</td><td><input type="password" name="FORM_PASSWORD" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

  <td width="150" class="main" height="30"><?php echo FORM_PASSWORD; ?> * :</td><td><input type="password" name="FORM_PASSWORD2" class="main" style="width:150px;border:1px solid #000;"></td>

</tr>

<tr>

 <td colspan="2"><input  type="checkbox" name="engage" >Je m'engage &agrave; respecter les informations et brevets de la marque ainsi que de la v&eacute;racit&eacute; de mes d&eacute;clarations ci dessous en engageant ainsi ma responsabilit&eacute; de professionnel du froid

</td>

 

 </tr>

<tr>

  <td colspan="2" height="30">(* <?php echo FORM_CHAMPS_OBLIGATOIRES; ?>)</td>

</tr>

<tr>

  <td></td><td class="main" style=""><br /><input type="submit" name="ESPACE_MEMBRE_FORM_INSCRIPTION" value="<?php echo FORM_VALIDER; ?>" style="border:1px solid #000;width:100px;"></td>

</tr>

</table>

</td>

<td width="40%">

<p>Client en produits et accessoires

aupr&egrave;s de</p>



<table width="100%" border="0" align="center">

  <tr>

    <td><input  type="checkbox" name="produits[]"  value="Clim-plus"></td>

    <td><input  type="checkbox" name="produits[]"  value="CD-SUD"></td>

  </tr>

  <tr>

    <td><img src="images/clim_or.jpg"/></td>

    <td><img src="images/clim_ro.jpg"/></td>

  </tr>

  <tr>

    <td colspan="2"><input  type="checkbox" name="produits[]"  value="autre">Autre </td>

  

  </tr>

  <tr>

    <td colspan="2">Pr&eacute;ciser  <input  type="text" name="produits[]"  ></td>

	</tr>

  <tr>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

</table>



</td>

</tr>

</table>







</form>

<?php

}

?>