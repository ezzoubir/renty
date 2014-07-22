<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- Téléphone non valide.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- Téléphone non valide.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- Téléphone non valide '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- Téléphone Obligatoire.\n'; }
    } if (errors) alert(''+errors);
    document.MM_returnValue = (errors == '');
} }
</script>

<?php

if (isset($_POST['Envoyer']))
{ 
  $semail='EMAIL_EXP';
  $phone=$_POST['phone'];

   if ((isset($phone)) && !empty($phone) )
 {  
  $titre = "Rappel immediat gratuit :$nom";	
  $contenu="N de telephone ". $phone ."\n";
 // envoi du mail HTML
  $from = "From: <$semail>\nMime-Version:";
  $from .= " 1.0\nContent-Type: text/html; charset=ISO-8859-1\n";

  mail($semail,$titre,$contenu,$from);

      echo'<div style="font-weight:bold;">votre téléphone a été envoyé avec succés </div>';
  
	
} 
else
 {
 echo'<div id="erreur">Erreur</div>';
 } 
}

?>  

<form id="form1" name="form1" method="post" action="">
 <table width="350px" align="center"> 
<tr> <td><p>
    <label for="telephone">Téléphone * </label> </td><td><input name="phone" class="main" type="text" style="color:#000;width:150px;border:1px solid #000;" type="text" id="textfield" onblur="MM_validateForm('textfield','','RisNum');return document.MM_returnValue" />
  </p></td>
  </tr>
 <tr><td></td><td> <p>
    <input name="Envoyer"  style="color:#000;border:1px solid #000;width:100px;" type="submit" id="button" onclick="MM_validateForm('textfield','','RisNum');return document.MM_returnValue" value="Envoyer" />
  </p></td></tr>
  </table>
</form>
