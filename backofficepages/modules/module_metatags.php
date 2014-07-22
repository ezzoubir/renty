


<?php

$sql='select * from '.PREFIXE_BDD.'languages where symbol="'.$_GET['language'].'"';
$res_language=mysql_query($sql);
if(mysql_num_rows($res_language))
{
$row_language=mysql_fetch_array($res_language);
?>
<h1>Metas-Tags <?php echo $row_language['symbol']; ?></h1>

<?php
if (isset($_POST['save']))

{

      // on recupere tous les identifiants

      /*$sql='select id_language,symbol from languages order by id_language';

      $res2=mysql_query($sql);

      while($row_language=mysql_fetch_assoc($res2))

      {

            // on teste si enregistrement existe

            $sql='select id_metatags from page_metatags where id_metatags='.$row_language['id_language'];

            $res=mysql_query($sql);

            if(mysql_num_rows($res)==0)

            {

                // insertion

                $sql='insert into page_metatags (titre,description,mots,id_metatags,language) values ("'.mysql_escape_string(str_replace('"','',stripslashes($_POST['titre'][$row_language['id_language']]))).'","'.mysql_escape_string(str_replace('"','',stripslashes($_POST['description'][$row_language['id_language']]))).'","'.mysql_escape_string(str_replace('"','',stripslashes($_POST['mots'][$row_language['id_language']]))).'","'.$row_language['id_language'].'","'.$row_language['symbol'].'")';

                mysql_query($sql);

            }

            else

            {

                $sql='update page_metatags 

                set titre="'.mysql_escape_string(str_replace('"','',stripslashes($_POST['titre'][$row_language['id_language']]))).'"

                ,description="'.mysql_escape_string(str_replace('"','',stripslashes($_POST['description'][$row_language['id_language']]))).'"

                ,mots="'.mysql_escape_string(str_replace('"','',stripslashes($_POST['mots'][$row_language['id_language']]))).'"

                ,language="'.$row_language['symbol'].'"

                where id_metatags='.$row_language['id_language'];

                mysql_query($sql);

                

            }

        

      }
*/


 $sql='update '.PREFIXE_BDD.'metatags  
                set titre="'.mysql_escape_string(str_replace('"','',stripslashes($_POST['titre'][$row_language['id_language']]))).'"
                ,description="'.mysql_escape_string(str_replace('"','',stripslashes($_POST['description'][$row_language['id_language']]))).'"
                ,mots="'.mysql_escape_string(str_replace('"','',stripslashes($_POST['mots'][$row_language['id_language']]))).'"
                ,language="'.$row_language['symbol'].'"
                where id_metatags="'.$_POST['id_metatags'].'"
                ';
                
                
                mysql_query($sql);

}





// on recupere les langues

//$sql='select titre,symbol,id_language from languages order by id_language';

//$res_l=mysql_query($sql);





?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

<br />



<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>

<td></td><td></td>

</tr>

<?php

// on recupere info langue



      $sql='select * from '.PREFIXE_BDD.'metatags  where language="'.$_GET['language'].'"';
      $res=mysql_query($sql);
      
      if(mysql_num_rows($res)==0)
      {
          // on insert enregistrement
          $sql='insert into '.PREFIXE_BDD.'metatags (language) values ("'.$_GET['language'].'")';
          mysql_query($sql);
      
          $sql='select * from '.PREFIXE_BDD.'metatags  where language="'.$_GET['language'].'"';
          $res=mysql_query($sql);
      }
      
      $row_=mysql_fetch_assoc($res);
    ?>
        <tr>
          <td style="text-align:left;"><b><u><?php echo $row_language['titre']; ?></u></b></td><td><hr /></td>
        </tr>
        <tr>
            <td style="text-align:left;" valign="top">Titre <?php echo $row_language['symbol']; ?> : </td>
            <td style="text-align:left;"><input type="text" name="titre[<?php echo $row_language['id_language'] ?>]" value="<?php echo $row_['titre']; ?>"></td>
        </tr>
        <tr>
          <td style="text-align:left;" valign="top">Description <?php echo $row_language['symbol']; ?> : </td><td style="text-align:left;"><textarea name="description[<?php echo $row_language['id_language']; ?>]" style="width:250px;height:80px;"><?php echo $row_['description']; ?></textarea></td>
        </tr>
        <tr>
          <td style="text-align:left;" valign="top">Mots clés <?php echo $row_language['symbol']; ?> : </td><td style="text-align:left;"><textarea name="mots[<?php echo $row_language['id_language']; ?>]" style="width:250px;height:80px;"><?php echo $row_['mots']; ?></textarea></td>
        </tr>

        

    <?php

  

?>



<tr>

<td></td><td style="text-align:left;" ><input type="submit" name="save" value="Enregistrer"></td>

</tr>

<tr>

<td></td><td></td>

</tr>

</table>
<input type="hidden" name="id_metatags" value="<?php echo $row_['id_metatags']; ?>">
</form>
<?php
}
?>