<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>  
    <td style="background:url(images/global/<?php echo $language; ?>/search_01.png);" height="58">&nbsp;</td>
  </tr>
  <tr>
    <td style="background:url(images/global/search_02.png);padding-left:15px;" height="37">
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
    <!-- ici formulaire de recherche -->
      <div style="text-align:center;" <?php if($language=='ar') echo ' dir="rtl" '; ?>>
        <input type="text" name="search" value="<?php if(isset($_GET['search'])) echo urldecode($_GET['search']); ?>" style="border:1px solid #EBEBEB;">
        <input type="hidden" name="page" value="">
        <input type="hidden" name="language" value="<?php echo $language; ?>">
        <input type="submit" name="SEARCH_ARTICLES" value="<?php echo FORM_OK; ?>" class="main" style="border:1px solid #fff;background:url(images/global/bg_button.png);color:#fff;">
      </div>
    </form>
    </td>
  </tr>
    <tr>
    <td style="background:url(images/global/search_03.png);" height="24">&nbsp;</td>
  </tr>
</table>