<?php
  include '../../../includes/config.php';

 session_start();
  if(!isset($_SESSION['admin']))
  {
      header('LOCATION:identification.php');
  }

  $link =@mysql_connect(SQL_SVR,SQL_LOGIN,SQL_PASS); 
  @mysql_select_db(SQL_DATABASE);
  mysql_query("SET CHARACTER SET 'utf8';", $link)or die(mysql_error());
  mysql_query("SET NAMES 'UTF8' ");
  
  
  // on recupere les infos contact
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_exp"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('EMAIL_EXP',$row['config_value']);
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_admin1"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('EMAIL_ADMIN',$row['config_value']);
  $sql='select config_value from '.PREFIXE_BDD.'config where config_name="Email_admin2"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res);
  DEFINE ('EMAIL_ADMIN2',$row['config_value']);
  
  include '../../../class/phpmailer.class.inc.php';
  
  // on recupere message email
  $sql='select * from '.PREFIXE_BDD.'newsletter_archive where statut="0"';
  $res_message=mysql_query($sql);
  $row_message=mysql_fetch_array($res_message);
  
  $OBJET=stripslashes($row_message['objet']);
  $TEXTE=stripslashes(str_replace('/images/',BASE_URL.'images/',$row_message['texte']));
  if($row_message['language']=='ar') $BODY='<body dir="rtl">'; else $BODY='<body>';
  
  $TEXTE='
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>'.stripslashes($row_message['objet']).'</title>
  </head>
  '.$BODY.'
  
  '.$TEXTE.'</body></html>';
  
  // on recupere la liste des emails
  $sql='select * from '.PREFIXE_BDD.'newsletter_sending_tmp order by email';
  $res=mysql_query($sql);
  $z=0;

  while($row=mysql_fetch_array($res))
  {
      if($z<30)
      {
        $mail = new PHPmailer();
        $mail->IsHTML(true);
        $mail->From=EMAIL_EXP;
        $mail->FromName=stripslashes(BASE_URL);
        $mail->Subject=$OBJET;
        $mail->AddReplyTo(EMAIL_ADMIN);//$EmailExp
        $mail->AddAddress($row['email']);
        $mail->Body=stripslashes($TEXTE);
        $mail->Send();  
        
        // on supprimer email dans colone temp
        $sql_='delete from '.PREFIXE_BDD.'newsletter_sending_tmp where id="'.$row['id'].'"';
        mysql_query($sql_); 
        unset($mail);
      }
      else
      {
          header('LOCATION:traitement_envoie.php');
      }
      $z++;
  }
  
  // on passe arcchive staut = 1
  $sql='update '.PREFIXE_BDD.'newsletter_archive set statut="1" where statut="0"';
  mysql_query($sql);
  
  
  
?>
<script type="text/javascript">
  parent.document.getElementById('statut').innerHTML="<div style='text-align:center;color:red;'>Envoie terminé. Ce courrier est archivé</div>";
</script>
