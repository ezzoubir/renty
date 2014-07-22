<h1>Article(s)  <?php echo $_GET['language']; ?></h1>
<h1><a href="index.php?action=ajouter&language=<?php echo $_GET['language']; ?>">Ajouter un article <?php echo $_GET['language']; ?></a></h1>
<?php
if(isset($_POST['delete_article']))
{
$id_article=GetImageButtonValue($_POST['delete_article']);

    // on recupere image pour supprimer
    $sql='select image from '.PREFIXE_BDD.'articles where id_article="'.$id_article.'"';
    $res_image=mysql_query($sql);
    $ro_image=mysql_fetch_array($res_image);
    @unlink('../'.RepPhoto.'mins/'.$ro_image['image']);
    @unlink('../'.RepPhoto.''.$ro_image['image']);
    
    
    $sql='delete from  '.PREFIXE_BDD.'articles where id_article="'.$id_article.'"';
    mysql_query($sql);

}


  $sql='select * from '.PREFIXE_BDD.'articles where language="'.$_GET['language'].'" and id_page="0"';
  $res=mysql_query($sql);
  $TotalEnregistrements=mysql_num_rows($res);
?>
<h2>Nombre d'article(s) : <?php echo $TotalEnregistrements; ?></h2>
<?php
  define('NBR_MEMBRE_PAR_PAGE',50);
  
  

  $PageNum=1; 
  $NbrPages=ceil($TotalEnregistrements/NBR_MEMBRE_PAR_PAGE);
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
         $limit0=$PageNum*NBR_MEMBRE_PAR_PAGE-NBR_MEMBRE_PAR_PAGE;
        else $limit0=0;
  
    // on recupere les articles de la pages
  $sql='select * from '.PREFIXE_BDD.'articles where  language="'.$_GET['language'].'" and id_page="0" limit '.$limit0.','.NBR_MEMBRE_PAR_PAGE ;
  $res=mysql_query($sql);
  $total=mysql_num_rows($res);

if($total>0)
{
?>
<form name="form1" id='form1' action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
  <th>Date publication</th>
  <th>Date modification</th>
  <th>Titre</th>
  <th>Utilisateur</th>
  <th>Fonctions</th>
  </tr>
<?php
  while ($row=mysql_fetch_assoc($res))
	{
	 ?>
	 <tr>
	 <td><?php echo  ConvertDateToFr($row['date_publication']); ?></td>
	 <td><?php echo convertDateToFr($row['date_modification']); ?></td>
	 <td><?php echo stripslashes($row['titre']); ?></td>
	 <td>
   <?php
    if($row['id_utilisateur']==0) echo 'Admin';
    else
    {
        $sql='select * from '.PREFIXE_BDD.'membres where id_membre="'.$row['id_utilisateur'].'"';
        $res_utilisateur=mysql_query($sql);
        if(mysql_num_rows($res)>0)
        {
            $row_utilisateur=mysql_fetch_array($res_utilisateur);
            echo stripslashes($row_utilisateur['prenom'].' - '.$row_utilisateur['nom'].' / '.$row_utilisateur['email'] );
        }
        else
        {
          echo 'Ancien membre (supprimé de la base de données).';
        }
    }
   ?>
   </td>

   <td>
   <a href="index.php?action=gestion_article_modifier&id_article=<?php echo $row['id_article']; ?>" title="Modifier" style="margin-right:5px;"><img src="imgs/b_edit.gif" border="0" height="12" /></a>
                  
   <input style="margin-left:10px;" type="image" name="delete_article[<?php echo $row['id_article']; ?>]" src="imgs/b_drop.gif" onclick="javascript: if(confirm('Supprimer l\'article  de <?php echo addslashes($row['titre']); ?>  ?')){this.submit();} else return false;">
   </td>
	 </tr>
	 <?php
	}
?>
  
  </table>
</form>
<div style="margin-top:10px;">
<?php
  if($NbrPages>1)
{
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
 <td style="padding-left:20px;padding-top:25px;" height="20" ><?php if($PageNum>1)echo '<div style="float:left;margin-left:3px;">
 <a href="index.php?action=gestion_article_archive&language='.$_GET['language'].'&num_page=1" style="text-decoration:none;font-weight:bold;">|<</a> 
 <a href="index.php?action=gestion_article_archive&language='.$_GET['language'].'&num_page='.$Prev.'" style="text-decoration:none;margin-left:10px;"> << </a></div>'; if($NbrPages>$PageNum) echo '<div style="float:right;margin-right:18px;">
 <a href="index.php?action=gestion_article_archive&language='.$_GET['language'].'&num_page='.$Next.'" style="text-decoration:none;"> >> </a><a href="index.php?action=gestion_article_archive&language='.$_GET['language'].'&num_page='.$PageEnd.'" style="text-decoration:none;font-weight:bold;margin-left:10px;">>|</a></div>'; ?></td>
</tr>
<tr>
  <td align="center" class="main" style="text-align:center;">Page > <?php echo $PageNum.' / '.$NbrPages; ?></td>
</tr>
</table>
<?php
}
?>
</table></div><br /><br />
<?php
}
?>