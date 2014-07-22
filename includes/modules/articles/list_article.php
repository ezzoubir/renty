<?php

// faire une pagination ! 

if(isset($_GET['SEARCH_ARTICLES'])) 
{
    $text_recherche=rawurldecode($_GET['search']);
    if($text_recherche=='') unset($text_recherche);
}



if((isset($id_page) && $id_page!='')||(isset($_GET['mes_articles']) && isset($_SESSION['id_membre'])) || isset($text_recherche) || isset($_GET['archives']))
    {
    if(isset($_GET['mes_articles']))
    {
    //$sql='select autorisation_publication_articles from '.PREFIXE_BDD.'pages where id_utilisateur="'.$_SESSION['id_membre'].'" and autorisation_publication_articles="1"';
    $pagination=false;
    $sql='select * from '.PREFIXE_BDD.'articles where id_utilisateur="'.$_SESSION['id_membre'].'"';
    }
    else if(isset($text_recherche))
    {
    $pagination=true;
      $sql='select * from '.PREFIXE_BDD.'articles where titre like "%'.$text_recherche.'%" or  texte like "%'.$text_recherche.'%" or texte_suite like  "%'.$text_recherche.'%"';
    }
    else if(isset($_GET['archives']))
    {
        $pagination=true;
        $sql='select * from '.PREFIXE_BDD.'articles where id_page="0"';
    }
    else
    {
    $sql='select autorisation_publication_articles from '.PREFIXE_BDD.'pages where id_page="'.$id_page.'" and autorisation_publication_articles="1"';
    $pagination=false;
    $auto=true;
    }
    if(isset($auto))
    {
        $sql='select * from '.PREFIXE_BDD.'articles where id_page="'.$id_page.'" and texte!="" order by ordre_affichage,id_article';
        $res=mysql_query($sql);
        if(mysql_num_rows($res)==0) $aff=false;
    }
    
    $res=mysql_query($sql);
    $TotalEnregistrements=mysql_num_rows($res);
    $PageNum=1; 
    
    $NbrPages=ceil($TotalEnregistrements/NBR_ARTICLE_PAR_PAGE);
    
  if(isset($_GET['num_page']))
    {
      $PageNum=intval($_GET['num_page']);
    }
    
      $Prev=$PageNum;
        if($PageNum>1)
          $Prev=$PageNum-1;
        
        if($PageNum<$NbrPages) 
          $Next=$PageNum+1;
        else $Next=$NbrPages;
        
        $PagesInit=array(0=>1,1=>$Prev,2=>$Next);
        
        $PageEnd=$NbrPages;
    
            if($PageNum>1) // limit pour sql
         $limit0=$PageNum*NBR_ARTICLE_PAR_PAGE-NBR_ARTICLE_PAR_PAGE;
        else $limit0=0;
    
    //limit '.$limit0.','.NBR_ARTICLE_PAR_PAGE 
    
    
      if($TotalEnregistrements>0 && !isset($aff))
      {
      
      unset($res);
        if(isset($_GET['mes_articles']))
        {
        $sql='select * from '.PREFIXE_BDD.'articles where id_utilisateur="'.$_SESSION['id_membre'].'"  order by ordre_affichage,id_article';
        }
        else if(isset($text_recherche))
        {
        $sql='select * from '.PREFIXE_BDD.'articles where language="'.$language.'" and titre like "%'.$text_recherche.'%" or  texte like "%'.$text_recherche.'%" or texte_suite like  "%'.$text_recherche.'%" order by id_page DESC,ordre_affichage,id_article limit '.$limit0.','.NBR_ARTICLE_PAR_PAGE ;
    
        }
        else if(isset($_GET['archives']))
        {
            $sql='select * from '.PREFIXE_BDD.'articles where id_page="0" and language="'.$language.'" order by id_article limit '.$limit0.','.NBR_ARTICLE_PAR_PAGE ;
            
        }
        else
        {
        $sql='select * from '.PREFIXE_BDD.'articles where id_page="'.$id_page.'" and texte!="" order by ordre_affichage,id_article limit '.$limit0.','.NBR_ARTICLE_PAR_PAGE ;
        }
        // a terminé
        
        $res_articles=mysql_query($sql);
        while($row_article=mysql_fetch_array($res_articles))
        {
            ?>
              <div class="global_article" style="margin-bottom:20px;">
                <div class="TITRE_ARTICLE"><?php echo stripslashes($row_article['titre']); ?><?php if($row_article['id_page']==0) echo '<em style="font-size:11px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ARTICLE_ARCHIVE.'</em>'; ?></div>
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
                    echo $row_article['date_publication'];//
                ?>
                </td>
                <td align="<?php if($language=='ar') echo 'left';else echo 'right'; ?>"><input type="image" name="btn" id="btn" src="images/print.png" style="cursor:pointer;height:17px;" onclick="imprime(<?php echo $row_article['id_article'];  ?>);return false;"  height="17"><a href="html2pdf.php?id_article=<?php echo $row_article['id_article']; ?>&language=<?php echo $language; ?>" target="_blank"><img src="images/pdf.png" height="17" border="0"></a></td>
                </tr>
                </table>
                </div>
                <div class="container_article" style="padding:5px;" id='article<?php echo $row_article['id_article']; ?>'>
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
                </div>
                <?php
                  if(isset($row_article['texte_suite']) && $row_article['texte_suite']!='')
                  {
                    echo '<a href="index.php?lecture_article='.$row_article['id_article'].'&language='.$language.'&page='.$row_article['id_page'];
                    if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage'];
                    
                    echo '" style="font-size:11px;margin-right:50px;">'.LIRE_LA_SUITE.'</a>';
                   } 
                    // si article du membre modification possible et suppressio
                    if(isset($_SESSION['id_membre']) && $_SESSION['id_membre']==$row_article['id_utilisateur'])
                    {
                        if(isset($_GET['page']) && $_GET['page']!='')
                        {
                        ?>
                          <a href="index.php?language=<?php echo $language; ?>&page=<?php if(isset($_GET['page'])) echo (int)$_GET['page']; ?><?php if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage']; ?>&rediger_article=<?php echo $row_article['id_article']; ?>" style="color:blue;font-size:11px;margin-left:5px;"><?php echo MODIFIER_MON_ARTICLE; ?></a>
                          <a href="index.php?language=<?php echo $language; ?>&page=<?php if(isset($_GET['page'])) echo (int)$_GET['page']; ?><?php if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage']; ?>&supprimer_article=<?php echo $row_article['id_article']; ?>" onclick='javascript: if(confirm("<?php echo SUPPRIMER_MON_ARTICLE; ?>")){return true;} else return false;' style="margin-left:50px;color:red;font-size:11px;"><?php echo SUPPRIMER_MON_ARTICLE; ?></a>
                        <?php
                        }
                        else
                        {
                        ?>
                        <?php
                        if($row_article['id_page']!=0)
                        {
                        ?>
                        <a href="index.php?language=<?php echo $language; ?>&page=<?php  echo (int)$row_article['id_page']; ?>&rediger_article=<?php echo $row_article['id_article']; ?>" style="color:blue;font-size:11px;"><?php echo MODIFIER_MON_ARTICLE; ?></a>
                         <?php
                         }else if($row_article['id_page']==0)
                         {
                            // l'article est archivé
                            ?>
                              <a href="" onclick="return false;" style="font-size:11px;"><?php echo ARTICLE_ARCHIVE; ?></a>
                            <?php
                         }
                         ?>
                         
                          <a href="index.php?language=<?php echo $language; ?>&page=<?php (int)$row_article['id_page']; ?>&supprimer_article=<?php echo $row_article['id_article']; ?>" onclick='javascript: if(confirm("<?php echo SUPPRIMER_MON_ARTICLE; ?>")){return true;} else return false;' style="margin-left:50px;color:red;font-size:11px;margin-left:5px;"><?php echo SUPPRIMER_MON_ARTICLE; ?></a>
                        
                        <?php
                        }
                    }
                  
                ?>
              </div>
            <?php
        }
      }
    }
  if(isset($_SESSION['privilege']))
  {
      // le membre peut rédiger un article dans cet categorie
      $sql='';
      // on doit déterminer si sur cette page la redaction d'articles est autorisé :
      if(isset($_GET['spage']))
        $sql='select * from '.PREFIXE_BDD.'pages where id_page="'.(int)$_GET['spage'].'"';
      else
      if(isset($_GET['page']))
        $sql='select * from '.PREFIXE_BDD.'pages where id_page="'.(int)$_GET['page'].'"';
      
      if($sql!='')
      {
        $res_=mysql_query($sql);
        $row_=mysql_fetch_array($res_);
        if($row_['autorisation_publication_articles']==1 && isset($_SESSION['id_membre']))
        {
            // on teste si membre à le privilege
            $sql='select privilege from '.PREFIXE_BDD.'membres where id_membre="'.$_SESSION['id_membre'].'" and privilege="1"';
            $res_=mysql_query($sql);
            if(mysql_num_rows($res_)==1)
            {
          ?>
          <div style="text-align:center;">
          <a href="index.php?language=<?php echo $language; ?>&page=<?php if(isset($_GET['page'])) echo (int)$_GET['page']; ?><?php if(isset($_GET['spage'])) echo '&spage='.(int)$_GET['spage']; ?>&rediger_article"><?php echo REDIGER_UN_ARTICLE; ?></a>
          </div>
          <?php
          }
        }
      }
  }
  
  

  if(isset($NbrPages) && $NbrPages>1)
{
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
 <td style="padding-left:20px;padding-top:25px;" height="20" ><?php if($PageNum>1)echo '<div style="float:left;margin-left:3px;">
 <a href="'.$_SERVER['REQUEST_URI'].'&num_page=1" style="text-decoration:none;font-weight:bold;">|<</a> 
 <a href="'.$_SERVER['REQUEST_URI'].'&num_page='.$Prev.'" style="text-decoration:none;margin-left:10px;"> << </a></div>'; if($NbrPages>$PageNum) echo '<div style="float:right;margin-right:18px;">
 <a href="'.$_SERVER['REQUEST_URI'].'&num_page='.$Next.'" style="text-decoration:none;"> >> </a><a href="'.$_SERVER['REQUEST_URI'].'&num_page='.$PageEnd.'" style="text-decoration:none;font-weight:bold;margin-left:10px;">>|</a></div>'; ?></td>
</tr>
<tr>
  <td align="center" class="main" style="text-align:center;">Page > <?php echo $PageNum.' / '.$NbrPages; ?></td>
</tr>
</table>
<?php
}
?>
