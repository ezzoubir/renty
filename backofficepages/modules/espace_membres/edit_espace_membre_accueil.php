<?php
if($_GET['action']=='edit_espace_membre_accueil_non_connecte')
  $statut_connecte=0;
if($_GET['action']=='edit_espace_membre_accueil')
  $statut_connecte=1;

if(isset($_POST['save']))
{
    
    // maj du texte 
    $sql='update  '.PREFIXE_BDD.'membres_accueil set texte="'.addslashes($_POST['content']).'" where id_page="'.$_POST['id_page'].'"';
    mysql_query($sql);
   
}
?>

<h1>Page d'accueil espace membre <?php if($statut_connecte==0) echo '(non connecté)'; else echo '(connecté)'; ?></h1>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<div style="margin-bottom:15px;">
<select name="language" onchange="this.form.submit();">
<option value="null">-- Choisir une langue --</option>
<?php
  // on recupere leslangues disponibles
  $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
  $res=mysql_query($sql);
  while($row=mysql_fetch_array($res))
  {
      echo '<option value="'.$row['symbol'].'"';
      if(isset($_POST['language']) && $_POST['language']==$row['symbol']) echo ' selected ';
      echo '>'.stripslashes($row['titre']).'</option>';
  }
?>
</select>
</div>
<?php
  if(isset($_POST['language']))
  {
  
       include '../tiny_mce/header_tiny_mce_admin.php';

        
        // on teste si la page existe
        $sql='select * from '.PREFIXE_BDD.'membres_accueil where statut_connecte="'.$statut_connecte.'" and language="'.$_POST['language'].'"';
        $res=mysql_query($sql);
        if(mysql_num_rows($res)==0)
        {
            // creation de la page
            $sql='insert into '.PREFIXE_BDD.'membres_accueil (statut_connecte,language) values("'.$statut_connecte.'","'.$_POST['language'].'")';
            $res=mysql_query($sql);
            $id_page=mysql_insert_id();
        }
        else
        {
            $row=mysql_fetch_array($res);
            $id_page=$row['id_page'];
        }
        
        if(isset($id_page))
        {
            ?>
            <textarea style="width:100%;height:400px;" name="content"><?php if(isset($row['texte'])) echo stripslashes($row['texte']); ?></textarea>
            <br />
            <input type="submit" name="save" value="Enregistrer">
            <input type="hidden" name="id_page" value="<?php echo $id_page; ?>">
            <?php
        }
        
  }

?>
</form>