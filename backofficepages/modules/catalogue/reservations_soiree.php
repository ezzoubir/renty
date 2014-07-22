<?php

  function getPageText($id)
  {
        $sql='select * from  '.PREFIXE_BDD.'pages where id_page="'.(int)$id.'"';
        $res=mysql_query($sql);
        $row=mysql_fetch_array($res);
        //images n'a pas le bon repertoire
        
        $row['texte']=str_replace('../images/pages/','images/pages/',$row['texte']);
        return stripslashes($row['texte']);

  }

  if(isset($_POST['delete']))
  {
      $id_commande=GetImageButtonValue($_POST['delete']);
      $sql='delete from cms_v2_catalogue_commandes_amis  where id_commande="'.$id_commande.'"';
      mysql_query($sql);
      
      $sql='delete from cms_v2_catalogue_commandes  where id_commande="'.$id_commande.'"';
      mysql_query($sql);
  }

  if(isset($_POST['save']))
  {
      //$id_commande=GetImageButtonValue($_POST['statut_paiement']);
      $id_commande=GetImageButtonValue($_POST['save']);
      $sql='update cms_v2_catalogue_commandes set statut_paiement="'.$_POST['statut_paiement'][$id_commande].'" where id_commande="'.$id_commande.'"';
      mysql_query($sql);
      
      if($_POST['statut_paiement'][$id_commande]==1)
      {
            // on recupere la langue du visiteur
            $sql='select language,nom,prenom,email,mail_sent,id_commande from cms_v2_catalogue_commandes where id_commande="'.$id_commande.'"';
            $res=mysql_query($sql);
            $ro=mysql_fetch_array($res);
            
            if($ro['mail_sent']==0)
            {
            if($language=='fr')
            {
              $msg_header='Bonjour '.stripslashes($ro['prenom'].' '.$ro['nom']).',<br /><br />';
              // on recupere mail personalisé !!!!
              $body=getPageText(300);
              
            }
            else
            {
                $msg_header='Hello '.stripslashes($ro['prenom'].' '.$ro['nom']).',<br /><br />';
                $body=getPageText(400);
            
            }
            
            $msg_end='<br /><a href="'.BASE_URL.'print_order.php?id_commande='.$ro['id_commande'].'">'.BASE_URL.'print_order.php?id_commande='.$ro['id_commande'].'</a>';
      
      
            $msg=$msg_header.$body.$msg_end;
      
            // traitement envois email 
             include '../class/phpmailer.class.inc.php';
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes(BASE_URL);
        $mail->Subject=stripslashes('['.PREVENTE.']['.BASE_URL.']');
        $mail->AddReplyTo(EMAIL_ADMIN);//$EmailExp
        $mail->AddAddress($ro['email']);
        
        $mail->Body=stripslashes($msg);
        $mail->Send();
        
            
            
            // on informe bdd email envoyé !
            $sql='update cms_v2_catalogue_commandes set mail_sent="1" where id_commande="'.$ro['id_commande'].'"';
            mysql_query($sql);
          }
      }
      
  }
?>

<h1>Liste des réservations</h1>
<form name="form0" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
<div style="margin-bottom:20px;">
  <u>Soirée(s) ayant des réservations</u>
  <div style="margin-top:8px;">
  <select name="id_soiree" onchange="this.form.submit();">
  <?php
    if(!isset($_GET['id_soiree']))
      echo '<option></option>';
  ?>
    <option value="all">Toutes les réservations</option>
    <?php
      $sql='select P.id_produit,P.titre from cms_v2_catalogue_produits P, cms_v2_catalogue_commandes C where C.id_pack=P.id_produit group by P.id_produit';
      $res=mysql_query($sql);
      while($roo=mysql_fetch_array($res))
      {
            echo '<option value="'.$roo['id_produit'].'"';
            if(isset($_GET['id_soiree']) && $_GET['id_soiree']==$roo['id_produit']) echo ' selected ';
            echo '>'.stripslashes($roo['titre']).'</option>';
      
      }
    ?>
  </select>
  <input type="hidden" name="action" value="reservations_soiree">
  </div>
