<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td>
<?php
      $sql='select * from '.PREFIXE_BDD.'photos_sans_categorie order by ordre_affichage';
      $res=mysql_query($sql);
      if(mysql_num_rows($res)==0)
      {
        ?>
          <a href="index.php?language=<?php echo $language; ?>"><img src="images/global/website_21.png" border="0"></a>
        <?php
      }
      else
      {
        
          ?>
        
          <div id="slider2">
          	<ul>
          	<?php
          	$i=0;
              while($row=mysql_fetch_array($res))
              {
              $size=getimagesize(RepPhoto.$row['fichier']);
            ?>
            <li style="padding:0px;margin:0px;height:<?php echo $size[1].'px'; ?>"><img src="<?php echo RepPhoto.$row['fichier']; ?>"></li>
            <?php
            $i++;
            }
            ?>
            </ul>
          </div>
          <?php
              if($i>1)
              {
            ?>
            <script type="text/javascript">
            
            var $jquery = jQuery.noConflict();
            	$jquery("#slider2").easySlider({
            
            	vertical: true,
            	horizontal:false,
            	auto: true,
               continuous: true,
               pause:7000,
               speed:4000
             
            	});
            
            </script>
          <?php
          }
        }
      
      

?>
  </td>
</tr>
</table>