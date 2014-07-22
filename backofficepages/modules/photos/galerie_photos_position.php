<!-- modules  >- id_module=2 -->
<?php
if(isset($_POST['save']))
{
      // on suppprime module 1
      $sql='delete from '.PREFIXE_BDD.'module_to_page where id_module="2"';
      mysql_query($sql);
      
      
      // on réenregistre les positions et par langue!
       // liste des langues
  $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
  $res=mysql_query($sql);
  while($row=mysql_fetch_array($res))
  {
      //cas de chaque langue
      if(isset($_POST['id_page_'.$row['symbol']]))
      for($i=0;$i<count($_POST['id_page_'.$row['symbol']]);$i++)
      {
          $sql='insert into '.PREFIXE_BDD.'module_to_page (id_page,id_module) values ("'.$_POST['id_page_'.$row['symbol']][$i].'","2")';
          mysql_query($sql);
      }
  }   

}
?>
<h1>Galerie photos</h1>

<em>Choisir les emplacements pour la galerie photos</em>
<div style="margin-top:15px;">
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php
  // liste des langues
  $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
  $res=mysql_query($sql);
  while($row=mysql_fetch_array($res))
  {
      ?>
        <div style="float:left;width:400px;padding:5px;border:1px solid #000;margin-right:30px;background:#fff;min-height:200px;margin-bottom:30px;">
          <div><b><?php echo stripslashes($row['titre']); ?></b></div>
          <div style="margin-top:10px;">
            <select name="id_page_<?php echo $row['symbol']; ?>[]" multiple="multiple" size="10" style="width:100%;border:0px;">
		        <?php
                // on recupere les pages
                $sql='select * from '.PREFIXE_BDD.'pages where parent_id="0" and language="'.$row['symbol'].'" order by ordre_affichage,id_page';
                
                $res_page=mysql_query($sql);
                while($row_page=mysql_fetch_array($res_page))
                {
                    echo '<option value="'.$row_page['id_page'].'"';
                    // on teste si la page est selectionnée
                    $sql_test='select * from '.PREFIXE_BDD.'module_to_page where id_module="2" and id_page="'.$row_page['id_page'].'"';
                    $res_test=mysql_query($sql_test);
                    if(mysql_num_rows($res_test)==1) echo ' selected '; 
                    
                    echo '>'.stripslashes($row_page['titre']).'</option>';
                    // on recupere sous page
                    $sql='select * from '.PREFIXE_BDD.'pages where parent_id="'.$row_page['id_page'].'" order by ordre_affichage,id_page';
                    $res_sous_pages=mysql_query($sql);
                    while($row_sous_page=mysql_fetch_array($res_sous_pages))
                    {
                      echo '<option value="'.$row_sous_page['id_page'].'" style="font-size:11px;"';
                      $sql_test='select * from '.PREFIXE_BDD.'module_to_page where id_module="2" and id_page="'.$row_sous_page['id_page'].'"';
                      $res_test=mysql_query($sql_test);
                      if(mysql_num_rows($res_test)==1) echo ' selected '; 
                      echo '>&nbsp;&nbsp; - '.stripslashes($row_sous_page['titre']).'</option>';
                    }
                }
              ?>
	           </select>
              
          </div>
        </div>
      <?php
  }
?>
<div style="clear:left;"></div>
<input type="submit" name="save" value="Enregistrer">
</form><br />
</div>
<em>Pour un choix multiple utilisez la touche "Ctrl"</em>