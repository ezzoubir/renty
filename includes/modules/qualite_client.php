<?php
    // formulaire
    if(isset($_POST['sending_qualite']))
    {
        //traitement
     // formulaire de contact traitement
        include 'class/phpmailer.class.inc.php';
        $message='
        <b>Accueil</b>
        <hr /><br />
        Etes vous satisfait de l\'accueil téléphonique ? '.$_POST['accueil_tel'].'<br /><br />
        Etes vous satisfait de l\'information communiquée par nos esthéticiennes ?'.$_POST['infos_estheticienne'].'<br /><br />
        Etes vous satisfait du temps accordé à vos soins ?'.$_POST['temps_soins'].'<br /><br />
         
        <b>Qualité des appareils : </b>
        <hr /><br />
        Etes vous satisfait de la qualité des appareils ?'.$_POST['qualite_appareil'].'<br /><br />
         Etes vous satisfait des résultats obtenus par rapport à vos attentes ? '.$_POST['resultats_obtenus'].'<br /><br />
         Etes vous satsfait de la rapidité d\'obtention des résultats ? '.$_POST['rapidite_resultat'].'<br /><br />
         
        <b>Qualité du service commercial : </b>
        <hr /><br />
        Etes vous satisfait des informations communiquées par l\'estheticienne ? '.$_POST['comm_est'].'<br /><br />
        Etes vous satisfait des relations avec vos esthéticiennnes ? '.$_POST['satisfaction_relation'].'<br /><br />
        <b>Prix : </b>
        <hr /><br />
        Comment trouvez-vous le rapport qualité prix de nos prestations ? '.$_POST['prix'].'<br /><br />
        Comment situez-vous nos prix par rapport à nos concurrents ? '.$_POST['prix_concurrents'].'<br /><br />
        Etes vous satisfait de la rentabilité obtenue ? '.$_POST['satisfaction_relation'].'<br /><br />
        <b>La communication :</b>
         
        <hr /><br />
        Etes vous satisfait des support de communication que nous vous avons fournit ? '.$_POST['satisfaction_relation2'].'<br /><br />
        <b>Produits :</b>
         
        <hr /><br />
        Proposition de produits supplémentaires : '.$_POST['satisfaction_relation'].'<br /><br />
        Seriez-vous interressez par d\'autre appareils permettant d\'autres applications?  '.$_POST['interresse_autre_appareil'].'<br /><br />
        
        <b>Les améliorations  :</b>
         '.$_POST['proposition'].'
        <hr /><br />
        ';
        
        
        
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes(BASE_URL);
        $mail->Subject=stripslashes('[Suivi qualité]['.BASE_URL.']');
        //$mail->AddReplyTo($_POST['FORM_EMAIL']);//$EmailExp
        $mail->AddAddress(EMAIL_ADMIN);
        if(EMAIL_ADMIN2!='')
          $mail->AddAddress(EMAIL_ADMIN2);
        $mail->Body=stripslashes($message);
        
        
        $mail->Send();
      
      
      echo '<div style="margin-top:15px;font-weight:bold;">Merci de votre contribution.</div>';
    }
    else
    {
    
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" onSubmit="return valider_formulaire(this);" method="POST">
<table width="550" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td><b>L'accueil :</b></td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td width="550" class="main" valign="top">Etes vous satisfait de l'accueil téléphonique ?</td>
</tr>
<tr>
  <td  height="30">
  <select name="accueil_tel" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td class="main" valign="top">Etes vous satisfait de l'information communiquée par nos esthéticiennes ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="infos_estheticienne" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td class="main" valign="top">Etes vous satisfait du temps accordé à vos soins ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="temps_soins" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><b>Qualité des appareils :</b></td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td class="main" valign="top">Etes vous satisfait de la qualité des appareils ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="qualite_appareil" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td class="main" valign="top">Etes vous satisfait des résultats obtenus par rapport à vos attentes ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="resultats_obtenus" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
 </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Etes vous satsfait de la rapidité d'obtention des résultats ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="rapidite_resultat" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><b>Qualité du service commercial :</b></td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Etes vous satisfait des informations communiquées par l'estheticienne ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="comm_est" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Etes vous satisfait des relations avec vos esthéticiennnes ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="satisfaction_relation" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td  valign="top"><b>Prix :</b></td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Comment trouvez-vous le rapport qualité prix de nos prestations ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="prix" class="main">
    <option></option>
    <option value="Cher">Cher</option>
    <option value="Raisonable">Raisonable</option>
    <option value="économique">Economique</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Comment situez-vous nos prix par rapport à nos concurrents ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="prix_concurrents" class="main">
    <option></option>
    <option value="Cher">Cher</option>
    <option value="Raisonable">Raisonable</option>
    <option value="économique">Economique</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Etes vous satisfait de la rentabilité obtenue ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="satisfaction_relation" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><b>La communication :</b></td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Etes vous satisfait des support de communication que nous vous avons fournit ?</td>

</tr>
<tr>
  <td  height="30">
  <select name="satisfaction_relation2" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><b>Produits :</b></td>
</tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Proposition de produits supplémentaires</td>
</tr>
<tr>
  <td  height="30">
    <textarea name="proposition" style="width:250px;height:50px;"></textarea>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Seriez-vous interressez par d'autre appareils permettant d'autres applications?</td>

</tr>
<tr>
  <td  height="30">
  <select name="interresse_autre_appareil" class="main">
    <option></option>
    <option value="oui">oui</option>
    <option value="non">non</option>
  </select>
  </td>
  </tr>
<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><b>Les améliorations :</b></td>
</tr>

<tr>
  <td height="15">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="main">Quelles suggestions pouvez-vous nous faire pour améliorer nos services</td>

</tr>
<tr>
  <td  height="30">
    <textarea name="proposition" style="width:250px;height:50px;"></textarea>
  </td>
  </tr>
 <tr>
  <td height="15">&nbsp;</td>
</tr>

<tr>
  <td><input type="submit" name="sending_qualite" value="Envoyer"></td>
</tr> 
</table>

</form>
<?php
}
?>