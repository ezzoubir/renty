<?php

if(isset($_POST['upload_csv']))
{
    // upload fichier csv
    include '../class/upload.class.inc.php';
    function ProposeCSV($UploadingFile)
    {
        $charge=false;
        
        //insertion photo traitement 
        $handle = new upload($UploadingFile);
        $handle->file_overwrite = true;
        if ($handle->uploaded)
        {
         
          $FileName='csv';
          $Rep='../'.RepPhoto;
          $ext='.'.$handle->file_src_name_ext;
          $handle->file_new_name_body  = $FileName;
          $handle->process($Rep);
          $charge=true;
            $handle->clean(); 
            unset($handle);
            $file=$FileName.$ext;
            return $file;
        
        }
        else
        return false;
    }
    
    $upload=ProposeCSV($_FILES['csv']);
    if($upload!=false)
    {
        // triatement
        $fichier ='../'.RepPhoto.$upload; 
          $tabfich=file($fichier); 
          for( $i = 0 ; $i < count($tabfich) ; $i++ ) 
          { 
            //echo $tabfich[$i]."<br />";
              
              $champs=explode(',',$tabfich[$i]);    
                    
            if(count($champs)>1 && $champs[0]!='')
            {
            // on teste si email pas deja enregisdtré
            $sql='select * from '.PREFIXE_BDD.'newsletter_emails where email="'.$champs[0].'" and type_inscription="'.$champs[6].'" and language="'.$champs[7].'"';//and language="'.$language.'"
            $res=mysql_query($sql);
            if(mysql_num_rows($res)==0)
            {
                    // insertion
                    $sql='insert into '.PREFIXE_BDD.'newsletter_emails (email,language,nom,prenom,ville,pays,tel,type_inscription) values ("'.$champs[0].'","'.$champs[7].'","'.$champs[1].'","'.$champs[2].'","'.$champs[4].'","'.$champs[5].'","'.$champs[3].'","'.$champs[6].'")';
                    mysql_query($sql);
            }        
             }        
          } 
          
     }
    
    
}
if(isset($_POST['FORM_REGISTER_NEWSLETTER_SUBMIT']))
  {
       $_GET['langue']=$_POST['langue'];
       $_GET['type_inscription']=$_POST['type_inscription'];
        // on teste si mail valide
        //if(TestEmail($_POST['FORM_REGISTER_NEWSLETTER_EMAIL']))
        //{
            // on teste si email pas deja enregisdtré
            $sql='select * from '.PREFIXE_BDD.'newsletter_emails where email="'.$_POST['FORM_REGISTER_NEWSLETTER_EMAIL'].'" and type_inscription="'.$_POST['type_inscription'].'" and language="'.$_POST['langue'].'"';//and language="'.$language.'"
            $res=mysql_query($sql);
            if(mysql_num_rows($res)==0)
            {
                // on peut enregistrer
                $sql='insert into '.PREFIXE_BDD.'newsletter_emails (email,language,nom,prenom,ville,pays,tel,type_inscription) values ("'.$_POST['FORM_REGISTER_NEWSLETTER_EMAIL'].'","'.$_POST['langue'].'","'.$_POST['FORM_REGISTER_NEWSLETTER_NOM'].'","'.$_POST['FORM_REGISTER_NEWSLETTER_PRENOM'].'","'.$_POST['FORM_REGISTER_NEWSLETTER_VILLE'].'","'.$_POST['FORM_REGISTER_NEWSLETTER_PAYS'].'","'.$_POST['FORM_REGISTER_NEWSLETTER_TEL'].'","'.$_POST['type_inscription'].'")';
                mysql_query($sql);
                $inscription_newsletter=INSCRIPTION_NEWSLETTER_SUCCES;
                
            }
            else
            {
            $inscription_newsletter='Déja inscrit sur '.$_POST['type_inscription'];
            }
        //}
       // else
       // {
        //    $inscription_newsletter='email non valide';
            
        //}
        
        // on teste si email existe sur la base
        
        
  
  }
?>
<h1>Mailing-list</h1>
<?php
  if(!isset($_GET['langue'])) $_GET['langue']='';
  
  if(isset($_GET['langue']) && $_GET['langue']!='')
    $condition1=' where language="'.$_GET['langue'].'" ';
  else
    $condition1='';
  
  if(isset($_GET['type_inscription']))
  {
      if($_GET['type_inscription']!='_' && $_GET['type_inscription']!='')
      {
          if($condition1=='')
          {
              $condition1.=' where type_inscription="'.$_GET['type_inscription'].'" ';
          }
          else
          $condition1.=' and type_inscription="'.$_GET['type_inscription'].'" ';
      }
  }
  
  
  if(isset($_POST['delete_email']))
  {
     $id_mail=GetImageButtonValue($_POST['delete_email']);   
     $sql='delete from '.PREFIXE_BDD.'newsletter_emails where id_email="'.$id_mail.'" ';
     mysql_query($sql);
  }
  $sql='select * from '.PREFIXE_BDD.'newsletter_emails'.$condition1;
  $res=mysql_query($sql);
  $TotalEnregistrements=mysql_num_rows($res);
  
  
  $sql_export=$sql;
