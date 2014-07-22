<h1>Envoyer une newsletter</h1>
<?php
  // on teste si un envoi est en cours...
  $sql='select * from '.PREFIXE_BDD.'newsletter_sending_tmp order by email';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)==0)
  {
  // on supprime les lettre à statut 0
  $sql='delete from '.PREFIXE_BDD.'newsletter_archive where statut="0"';
  mysql_query($sql);
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <th style="text-align:left;">Public</th><td style="text-align:left;">
    <select name="public">
      <option value="all">Tous</option>
      <option value="6">Inscription depuis le site</option>
      <option value="7">Evènement 1</option>
      <option value="8">Evènement 2</option>
      <?php
      if(ESPACE_MEMBRE)
      {
      ?>
      <option value="1">Membres</option>
      <?php
      if(GESTION_ESPACE_MEMBRE_PRIVILEGE)
      {
      ?>
      <option value="2">Membres avec privilèges</option>
      <option value="3">Membres sans privilèges</option>
      <?php
      }
      ?>
      <option value="4">Membres inscrits à la newsletter</option>
      <?php
      }
      ?>
      <!--<option value="6">Inscrits à la newsletter</option>-->
    </select>
    </td>
  </tr>
  <tr>
    <th style="text-align:left;">Langue</th>
    <td style="text-align:left;">
    <select name="langue">
    <option value="all">Toutes</option>
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
  <th style="text-align:left;">Pays</th>
  <td style="text-align:left;">
    <select name="pays">
    <option value="all">Tous</option>
    <option value="france">France</option>
    <option value="etranger">Etranger</option>
    </select>
  </td>
  </tr>
  <tr>
    <th style="text-align:left;">Objet du courrier</th><td style="text-align:left;"><input type="text" name="objet" value="" style="width:250px;" /></td>
  </tr>
  <tr>
    <th  style="text-align:left;" valign="top">
        Lettre
    </th>
    <td>
    <?php
      include '../tiny_mce/header_tiny_mce_admin.php';
    ?>
    <textarea style="width:100%;height:400px;" name="content"></textarea>
    </td>
  </tr>
  <tr>
    <td></td><td style="text-align:left;"><input type="submit" name="SEND_NEWSLETTER" value="Envoyer" onclick='javascript: if(confirm("Envoyer la newsletter ?")){this.submit();} else return false;' ></td>
  </tr>
  </table>
</form>
<?php
  }
  else
  {
      //animation newsletter en cour d'envois
      ?>
          <div align="center" id="statut">
          <br />
          Veuillez patienter quelques instants... <br />Traitement en cours...
          <br />
          <br />
            <img src="../images/loading.gif">
          </div>
          <iframe src="modules/newsletter/traitement_envoie.php" style="display:none;"></iframe>
      <?php
  }
?>