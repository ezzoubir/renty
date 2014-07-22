<?php
    include 'includes/application_top.php';
    
    if(isset($_GET['id_soiree']))
    {
        if($_GET['id_soiree']=='all')
        {
        
        }
        else
        {
              // on recupere les packs et les commandes associés
              // nom de la soirée :
              $sql='select * from cms_v2_catalogue_produits where id_produit="'.(int)$_GET['id_soiree'].'"';
              $res=mysql_query($sql);
              $ro=mysql_fetch_array($res);
              define('TITRE_SOIREE',stripslashes($ro['titre']));
        
              $contenu_liste='';
              // liste des packs
              $sql='select * from cms_v2_catalogue_produits_packs where id_produit="'.(int)$_GET['id_soiree'].'" order by id_pack';
              $res=mysql_query($sql);
              while($ro=mysql_fetch_array($res))
              {
                  $contenu_liste.='<h2>'.stripslashes($ro['titre']).'</h2>';
                  // liste des nom associés
                  $sql='select * from cms_v2_catalogue_commandes_amis where id_pack="'.$ro['id_pack'].'" order by nom';
                  $res_personne=mysql_query($sql);
                  
                  $contenu_liste.='<table width="800" border="0" cellpadding="0" cellspacing="0">';
                  $contenu_liste.='<tr><th style="text-align:left;" width="200" valign="top">Nom</th><th  width="200" style="text-align:left;" valign="top">Prénom</th><th width="200" valign="top">Statut commande <div style="font-size:10px;">('.date('d/m/Y').')</div></th><th width="200" valign="top">Commande réalisée par :</th>';
                  while($row_personne=mysql_fetch_array($res_personne))
                  {
                  $contenu_liste.='<tr><td style="text-align:left;padding:3px;">'.stripslashes($row_personne['nom']).'</td><td style="text-align:left;padding:3px;">'.stripslashes($row_personne['prenom']).'</td>';
                  
                  // on recupere staut de la commande
                  $sql='select * from cms_v2_catalogue_commandes where id_commande="'.$row_personne['id_commande'].'"';
                  //echo $sql;
                  
                  $res_c=mysql_query($sql);
                  $ro_c=mysql_fetch_array($res_c);
                  $contenu_liste.='<td style="text-align:center">';
                  if($ro_c['statut_paiement']==1)  $contenu_liste.='ok';
                  else $contenu_liste.='En attente';
                  
                  $contenu_liste.='</td>';
                  $contenu_liste.='<td style="text-align:center"><em>';
                  $contenu_liste.=stripslashes($ro_c['nom'].' '.$ro_c['prenom']);
                  $contenu_liste.='</em></td>';
                  
                  $contenu_liste.='</tr>';
                  }
                  $contenu_liste.='</table>';
                  
              }
        
        }
    
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body style="font-family:verdana;font-size:10px;">
    <h1><?php echo TITRE_SOIREE; ?></h1>
    
    <?php
      echo $contenu_liste;
    ?>
</body>
</html>