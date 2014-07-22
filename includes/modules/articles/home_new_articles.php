<?php

  include 'class/class.html2text.inc.php';
  
  // on recupere les 2 derniers articles
  $sql='select * from '.PREFIXE_BDD.'articles where id_page!="0" and language="'.$language.'" order by id_article DESC limit 2';
  $rs=mysql_query($sql);
  if(mysql_num_rows($rs)>0)
  {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr> 
<td style="padding:2px;font-family:verdana">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>  
    <td style="background:#E9E9E9;min-height:208px;border-right:1px solid #ccc;padding:15px;" width="50%" valign="top">
    <?php
      $row_article=mysql_fetch_array($rs);
      ?>
      <div class="global_article" style="margin-bottom:20px;" <?php if($language=='ar') echo 'dir="rtl"'; ?>
                
                <div class="container_article" style="font-size:11px;font-family:verdana;">
                
                <?php
                  if($row_article['image']!='')
                  {
                      ?>
                      <div style="float:left; margin-right:5px;margin-bottom:0px;"><img src="<?php echo RepPhoto.'mins/'.$row_article['image']; ?>" width="100" alt="<?php echo stripslashes($row_article['titre']); ?>"> </div>
                      <?php
                      
                  }
                ?>
                <?php
                  echo '<div style="font-weight:bold;color:red;font-family:verdana;font-size:11px;">'.stripslashes($row_article['titre']).'</div>';
                 $h2t =& new html2text(stripslashes($row_article['texte']));
                $row_article['texte'] = $h2t->get_text(); 
                  echo '<div style="font-size:11px;">'.stripslashes($row_article['texte']).'</div>';
                ?>
                </div>
                <table border="0" cellpadding="0" cellspacing="0" <?php if($language!='ar') echo 'align="right"'; else echo 'align="left"'; ?><?php if($language=='ar') echo ' dir="rtl" '; ?>>
                <tr>
                <?php
                  if(isset($row_article['texte_suite']) && $row_article['texte_suite']!='')
                  {
                    echo '<td ';
                     if($language!='ar') echo 'align="right"'; else echo 'align="left"'; 
                    echo '><a href="index.php?lecture_article='.$row_article['id_article'].'&language='.$language.'&page='.$row_article['id_page'];
                    //if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage'];
                    
                    echo '" style="font-size:11px;">'.LIRE_LA_SUITE.'</a></td><td ';
                    if($language!='ar') echo 'align="right"'; else echo 'align="left"'; 
                    echo '>&nbsp;&nbsp;&nbsp;<a href="index.php?lecture_article='.$row_article['id_article'].'&language='.$language.'&page='.$row_article['id_page'];
                   // if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage'];
                    
                    echo '" style="font-size:11px;"><img src="images/global/lire_article';
                    if($language=='ar') echo '_ar';
                    echo '.png" border="0"></a> </td>';
                   } 
                    // si article du membre modification possible et suppressio
                    if(isset($_SESSION['id_membre']) && $_SESSION['id_membre']==$row_article['id_utilisateur'])
                    {
                        if(isset($_GET['page']) && $_GET['page']!='')
                        {
                       
                        }
                        else
                        {
                        ?>
                        <?php
                        if($row_article['id_page']!=0)
                        {
                       
                         }
                         
                        }
                    }
                  
                ?>
                </tr>
                </table>
              </div>
      
      
      
    
    </td>
    <td style="background:#E9E9E9;min-height:208px;padding:15px;" width="50%" valign="top">
    <?php
      $row_article=mysql_fetch_array($rs);
      ?>
      <div class="global_article" style="margin-bottom:20px;" <?php if($language=='ar') echo 'dir="rtl"'; ?>
                
                <div class="container_article" style="font-size:11px;font-family:verdana;">
                
                <?php
                  if($row_article['image']!='')
                  {
                      ?>
                      <div style="float:left; margin-right:5px;margin-bottom:0px;"><img src="<?php echo RepPhoto.'mins/'.$row_article['image']; ?>" width="100" alt="<?php echo stripslashes($row_article['titre']); ?>"> </div>
                      <?php
                      
                  }
                ?>
                <?php
                  echo '<div style="font-weight:bold;color:red;font-family:verdana;font-size:11px;">'.stripslashes($row_article['titre']).'</div>';
                $h2t =& new html2text(stripslashes($row_article['texte']));
                $row_article['texte'] = $h2t->get_text(); 
                  echo '<div style="font-size:11px;">'.stripslashes($row_article['texte']).'</div>';
                ?>
                </div>
                <table border="0" cellpadding="0" cellspacing="0" <?php if($language!='ar') echo 'align="right"'; else echo 'align="left"'; ?><?php if($language=='ar') echo ' dir="rtl" '; ?>>
                <tr>
                <?php
                  if(isset($row_article['texte_suite']) && $row_article['texte_suite']!='')
                  {
                    echo '<td ';
                     if($language!='ar') echo 'align="right"'; else echo 'align="left"'; 
                    echo '><a href="index.php?lecture_article='.$row_article['id_article'].'&language='.$language.'&page='.$row_article['id_page'];
                    //if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage'];
                    
                    echo '" style="font-size:11px;">'.LIRE_LA_SUITE.'</a></td><td ';
                    if($language!='ar') echo 'align="right"'; else echo 'align="left"'; 
                    echo '>&nbsp;&nbsp;&nbsp;<a href="index.php?lecture_article='.$row_article['id_article'].'&language='.$language.'&page='.$row_article['id_page'];
                    //if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage'];
                    
                    echo '" style="font-size:11px;"><img src="images/global/lire_article';
                    if($language=='ar') echo '_ar';
                    echo '.png" border="0"></a> </td>';
                   } 
                    // si article du membre modification possible et suppressio
                    if(isset($_SESSION['id_membre']) && $_SESSION['id_membre']==$row_article['id_utilisateur'])
                    {
                        if(isset($_GET['page']) && $_GET['page']!='')
                        {
                       
                        }
                        else
                        {
                        ?>
                        <?php
                        if($row_article['id_page']!=0)
                        {
                       
                         }
                         
                        }
                    }
                  
                ?>
                </tr>
                </table>
              </div>
      
      
      
    
    </td>
  </tr>
</table>
</td>
</tr>
</table>
<?php
}
?>