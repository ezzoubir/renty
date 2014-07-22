<?php
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=export_" . date("d-m-Y").".xls");
$nb_enregistrement=0;

$condition='';
//if(isset($_GET['langue']))
//  $condition=' where language="'.$_GET['langue'].'" ';

//$sql='select id_email,email,language from '.PREFIXE_BDD.'newsletter_emails '.$condition.' order by email';

$sql=base64_decode($_GET['C']);
$res=mysql_query($sql);
if($res)
   $nb_enregistrement = mysql_num_rows($res);
    $xls_output= "E-mail";
    $xls_output.= "\t";
    $xls_output.= "Nom";
    $xls_output.= "\t";
    $xls_output.= utf8_decode("Prénom");
    $xls_output.= "\t";
    $xls_output.= "Tel";
    $xls_output.= "\t";
    $xls_output.= "Ville";
    $xls_output.= "\t";
    $xls_output.= "Pays";
    $xls_output.= "\t";
    $xls_output.= "Type inscription";
    $xls_output.= "\t";
    $xls_output.= "Langue";
    $xls_output.= "\n";
  for ($i=0;$i<$nb_enregistrement;$i++)
  {
    $row=mysql_fetch_array($res);
    $xls_output .= $row['email'];
    $xls_output .= "\t";
    $xls_output .= utf8_decode($row['nom']);
    $xls_output .= "\t";
    $xls_output .= utf8_decode($row['prenom']);
    $xls_output .= "\t";
    $xls_output .= utf8_decode($row['tel']);
    $xls_output .= "\t";
    $xls_output .= utf8_decode($row['ville']);
    $xls_output .= "\t";
    $xls_output .= utf8_decode($row['pays']);
    $xls_output .= "\t";
    $xls_output .= utf8_decode($row['type_inscription']);
    $xls_output .= "\t";
    $xls_output .= $row['language'];
	  $xls_output .= "\n";
  }

print $xls_output;

?>