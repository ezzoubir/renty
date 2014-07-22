<?php
  // on recupere page perso
$req = 'SELECT texte  FROM '.PREFIXE_BDD.'pages where id_page="'.$_GET['id'].'"';
$result = mysql_query($req) or die ("Exécution de la requête impossible"); 

while ($donnee = mysql_fetch_array($result))
         {
              echo $donnee['texte'];
		 }
		 	 

?>