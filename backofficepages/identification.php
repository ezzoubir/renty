<?php
  session_start();
  
  if(isset($_GET['logoff']))
      unset($_SESSION['admin']);
      
  include '../includes/config.php';

  
    if(isset($_POST['LOGIN_FORM_ENVOYER']))
    {
        if(($_POST['FORM_LOGIN']==LOGIN_ADMIN && md5($_POST['FORM_PASSWORD'])==PASSWORD_ADMIN)||($_POST['FORM_LOGIN']==LOGIN_SUPER_ADMIN && md5($_POST['FORM_PASSWORD'])==PASSWORD_SUPER_ADMIN))
        {
            $_SESSION['admin']=true;
            header('LOCATION:index.php');
        }
        else
        {
            $erreur='Erreur sur l\'identifiant et/ou le mot de passe';
            unset($_SESSION['admin']);
        }
        
    
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration</title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:#333;">
<div style="text-align:center;font-family:verdana;">
    <h1 style="color:#fff;">Administration / Site internet</h1>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
<div style="margin-top:15px;">
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td style="padding:10px;border:3px solid #f66000;">
<?php
  if(isset($erreur))
  {
    ?>
      <div style="color:red;margin-bottom:15px;"><?php echo $erreur; ?></div>
    <?php
  }
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

  <tr>
    <td style="text-align:left;">Nom d'utilisateur : </td>
    <td height="25" style="text-align:left;"><input type="text" name="FORM_LOGIN" class="main" style="border:1px solid #000;width:150px;"></td>
  </tr>
    <tr>
    <td height="25" style="text-align:left;">Mot de passe </td>
    <td style="text-align:left;"><input type="password" name="FORM_PASSWORD" class="main" style="border:1px solid #000;width:150px;"></td>
  </tr>
 <tr>
 
  <tr>
    <td></td>
    <td height="35"><input class="main" type="submit" name="LOGIN_FORM_ENVOYER" value="Connexion" style="border:1px solid #000;"></td>
  </tr>
</table>
</td>
</tr>
</table>
</div>
</form>
    
</div>
</body>
</html>
