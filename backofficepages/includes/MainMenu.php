<div style="background:#000;">
<ul id="MENUPRINCIPAL">
  <li><a href="index.php?action=config">Config</a></li>
  
  <?php
    // on recupere les langues
    $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
    $res=mysql_query($sql);
    if(mysql_num_rows($res)==1)
    {
    $ro=mysql_fetch_array($res);
      echo '<li style="width:78px;"><a href="index.php?action=meta-tags&language='.$ro['symbol'].'">Metas</a></li>';
    }
    else
    {
    
    ?>
    <li><a href="#" onclick="return false;">Metas</a>
    <ul class="sousMenu">
      <?php
        while($ro=mysql_fetch_array($res))
        {
            echo '<li style="width:78px;"><a href="index.php?action=meta-tags&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
        }
      ?>
    </ul>
    <?php
  ?>
  </li>
  <?php
  }
  if(PAGES_STATIQUES)
  {
  ?>
    <?php
    // on recupere les langues
    $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
    $res=mysql_query($sql);
    if(mysql_num_rows($res)==1)
    {
    $ro=mysql_fetch_array($res);
    echo '<li style=""><a href="index.php?action=pages_statiques&language='.$ro['symbol'].'">Pages statiques</a></li>';
    }
    else
    {    ?>
  <li><a href="">Stream on tour</a>

    <ul class="sousMenu">
      <?php
        while($ro=mysql_fetch_array($res))
        {
            echo '<li style="width:110px;"><a href="index.php?action=pages_statiques&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
        }
      ?>
    </ul>
    <?php
  
  ?>
  
  </li>
  <?php
  }
  }
  ?>
  
  <?php
    // on recupere les langues
    $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
    $res=mysql_query($sql);
    if(mysql_num_rows($res)==1)
    {
    $ro=mysql_fetch_array($res);
    echo '<li><a href="index.php?action=gestion_contenu&language='.$ro['symbol'].'">Gestion de contenu</a></li>';
    }
    else
    {
    ?>
    <li><a href="#" onclick="return false;">Gestion de contenu</a>
    <ul class="sousMenu">
      <?php
        while($ro=mysql_fetch_array($res))
        {
            echo '<li style="width:135px;"><a href="index.php?action=gestion_contenu&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
        }
      ?>
    </ul>
    <?php
    
  ?>
  
  </li>
  
  
  <?php
  }
 

  if(PUBLICATION_ARTICLES)
  {
      ?>
        <li><a href="#" onclick="return false;">Articles </a>
        <?php
          // on recupere les langues
          $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
          $res=mysql_query($sql);
          
          ?>
          <ul class="sousMenu">
            <?php
              while($ro=mysql_fetch_array($res))
              {
                  echo '<li style="width:115px;"><a href="index.php?action=gestion_article_archive&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
              }
            ?>
          </ul>
          <?php
        ?>
        </li>
      <?php
  }
  
    if(CATALOGUE_PRODUITS)
  {
  // on recupere les langues
          $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
          $res=mysql_query($sql);
  
  ?>
        <!--<li><a href="index.php?action=catalogue&language=fr" onclick="<?php if(mysql_num_rows($res)>1) echo 'return false;'; ?>">Catalogue</a>-->
        <li><a href="index.php?action=catalogue&language=fr" onclick="<?php if(mysql_num_rows($res)>1) echo 'return false;'; ?>">Soirées</a>
        <?php
          if(mysql_num_rows($res)>1)
          {
          
          ?>
          <ul class="sousMenu">
            <?php
              while($ro=mysql_fetch_array($res))
              {
                  //echo '<li style="width:115px;"><a href="index.php?action=catalogue&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
                  if($ro['symbol']=='fr') $id=80;
                  else $id=81;
                  echo '<li style="width:115px;"><a href="index.php?action=catalogue_produits&id_page='.$id.'&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
                  //
              }
            ?>
          </ul>
          <?php
          }
        ?>
        </li>
        <li><a href="index.php?action=reservations_soiree">Réservations</a></li>
        
      <?php
  }

  ?>
    <?php
      if(GESTION_PAGES_SUPPLEMENTAIRES)
      {
      
       // on recupere les langues
    $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
    $res=mysql_query($sql);
    if(mysql_num_rows($res)==1)
    {
    $ro=mysql_fetch_array($res);
   echo ' <li><a href="index.php?action=pages_supplementaires&language='.$ro['symbol'].'">Pages supplémentaires</a></li>';
    
    }
    else
    {
        ?>
        <li><a href="index.php?action=pages_supplementaires" onclick="return false;">Pages supplémentaires</a>
        <?php
    ?>
    <ul class="sousMenu">
      <?php
        while($ro=mysql_fetch_array($res))
        {
            echo '<li style="width:165px;"><a href="index.php?action=pages_supplementaires&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
        }
      ?>
    </ul>
    <?php
  ?>
  
        
        </li>
        <?php
      }
      }
    ?>
    <?php
    if(GESTION_EMPLACEMENT_FORM_CONTACT)
    {
    ?>
    <li><a href="index.php?action=form_contact">Formulaire de contact</a></li>
    <?php
    }
    ?>
     <?php
    if(ESPACE_MEMBRE)
    {
          // le site possède un espace membres
        ?>
        <li><a href="index.php?action=espace_membre">Membres</a></li>
        <?php
    }
    ?>
    <?php
    if(INSCRIPTION_NEWSLETTER)
    {
    ?>
  <li><a href="#" onclick="return false;">Newsletter</a>
  <ul class="sousMenu">
    <li style="width:85px;"><a href="index.php?action=newsletter_mailing_list">Mailing-list</a></li>
    <li style="width:85px;"><a href="index.php?action=newsletter_envoyer">Envoyer une newsletter</a></li>
    <li style="width:85px;"><a href="index.php?action=archives_newsletter">Newsletter(s) envoyé(s)</a></li>
  </ul>
  </li>
  <?php
  }
  
  
        if(GESTION_PHOTOS_SANS_CATEGORIE_AVEC_LIEN||GESTION_PHOTOS_SANS_CATEGORIE||GALERIE_PHOTOS||GALERIE_VIDEOS)
        {
  ?>

      <li style="width:105px;"><a href="" onclick="return false;">Module(s)</a>
      <ul class="sousMenu">
      <!-- <li style="width:105px;"><a href="index.php?action=livre_d_or" onclick="">Livre d'or</a></li>-->
      <?php
      if(GESTION_PHOTOS_SANS_CATEGORIE_AVEC_LIEN)
      {
      ?>
      <li style="width:105px;"><a href="index.php?action=photos_avec_lien">Photos défilantes</a></li>
      
      <?php
      }
      if(GESTION_PHOTOS_SANS_CATEGORIE)
      {
      ?>
      <li style="width:105px;"><a href="index.php?action=photos">Carroussel</a></li>
      
      <?php
      }
      if(GALERIE_PHOTOS)
      {
        ?>
          <li style="width:105px;"><a href="index.php?action=galerie_photos&language=fr">Slide</a>
          <!--ul class="niveau2">
            <?php 
            if(GALERIE_PHOTOS_POSITION)
            {
            ?>
            <li style="width:105px;"><a href="index.php?action=galerie_photos_position">Position</a></li><?php } ?>
             <?php
              // on recupere les langues index.php?action=galerie_photos&language='.$ro['symbol'].'
              $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
              $res=mysql_query($sql);
              
              ?>
              <?php
                while($ro=mysql_fetch_array($res))
                {
                    echo '<li style="width:105px;"><a href="index.php?action=galerie_photos&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
                }
             ?>
             </ul-->
            </li>
        <?php
      }
      ?>
     
      <?php
       if(GALERIE_VIDEOS)
      {
        ?>
          <li style="width:105px;"><a href="#" onclick="return false;">Vidéo</a>
          <ul class="niveau2">
            <?php
              if(GALERIE_VIDEOS_POSITION)
              {
            ?>
            <li style="width:105px;"><a href="index.php?action=galerie_videos_position">Position</a></li><?php } ?>
             <?php
              // on recupere les langues
              $sql='select * from '.PREFIXE_BDD.'languages order by id_language';
              $res=mysql_query($sql);
              
              ?>
              <?php
                while($ro=mysql_fetch_array($res))
                {
                    echo '<li style="width:105px;"><a href="index.php?action=galerie_videos&language='.$ro['symbol'].'">'.stripslashes($ro['titre']).'</a></li>';
                }
             ?>
             </ul>
            </li>
        <?php
      }
    ?>
    </ul>
    <?php
    }
    ?>
</li>
<li><a href="index.php?action=marchands">Marchands</a></li>
<li><a href="index.php?action=categories">Catégories</a></li>
<li><a href="index.php?action=coupons">Coupons</a></li>
<li><a href="index.php?action=villes">Villes</a></li>
</ul>
</div>
<div style="clear:both"></div>