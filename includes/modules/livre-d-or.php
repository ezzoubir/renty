<?php
  $sql='select * from  cms_v2_livre where statut="1"';
  $res=mysql_query($sql);
  while($ro=mysql_fetch_array($res))
  {
      echo '<div style="margin-bottom:25px;"><div style="margin-bottom:8px;"><b><em>'.stripslashes($ro['pseudo']).'</em></b></div><div>'.stripslashes($ro['message']).'</div></div>';
  
  }
  
  ?>
<hr />
<div style="margin-bottom:15px;">
<?php
  if(isset($_POST['CONTACT_FORM_LIVRE']))
  {
      // on teste si message deja posté
      $sql='select * from cms_v2_livre where pseudo="'.addslashes($_POST['FORM_PSEUDO']).'" and message="'.addslashes($_POST['FORM_MESSAGE']).'"';
      $res=mysql_query($sql);
      if(mysql_num_rows($res)==0)
      {
            $sql='insert into cms_v2_livre (pseudo,message) values("'.addslashes($_POST['FORM_PSEUDO']).'","'.addslashes($_POST['FORM_MESSAGE']).'")';
            mysql_query($sql);
      
      }
      
      ?>
  
        Votre message a été posté. Merci de votre contribution.
      <?php
  }
  else
  {
?>
<script type="text/javascript">
function valider_formulaire(frm){
 var erreur=false;
 var msg=" <?php echo FORM_CHAMPS_OBLIGATOIRES; ?> :\r\n";

 if(frm.elements['FORM_PSEUDO'].value == "") {
	 msg+=" Pseudo \r\n";
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


<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" onSubmit="return valider_formulaire(this);" method="POST">
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td width="150" class="main" height="30">Pseudo * :</td><td><input type="text" name="FORM_PSEUDO" class="main" value="" style="color:#000;width:150px;border:1px solid #000;"></td>
</tr>
<tr>
  <td width="150" class="main" valign="top" style="padding-top:10px;"><?php echo FORM_MESSAGE; ?> * :</td>
  <td style="padding-top:10px;">
  <textarea class="main"  name="FORM_MESSAGE" style="width:200px;height:70px;border:1px solid #000;color:#000;"></textarea>
  </td>
</tr>
<tr>
  <td colspan="2" height="30">(* <?php echo FORM_CHAMPS_OBLIGATOIRES; ?>)</td>
</tr>
<tr>
  <td></td><td class="main" style=""><br /><input type="submit" name="CONTACT_FORM_LIVRE" value="<?php echo FORM_ENVOYER; ?>" style="color:#000;border:1px solid #000;width:100px;"></td>
</tr>
</table>

</form>
<?php
}
?>
</div>