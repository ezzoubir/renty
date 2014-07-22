<!-- Galerie photos -->
<?php
  // on recuopere les photos de la langue
  $sql='select * from '.PREFIXE_BDD.'galerie_videos where language="'.$language.'" order by ordre_affichage,id_video';
  //echo $sql;
  $res=mysql_query($sql);
?>
                
                <div style="margin-top:15px;">
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                <?php
                $i=0;
                while($row=mysql_fetch_array($res))
                {
                    // liste des categories disponible
                // nos catégorie
                //on teste si sous categories car si oui on affiche les nom des catégorie de la sous catégorie --> pour le lien
                if($i==0) echo '<tr>';
                ?>
                
                    <td style="width:120px;border:1px solid #ccc;padding:5px;" valign="top" class="main">
        
                        <div style="">
                        <?php
                        //if($row['image_presentation']!='')//rel="vidbox"
                        if($row['url']!='')
                        {
                       if($row['image_presentation']=='')
                       {
                        $code=explode('=',$row['url']);
                        $code_=explode('&',$code[1]);
                        $code[1]=$code_[0];
                        $url_image='http://img.youtube.com/vi/'.$code[1].'/0.jpg';
                       
                       $row['image_presentation']=$url_image;
                       }
                       else
                       {
                       $row['image_presentation']=RepPhoto.$row['image_presentation'];
                       }
                        echo '<a href="http://'.$row['url'].'" rel="vidbox 800 600" title="'.stripslashes($row['titre']).'" target="_blank"><img src="'.$row['image_presentation'].'" alt="'.stripslashes($row['titre']).'" border="0" width="150"></a>';
                        }
                        else if($row['fichier']!='')
                        {
                        echo '<a href="'.RepPhoto.$row['fichier'].'" rel="vidbox 800 600" title="'.stripslashes($row['titre']).'" target="_blank"><img src="'.RepPhoto.$row['image_presentation'].'" alt="'.stripslashes($row['titre']).'" border="0" width="150"></a>';
                        }
                        ?>
                        </div>
                        <div class="main" style="text-align:center;font-size:11px;color:#333">
                        <?php 
                        if($row['url']!='')
                        {
                        
                        
                        
                        echo '<a href="http://'.$row['url'].'" rel="vidbox 800 600" title="'.stripslashes($row['titre']).'" target="_blank">'.stripslashes($row['titre']).'</a>'; 
                          //on recupere photo
                        
                        }
                         else if($row['fichier']!='')
                        {
                        echo '<a href="'.RepPhoto.$row['fichier'].'" rel="vidbox 800 600" title="'.stripslashes($row['titre']).'" target="_blank">'.stripslashes($row['titre']).'</a>';
                        }
                        ?>
                        </div>
                        
                    
                    </td>
                    <td width="<?php  echo '20'; ?>">&nbsp;</td>
                <?php
                
                
                $i++;
                if($i==3)
                { $i=0;
                  echo '</tr><tr><td colspan="3" height="20">&nbsp;</td></tr>';
                }
                
           }
        ?>
        
            </table>
            </div>