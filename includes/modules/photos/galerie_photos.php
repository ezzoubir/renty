<!-- Galerie photos -->
<!-- Liste des albums -->
<?php
  if(isset($_GET['id_album']))
    $id_album=(int)$_GET['id_album'];
  else
    $id_album=0;
?>
<div style="margin-bottom:15px;">
    <?php
      //$url=$_SERVER['REQUEST_URI'];
      //$url=explode('&id_album=',$url);
    
    // on teste si photo à la racine
    $sql= 'select * from '.PREFIXE_BDD.'galerie_photos where language="'.$language.'" and id_album="0" order by ordre_affichage,id_photo limit 1';
    $rrrr=mysql_query($sql);
    
    $sql='select * from '.PREFIXE_BDD.'galerie_photos_album where language="'.$language.'" order by ordre_affichage,id_album';
    $res_album=mysql_query($sql);
    
    if(mysql_num_rows($rrrr)>0 && (isset($_GET['id_album']) && $_GET['id_album']!=0) && mysql_num_rows($res_album)>0)
    {
    
    ?>
<div style="float:left;margin-right:15px;background:#fff;line-height:15px;padding:3px;">
 <a href="<?php echo 'photos-0.html'; ?>" style="text-decoration:none;color:#000;font-size:11px;">..</a>
</div>
<?php
}

while($roo=mysql_fetch_array($res_album))
{
    ?>
    <div style="float:left;margin-right:15px;background:#fff;line-height:15px;padding:3px;padding-right:5px;padding-left:5px;">
      <a  style="text-decoration:none;color:#000;font-size:11px;" href="<?php echo 'photos-'.$roo['id_album']; ?>.html"><?php echo stripslashes($roo['titre']); ?></a>
    </div>
    <?php
}
?>
<div style="clear:both;"></div>
</div>
<?php
  // on recuopere les photos de la langue
  $sql='select * from '.PREFIXE_BDD.'galerie_photos where language="'.$language.'" and id_album="'.$id_album.'" order by ordre_affichage,id_photo';
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
                
                    <td style="width:120px;padding:5px;" valign="top" class="main">
        
                        <div style="">
                        <?php
                        echo '<a href="'.RepPhoto.''.$row['fichier'].'" rel="lightbox[roadtrip]" title="'.stripslashes($row['titre'].'<br />'.$row['titre2']).'" target="_blank"><img src="'.RepPhoto.'mins/'.$row['fichier'].'" alt="'.stripslashes($row['titre']).'" height="80" border="0"></a>'
                        ?>
                        </div>
                        <div class="main" style="text-align:center;font-size:11px;color:#000;background:#fff;"><?php echo stripslashes($row['titre']); ?></div>
                        <?php
                        if(GALERIE_PHOTOS_CHAMP_DESCRIPTION_2)
                        {
                        ?>
                        <div class="main" style="text-align:center;font-size:11px;color:#000;background:#fff;"><?php echo stripslashes($row['titre2']); ?></div>
                        <?php
                        }
                        ?>
                    </td>
                    <td width="<?php  echo '20'; ?>">&nbsp;</td>
                <?php
                
                
                $i++;
                if($i==4)
                { $i=0;
                  echo '</tr><tr><td colspan="3" height="20">&nbsp;</td></tr>';
                }
                
           }
        ?>
        
            </table>
            </div>