<div style="margin-bottom:15px;">
<a href="index.php?language=<?php echo $language; ?>&page&espace_membre&page_perso&id=26" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;">Informations Pro   </a>
<a href="index.php?language=<?php echo $language; ?>&page&espace_membre&page_perso&id=27" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;">Photothèque   </a>
<a href="index.php?language=<?php echo $language; ?>&page&espace_membre&page_perso&id=28" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;">Climcover fait « l'actu »  </a>
<a href="index.php?language=<?php echo $language; ?>&page&espace_membre&page_perso&id=29" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;">Evenements   </a>
<?php
  if(GESTION_ESPACE_MEMBRE_PRIVILEGE && PUBLICATION_ARTICLES)
  {
  // on teste si membre peux modifier / ajouter des articles
      $sql='select * from '.PREFIXE_BDD.'articles where id_utilisateur="'.$_SESSION['id_membre'].'"';
      $res_=mysql_query($sql);
      if(mysql_num_rows($res_)>0)
      {
          ?>
            <a href="index.php?language=<?php echo $language; ?>&page&espace_membre&mes_articles" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;"><?php echo MES_ARTICLES; ?></a>
          <?php
      }
  // on teste si membre possede des article
  }
  
  // on teste si membre à sa page perso

  $sql='select * from '.PREFIXE_BDD.'membres_page where id_membre="'.$_SESSION['id_membre'].'"';
  $res_=mysql_query($sql);
  if(mysql_num_rows($res_)>0)
  {
      $row_=mysql_fetch_array($res_);
      if($row_['text']!='')
      {
          // des infformations
          ?>
            <a href="index.php?language=<?php echo $language; ?>&espace_membre&page_perso&page" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;"><?php echo ESPACE_MEMBRE_DONNEES_RESERVEES; ?></a>
          <?php
      }
  
  }
?>
 <a href="index.php?language=<?php echo $language; ?>&espace_membre&mes_infos&page" style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;"><?php echo ESPACE_MEMBRE_MES_INFORMATIONS; ?></a>
 <?php
  if(WEBMAIL_URL!='')
  {
  ?>
    <a href="<?php echo WEBMAIL_URL; ?>"   style="margin-<?php if($language=='ar')echo 'left';else echo 'right';?>:15px;" target="_blank"><?php echo WEBMAIL; ?></a>
  <?php
  }
 ?>
 
<a href="index.php?language=<?php echo $language; ?>&page&espace_membre&logoff"><?php echo DECONNEXION; ?></a>
</div>