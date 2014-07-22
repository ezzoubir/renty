<div  style="margin-top:15px;" class="main">
<?php
  // Faire un don !

  if(isset($_SESSION['id_membre']))
  {
      // on recupere les infos
      $sql='select * from '.PREFIXE_BDD.'membres where id_membre="'.$_SESSION['id_membre'].'"';
      $res_=mysql_query($sql);
      $row=mysql_fetch_array($res_);
  
  }
  
  if(isset($_POST['CONTACT_FORM_FAIRE_DON']))
  {
 
  require_once('class/paypal.class.php');  // include the class file
  $p = new paypal_class;             // initiate an instance of the class
  $p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
  $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  //echo $this_script;
  if (empty($_GET['action_'])) $_GET['action_'] = 'process';  
  
  
  switch ($_GET['action_']) {
      case 'process':
      $nom=$_POST['FORM_NOM'];	
		  $email=$_POST['FORM_EMAIL'];
		  $p->add_field('business', MAIL_PAYPAL);
		  $p->add_field('item_name', '['.BASE_URL.']['.FAIRE_DON.']'); 
		  $p->add_field('last_name', $nom);  
		  $p->add_field('first_name', $_POST['FORM_PRENOM']); 
		  $p->add_field('email', $email);
		  $p->add_field('amount', str_replace(',','.',$_POST['FORM_MONTANT']));
		  $p->add_field('currency_code', 'EUR');
		  $p->add_field('return', $this_script);
		  $p->add_field('cancel_return', $this_script);
		  $p->submit_paypal_post();
		  
		  
		  
      break;
  
  }
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
 
   if(frm.elements['FORM_MONTANT'].value == "") {
	 msg+=" <?php echo FORM_MONTANT; ?> \r\n";
	 erreur=true;
 }

  if(!echeck(frm.elements['FORM_EMAIL'].value))
  {
    msg+=" <?php echo FORM_EMAIL; ?> \r\n";
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
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" onSubmit="return valider_formulaire(this);">
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_NOM; ?> * :</td><td><input type="text" name="FORM_NOM" class="main" value="<?php if(isset($row['nom'])) echo stripslashes($row['nom']); ?>" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_PRENOM; ?> * :</td><td><input type="text" name="FORM_PRENOM" value="<?php if(isset($row['prenom'])) echo stripslashes($row['prenom']); ?>" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_EMAIL; ?> * :</td><td><input type="text" name="FORM_EMAIL" value="<?php if(isset($row['email'])) echo stripslashes($row['email']); ?>" class="main" style="width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" height="30"><?php echo FORM_MONTANT; ?> * :</td><td><input type="text" name="FORM_MONTANT" value="" class="main" style="width:80px;border:1px solid #000;"> €</td>
</tr>
<tr>
  <td colspan="2" height="30">(* <?php echo FORM_CHAMPS_OBLIGATOIRES; ?>)</td>
</tr>
<tr>
  <td></td><td class="main" style=""><br /><input type="submit" name="CONTACT_FORM_FAIRE_DON" value="<?php echo FORM_ENVOYER; ?>" style="border:1px solid #000;width:100px;"></td>
</tr>
</table>
</form>
<?php
}
?>
</div>