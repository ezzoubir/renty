<?php
  if(isset($_GET['action']))
  switch ($_GET['action'])
  {
      case 'gestion_contenu_modifier':
      ?>
      <script type="text/javascript" src="scripts/fonction.js"></script>
      <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
      <script type="text/javascript">
      window.onload = function(){
        var oFCKeditor = new FCKeditor( 'content' ) ;
            oFCKeditor.BasePath = "fckeditor/" ;
            oFCKeditor.ReplaceTextarea() ;
      }
      </script>
       <?php
      break;
      
      case 'gestion_page_statique_modifier':
        ?>
      <script type="text/javascript" src="scripts/fonction.js"></script>
      <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
      <script type="text/javascript">
      window.onload = function(){
        var oFCKeditor = new FCKeditor( 'content' ) ;
            oFCKeditor.BasePath = "fckeditor/" ;
            oFCKeditor.ReplaceTextarea() ;
      }
      </script>
       <?php
      break;
      
      case 'pages_supplementaires_modifier':
      ?>
      <script type="text/javascript" src="scripts/fonction.js"></script>
      <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
      <script type="text/javascript">
      window.onload = function(){
        var oFCKeditor = new FCKeditor( 'content' ) ;
            oFCKeditor.BasePath = "fckeditor/" ;
            oFCKeditor.ReplaceTextarea() ;
      }
      </script>
      <?php
      break;
      
      case 'newsletter_envoyer':
      if(!isset($_POST['SEND_NEWSLETTER']))
      {
      ?>
      

      <script type="text/javascript" src="scripts/fonction.js"></script>
      <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
      <script type="text/javascript">
      window.onload = function(){
      //alert(typeof(document.getElementsByName('content')));
      if (typeof(document.getElementsByName('content'))!="undefined")
      {
        var oFCKeditor = new FCKeditor( 'content' ) ;
            oFCKeditor.BasePath = "fckeditor/" ;
            oFCKeditor.ReplaceTextarea() ;
      }
      }
      </script>
      <?php
      }
      break;
      
      case 'catalogue_add_product':
      ?>
      <script type="text/javascript" src="scripts/fonction.js"></script>
      <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
      <script type="text/javascript">
      window.onload = function(){
        var oFCKeditor = new FCKeditor( 'tiny' ) ;
            oFCKeditor.BasePath = "fckeditor/" ;
            oFCKeditor.ReplaceTextarea() ;
      }
      </script>
      <?php
      break;
      
      case 'catalogue_pack_edit':
      ?>
      <script type="text/javascript" src="scripts/fonction.js"></script>
      <script type="text/javascript" src="fckeditor/fckeditor.js"></script>
      <script type="text/javascript">
      window.onload = function(){
        var oFCKeditor = new FCKeditor( 'tiny' ) ;
            oFCKeditor.BasePath = "fckeditor/" ;
            oFCKeditor.ReplaceTextarea() ;
      }
      </script>
      <?php
      break;

  }
  
?>
  