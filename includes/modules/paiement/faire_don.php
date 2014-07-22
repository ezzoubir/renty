<div style="display:none;">
  <img src="images/global/faire_don.png">
  <img src="images/global/faire_don_over.png"> <!-- Mise en cache -->
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td>
  <ul id="faire_don">
    <li><a href="index.php?language=<?php echo $language; ?>&action=<?php
    switch ($language)
    {
        case 'fr':
        echo '1';
        break;
        
        case 'en':
        echo '2';
        break;
        
        case 'al':
        echo '3';
        break;
        
        case 'es':
        echo '4';
        break;
        
         case 'ar':
        echo '5';
        break;
        
         case 'tr':
        echo '6';
        break;
    
    }
    
    ?>&page&don"><?php echo FAIRE_DON; ?></a></li>
  </ul>
  </td>
</tr>
</table>