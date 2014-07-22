<?php

// include('../ip2locationlite.class.php');
 
//Load the class
// $ipLite = new ip2location_lite;
// $ipLite->setKey('c79338460e46d90fbf9f3d384c2e75b18e8eb7156a4d65e393293831da6fb58d');
 
//Get errors and locations
// $locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
// $errors = $ipLite->getError();

  include 'includes/application_top.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(FCKEDITOR)
{
    include 'fckeditor/header_fck.php';
}
?>
<title>Administration</title>
<link href="css/Admin.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id='global'>
<?php
  include 'includes/MainMenu.php';
  include 'includes/container.php';
?>
</div>
<div style="text-align:center;margin-top:5px;padding:3px;"><a href="identification.php?logoff" style="color:#ccc;font-family:verdana;font-size:11px;">- déconnexion -</a></div>
</body>
</html>