?>
<h2>Inscrits à la newsletter (<?php //echo $TotalEnregistrements; ?>)</h2>
<?php
  define('NBR_MEMBRE_PAR_PAGE',50);
  $PageNum=1; 
  $NbrPages=ceil($TotalEnregistrements/NBR_MEMBRE_PAR_PAGE);
  if(isset($_GET['num_page']))
    {
      $PageNum=intval($_GET['num_page']);
    }
    
      $Prev=$PageNum;
        if($PageNum>1)
          $Prev=$PageNum-1;
        
        if($PageNum<$NbrPages) 
          $Next=$PageNum+1;
        else $Next=$NbrPages;
        
        $PagesInit=array(0=>1,1=>$Prev,2=>$Next);
        
        $PageEnd=$NbrPages;
    
            if($PageNum>1) // limit pour sql
         $limit0=$PageNum*NBR_MEMBRE_PAR_PAGE-NBR_MEMBRE_PAR_PAGE;
        else $limit0=0;
  
    // on recupere les articles de la pages
  $sql='select * from '.PREFIXE_BDD.'newsletter_emails'.$condition1.' limit '.$limit0.','.NBR_MEMBRE_PAR_PAGE ;
  $res=mysql_query($sql);
  $total=mysql_num_rows($res);

?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get" enctype="multipart/form-data">
  <div style="float:right;margin-bottom:10px;">
  <input type="hidden" name="action" value="newsletter_mailing_list">
  <select name="type_inscription" style="margin-right:15px;" onchange="this.form.submit();">

    <option value="_">Tous</option>
    <option value="site" <?php if(isset($_GET['type_inscription']) && $_GET['type_inscription']=='site') echo ' selected '; ?>>Inscription depuis le site</option>
    <option value="ev1" <?php if(isset($_GET['type_inscription']) && $_GET['type_inscription']=='ev1') echo ' selected '; ?>>Evènement 1</option>
    <option value="ev2" <?php if(isset($_GET['type_inscription']) && $_GET['type_inscription']=='ev2') echo ' selected '; ?>>Evènement 2</option>
  </select>
  <select name="langue" onchange="this.form.submit();">
    <option value="">Toutes les langues</option>
    <?php
  // on recupere leslangues disponibles
  $sql_language='select * from '.PREFIXE_BDD.'languages order by id_language';
  $res_language=mysql_query($sql_language);
  while($row_language=mysql_fetch_array($res_language))
  {
      echo '<option value="'.$row_language['symbol'].'"';
      if(isset($_GET['langue']) && $_GET['langue']==$row_language['symbol']) echo ' selected ';
      echo '>'.stripslashes($row_language['titre']).'</option>';
  }
?>
  </select>
  </div>
  <div style="float:left;margin-top:8px;">
    <a href="index.php?action=exporter_xls_mailing_list&C=<?php echo base64_encode($sql_export); ?>" target="_blank">Exporter</a>
  </div>
  <div style="clear:both"></div>
</form>
<?php
if($total>0)
{
?>

<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
  <th>Id email</th>
  <th>Nom</th>
  <th>Prénom</th>
  <th>Tel</th>
  <th>Ville</th>
  <th>Pays</th>
  <th>Email</th>
  
  <th>Langue</th>
  <th>Inscription</th>
  <th>Fonction</th>
  </tr>
<?php
$bg_cell='#fff';
  while ($row=mysql_fetch_assoc($res))
	{
	 if(ESPACE_MEMBRE && INSCRIPTION_NEWSLETTER)
	 {
      $bg_cell='#fff';
      // on teste si email = membre
      $sql='select * from '.PREFIXE_BDD.'membres where email="'.$row['email'].'"';
      $res_test=mysql_query($sql);
      
      if(mysql_num_rows($res_test)>0)
      {
          $bg_cell='#D8EBA5';
      }
   }
	 ?>
	 <tr>
	 <td style="background:<?php echo $bg_cell; ?>;"><?php echo $row['id_email']; ?></td>
	  <td style="background:<?php echo $bg_cell; ?>;"><?php echo stripslashes($row['nom']); ?></td>
	  <td style="background:<?php echo $bg_cell; ?>;"><?php echo stripslashes($row['prenom']); ?></td>
	  <td style="background:<?php echo $bg_cell; ?>;"><?php echo stripslashes($row['tel']); ?></td>
	  <td style="background:<?php echo $bg_cell; ?>;"><?php echo stripslashes($row['ville']); ?></td>
	  <td style="background:<?php echo $bg_cell; ?>;"><?php echo stripslashes($row['pays']); ?></td>
	 <td style="background:<?php echo $bg_cell; ?>;"><?php echo $row['email']; ?></td>
	 <td style="background:<?php echo $bg_cell; ?>;"><?php echo $row['language']; ?></td>
	 <td style="background:<?php echo $bg_cell; ?>;"><?php echo $row['type_inscription']; ?></td>
   <td style="background:<?php echo $bg_cell; ?>;"> <input style="margin-left:10px;" type="image" name="delete_email[<?php echo $row['id_email']; ?>]" src="imgs/b_drop.gif" onclick='javascript: if(confirm("Supprimer  <?php echo stripslashes($row['email']); ?>  ?")){this.submit();} else return false;'>
   </td>
	 </tr>
	 <?php
	}
?>
  
  </table>
</form>
<?php
  if($NbrPages>1)
{
?>
<div style="margin-top:10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
 <td style="padding-left:20px;padding-top:25px;" height="20" ><?php if($PageNum>1)echo '<div style="float:left;margin-left:3px;">
 <a href="index.php?action=newsletter_mailing_list&num_page=1&langue='.$_GET['langue'].'" style="text-decoration:none;font-weight:bold;">|<</a> 
 <a href="index.php?action=newsletter_mailing_list&num_page='.$Prev.'&langue='.$_GET['langue'].'" style="text-decoration:none;margin-left:10px;"> << </a></div>'; if($NbrPages>$PageNum) echo '<div style="float:right;margin-right:18px;">
 <a href="index.php?action=newsletter_mailing_list&num_page='.$Next.'&langue='.$_GET['langue'].'" style="text-decoration:none;"> >> </a><a href="index.php?action=newsletter_mailing_list&num_page='.$PageEnd.'&langue='.$_GET['langue'].'" style="text-decoration:none;font-weight:bold;margin-left:10px;">>|</a></div>'; ?></td>
</tr>
<tr>
  <td align="center" class="main" style="text-align:center;">Page > <?php echo $PageNum.' / '.$NbrPages; ?></td>
</tr>
</table>
<?php
}
?>
</table></div>
<div style="clear:left;"></div>


<?php
}
?>

<h3>Ajouter</h3>

<?php
  include '../includes/languages/fr.php';
?>
<script type="text/javascript">
function valider_formulaire(frm){
 var erreur=false;
 var msg=" <?php echo FORM_CHAMPS_OBLIGATOIRES; ?> :\r\n";


  if(!echeck(frm.elements['FORM_REGISTER_NEWSLETTER_EMAIL'].value))
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

<hr />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" onSubmit="return valider_formulaire(this);">
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="150">Type :</td>
<td height="30">
<select name="type_inscription" style="margin-right:15px;" onchange="">
    <option value="site" <?php if(isset($_GET['type_inscription']) && $_GET['type_inscription']=='site') echo ' selected '; ?>>Inscription depuis le site</option>
    <option value="ev1" <?php if(isset($_GET['type_inscription']) && $_GET['type_inscription']=='ev1') echo ' selected '; ?>>Evènement 1</option>
    <option value="ev2" <?php if(isset($_GET['type_inscription']) && $_GET['type_inscription']=='ev2') echo ' selected '; ?>>Evènement 2</option>
  </select>

</td>
</tr>
<tr>
  <td>Langue</td><td>
    <select name="langue" onchange="">
    
    <?php
  // on recupere leslangues disponibles
  $sql_language='select * from '.PREFIXE_BDD.'languages order by id_language';
  $res_language=mysql_query($sql_language);
  while($row_language=mysql_fetch_array($res_language))
  {
      echo '<option value="'.$row_language['symbol'].'"';
      if(isset($_GET['langue']) && $_GET['langue']==$row_language['symbol']) echo ' selected ';
      echo '>'.stripslashes($row_language['titre']).'</option>';
  }
?>
  </select>
  
  </td>
</tr>
<tr>
<td width="150"><?php echo FORM_NOM; ?> :</td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_NOM" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_PRENOM; ?> : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_PRENOM" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_TEL; ?> : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_TEL" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_EMAIL; ?> * : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_EMAIL" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_VILLE; ?>  : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_VILLE" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
<td><?php echo FORM_PAYS; ?>  : </td>
<td height="30"><input type="text" name="FORM_REGISTER_NEWSLETTER_PAYS" class="main" style="border:1px solid #A4A4A4;width:156px;color:red;" value="" onclick="this.value='';"></td>
</tr>
<tr>
  <td></td>
  <td height="30"><input type="submit" name="FORM_REGISTER_NEWSLETTER_SUBMIT" value="<?php echo FORM_OK; ?>" class="main" style="border:1px solid #000;color:#000;">
</td>
</tr>
<tr>
  <td style="font-size:10px;" colspan="2"><?php echo '* '. FORM_CHAMPS_OBLIGATOIRES;  ?></td>
</tr>
</table>

</form>

<?php


  if(isset($inscription_newsletter))
  {
      echo '<script type="text/javascript">alert("'.$inscription_newsletter.'");</script>';
  }
  
  
?>
<div style="margin-top:30px;text-align:center;">
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
  Importer fichier csv
  <input type="file" name="csv"><input type="submit" name="upload_csv" value="Importer">
  <br />
  email,nom,prenom,tel,ville,pays,type_inscription,langue [retour à la ligne]
  <br />
  <em>type_inscription  3 valeurs possible : site , ev1 et ev2 <em><br />
  <br />
  Langue : fr ou en
  <br />
  Séparateur de champs : ","
  <br />
  Enregistrement: 1 ligne
  
  
</form>
</div>