</div>
</form>
<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
 <?php
   if(isset($_GET['id_soiree']))
  {
    if($_GET['id_soiree']=='all')
      $sql='select * from cms_v2_catalogue_commandes order by statut_paiement,id_commande DESC';
    else
      $sql='select * from cms_v2_catalogue_commandes where id_pack="'.(int)$_GET['id_soiree'].'" order by statut_paiement,id_commande DESC';
  
    $affichage_soirees=true;
  }
     if(isset($affichage_soirees))
    {
 ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td><?php if($_GET['id_soiree']!='all'){
       ?><a href="packs_check_list.php?id_soiree=<?php echo (int)$_GET['id_soiree']; ?>" target="_blank">Exporter liste packs</a><?php } ?></td><td></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
  <th style="text-align:left;">Id Cmd (ref paypal)</th>
  <th style="text-align:left;">Language</th>
  <th style="text-align:left;">Nom</th>
  <th style="text-align:left;">Prénom</th>
  <th style="text-align:left;">email</th>
  <th>Fonction(s)</th>
  </tr>
  <?php
  


    $res=mysql_query($sql);
    while($row=mysql_fetch_array($res))
    {
        ?>
          <tr>
            <td style="text-align:left;color:red;"><?php echo $row['id_commande']; ?></td>
            <td style="text-align:left;color:red;"><?php echo $row['language']; ?></td>
            <td style="text-align:left;"><?php echo stripslashes($row['nom']); ?></td>
            <td style="text-align:left;"><?php echo stripslashes($row['prenom']); ?></td>
            <td style="text-align:left;"><a href="mailto:<?php echo stripslashes($row['email']); ?>"><?php echo stripslashes($row['email']); ?></td>
            <td>
            <a style="font-size:11px;margin-right:20px;" href="../print_order.php?id_commande=<?php echo $row['id_commande']; ?>" target="_blank">Editer commande</a>
            
            <input style="margin-left:10px;" type="image" name="delete[<?php echo $row['id_commande']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Supprimer la commande N°<?php echo $row['id_commande']; ?>  ?")){this.submit();} else return false;'>
            </td>
          </tr>
          <tr>
            <td colspan="6" style="border-bottom:2px solid #000;">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tr>
                  <td colspan="7"  style="text-align:left;border-bottom:1px solid #ccc;"><b>Détails paiement</b></td>
                </tr>
                <tr>
                  <td style="text-align:left;" colspan="7">Soirée : 
                  <?php
                    // on recupere id_produit
                    $sql='select * from cms_v2_catalogue_produits where id_produit="'.$row['id_pack'].'"';
                    $res_pa=mysql_query($sql);
                    if(mysql_num_rows($res_pa)==1)
                    {
                    $ro=mysql_fetch_array($res_pa);
                    
                        echo stripslashes($ro['titre']);
                    }
                    else
                    {
                        ?>
                          Soirée effacée du catalogue
                        <?php
                    }
                    
                    
                  ?>
                  </td>
                </tr>
                <tr>
                    <td style="text-align:left;"></td>
                    
                    <td style="text-align:left;">Quantité de pack(s) : <?php echo stripslashes($row['nbr_produits']); ?> </td>
                    <td style="text-align:left;">Sous total : <?php echo stripslashes($row['stotal']); ?> €</td>
                    <td style="text-align:left;">Frais paypal : <?php echo stripslashes($row['frais_paypal']); ?> €</td>
                    <td style="text-align:left;">Total : <?php echo stripslashes($row['total']); ?> €</td>
                    <td style="text-align:right;padding-right:10px;">
                    <select name="statut_paiement[<?php echo $row['id_commande']; ?>]"><option value="1" <?php if($row['statut_paiement']==1) echo ' selected '; ?>>Payé</option><option value="0" <?php if($row['statut_paiement']==0) echo ' selected '; ?>>Non payé</option></select>
                     <input type="image" name="save[<?php echo $row['id_commande']; ?>]" src="imgs/floppy_disk16.gif">
                    
                    </td>
                </tr>
                <tr>
                <td colspan="5" style="text-align:left;">
                <?php
                  $sql='select * from cms_v2_catalogue_commandes_amis where id_commande="'.$row['id_commande'].'"';
                  $res_amis=mysql_query($sql);
                  if(mysql_num_rows($res_amis)>0)
                  {
                ?>
                <div style="margin-top:10px;">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                      <td style="text-align:left;" width="200">
                        <u>Nom - prénom personne(s)</u>
                      </td>
                      <td style="text-align:left;"><u>Nom du pack</u></td>
                    </tr>
                    <?php
                    while($row_amis=mysql_fetch_array($res_amis))
                    {
                        ?>
                        <tr>
                          
                          <td style="border-top:1px dashed #000;text-align:left;"><em><?php echo stripslashes($row_amis['nom'].' - '.$row_amis['prenom']); ?></em></td>
                          
                          <td style="border-top:1px dashed #000;text-align:left;"><em><?php echo stripslashes($row_amis['titre_pack']); ?></em></td>
                        </tr>
                        <?php
                    }
                    ?>
                  </table>
                  </div>
                <?php
                }
                ?>
                </td>
                </tr>
              </table>
            </td>
          </tr>
        <?php
    }
  
  ?>
</table>
<?php
}
?>