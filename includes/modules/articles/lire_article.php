<?php
  // on recupere id_article
  $id_article=(int)$_GET['lecture_article'];
  $sql='select * from '.PREFIXE_BDD.'articles where id_article="'. $id_article.'"';
  $res=mysql_query($sql);
  $row_article=mysql_fetch_array($res);

?>
 <div class="global_article">
                <div class="TITRE_ARTICLE"><?php echo stripslashes($row_article['titre']); ?></div>
                <div class="SOUS_TITRE_ARTICLE">
                 <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                 <tr>
                 <td>
                <?php
                  if($language=='fr')
                  {
                      echo  ConvertDateToFr($row_article['date_publication']);
                  }
                  else
                    echo $row_article['date_publication'];
                ?>

                </td>
                <td align="<?php if($language=='ar') echo 'left';else echo 'right'; ?>"><input type="image" name="btn" id="btn" src="images/print.png" style="cursor:pointer;height:17px;" onclick="imprime('0');return false;"  height="17"><a href="html2pdf.php?id_article=<?php echo $row_article['id_article']; ?>&language=<?php echo $language; ?>" target="_blank"><img src="images/pdf.png" height="17" border="0"></a></td>
                </tr>
                </table>
                </div>
                <div class="container_article" style="padding:5px;" id='article<?php echo 0; ?>'>
                <?php
                  if($row_article['image']!='')
                  {
                      ?>
                      <div style="float:left; margin-right:5px;margin-bottom:5px;"><img src="<?php echo RepPhoto.'mins/'.$row_article['image']; ?>" width="100" alt="<?php echo stripslashes($row_article['titre']); ?>"> </div>
                      <?php
                      
                  }
                ?>
                <?php
                $row_article['texte']=str_replace('../images/pages/','images/pages/',$row_article['texte']);
                  echo stripslashes($row_article['texte']);
                ?>
                <?php
                $row_article['texte_suite']=str_replace('../images/pages/','images/pages/',$row_article['texte_suite']);
                  echo stripslashes($row_article['texte_suite']);
                ?>
                </div>
                <div style="margin-left:15px;">
                <table>
                <tr>
                <td>
                <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
                <a href="http://twitter.com/share" class="twitter-share-button">Tweet</a>
                </td>
                <td>
                
                <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> 
                <a rel="nofollow" name="fb_share" type="button_count" share_url="<?php echo urlencode("".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>"></a>
                <fb:like href="http://connect.facebook.net/en_US/all.js#xfbml=1" width="450" height="80"/>
                
                <!--<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like layout="button_count" show_faces="true" width="100" font="verdana"></fb:like>-->
                </td>
                </tr>
                </table>
                </div>
                <?php
                 if(isset($_SESSION['id_membre']) && $_SESSION['id_membre']==$row_article['id_utilisateur'])
                    {
                        ?>
                          <a href="index.php?language=<?php echo $language; ?>&page=<?php if(isset($_GET['page'])) echo (int)$_GET['page']; ?><?php if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage']; ?>&rediger_article=<?php echo $row_article['id_article']; ?>" style="margin-left:50px;color:blue;font-size:11px;"><?php echo MODIFIER_MON_ARTICLE; ?></a>
                          <a href="index.php?language=<?php echo $language; ?>&page=<?php if(isset($_GET['page'])) echo (int)$_GET['page']; ?><?php if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage']; ?>&supprimer_article=<?php echo $row_article['id_article']; ?>" onclick='javascript: if(confirm("<?php echo SUPPRIMER_MON_ARTICLE; ?>")){return true;} else return false;' style="margin-left:50px;color:red;font-size:11px;"><?php echo SUPPRIMER_MON_ARTICLE; ?></a>
                        <?php
                    }
                ?>
              </div>
              <!--<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fexample.com%2Fpage%2Fto%2Flike&amp;layout=box_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:65px;" allowTransparency="true"></iframe>-->