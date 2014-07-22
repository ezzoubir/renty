<?php
$sql='select * from '.PREFIXE_BDD.'photos_sans_categorie_avec_lien order by ordre_affichage';
$res=mysql_query($sql);
if(mysql_num_rows($res)>0)
{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td  style="background:url(images/global/website_11.jpg);" height="169" valign="top">
          
          <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
              <td  style="background:url(images/global/cadre_photos_01.jpg)" height="20">&nbsp;</td>
            </tr>
             <tr>
              <td  style="background:url(images/global/cadre_photos_02.jpg)" height="131" valign="top">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
              <tr>
                <td style="padding-left:35px;">
                  <?php
      
      
        
        /*
        Warning: getimagesize(images/photos/mins/photo_sans_cat_1296640344.jpg): failed to open stream: No such file or directory in i:\webservices\www\quadri\includes\modules\photos\photos_sans_categorie_avec_lien.php on line 33

    
        
        */
        
          ?>
        
          <div id="slider3">
          	<ul>
          	<?php
          	$i=0;
          	$total_largeur=0;
              while($row=mysql_fetch_array($res))
              {
              $size=getimagesize(RepPhoto.'mins/'.$row['fichier']);
              
              if($total_largeur==0) echo '<li>';
              
            $total_largeur=$total_largeur+($size[0]+10);
            if($total_largeur>575){
                ?>
                </li>
                <!-- Somme des largeur <570 > -->
                <li>
                <?php 
                $total_largeur=0;
                $total_largeur=$size[0];
            }
            
            echo '<a href="'.$row['lien'].'" target="_blank"';
            
            if($row['lien']=='') echo 'onclick="return false;"'; echo ' >' ?><img src="<?php echo RepPhoto.'mins/'.$row['fichier']; ?>"><?php  echo '</a>'; ?>
            
            
            <?php
            $i++;
            }
            
            ?>
            </li>
            </ul>
          </div>
          <?php
             // if($i>1)
              //{
            ?>
            <script type="text/javascript">
            
            var $jquery = jQuery.noConflict();
            	$jquery("#slider3").easySlider({
            
            	vertical: false,
            	horizontal:true,
            	auto: true,
               continuous: true,
               pause:1,
               speed:8000
             
            	});
            
            </script>
          <?php
         // }
        
      
      

?>
  </td>
</tr>
</table>
              
              
              
              
              
              
              
              
              
              
              </td>
            </tr>
            <tr>
              <td  style="background:url(images/global/cadre_photos_03.jpg);font-size:1px;" height="18">&nbsp;</td>
            </tr>
          </table>
          </td>
        </tr>
        </table>
<?php
}
?>