<?php
  session_start();
  if(!isset($_SESSION['admin']))
  {
      header('LOCATION:identification.php');
  }
  $_SESSION['dossier_membre']='';
  
  include '../includes/config.php';
  $link =@mysql_connect(SQL_SVR,SQL_LOGIN,SQL_PASS); 
  @mysql_select_db(SQL_DATABASE);
  mysql_query("SET CHARACTER SET 'utf8';", $link)or die(mysql_error());
  mysql_query("SET NAMES 'UTF8' ");
 

  if(isset($_GET['action']) && $_GET['action']=='exporter_xls_mailing_list')
  {
      include 'modules/newsletter/exporter_xls.php';
      exit();
  }
  if(isset($_GET['action']) && $_GET['action']=='newsletter_envoyer')
  {
      include 'modules/newsletter/newsletter_application_top.php';
  
  }
  
   include 'functions/global.php';

?>