<?php
  // on recupere infos membre
  $sql='select * from '.PREFIXE_BDD.'membres where id_membre="'.(int)$_GET['id_membre'].'"';
  $res=mysql_query($sql);
  if(mysql_num_rows($res)==1)
  {
  $row_membre=mysql_fetch_array($res);
  
  if(isset($_POST['save']))
  {
      // enregistrement 
      $sql='update '.PREFIXE_BDD.'membres_page set text="'.addslashes($_POST['content']).'" where id_membre="'.$row_membre['id_membre'].'"';
      mysql_query($sql);
  
  }
  
  
  ?>
  <h1>Page dédiée au membre <?php echo stripslashes($row_membre['prenom'].' - '.$row_membre['nom'].' / '.$row_membre['email']); ?></h1>
  <?php
  // creation / modification page perso du membre
  // on teste si sa page existe
  $sql='select * from '.PREFIXE_BDD.'membres_page where id_membre="'.$row_membre['id_membre'].'"';
  $res_page=mysql_query($sql);
  if(mysql_num_rows($res_page)==0)
  {
      // creation de sa page
      $sql='insert into '.PREFIXE_BDD.'membres_page (id_membre) values("'.$row_membre['id_membre'].'")';
      mysql_query($sql);
      $sql='select * from '.PREFIXE_BDD.'membres_page where id_membre="'.$row_membre['id_membre'].'"';
      $res_page=mysql_query($sql);
  
  }
  
  $row_page=mysql_fetch_array($res_page);  
    include '../tiny_mce/header_tiny_mce_admin.php';
  ?>
  <form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
    
    <textarea name="content" style="width:100%;height:400px;"><?php echo stripslashes($row_page['text']); ?></textarea>
    <br />
    <input type="submit" name="save" value="Enregistrer">
  </form>
  <?php

}
?>
