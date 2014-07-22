<?php
if(!FCKEDITOR)
{
?>
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script type="text/javascript"> 
 
tinyMCE.init(
{
 
  mode : "textareas",
  theme : "advanced",
  plugins : "safari,paste,advimage,style,table,fullscreen,visualchars,media,iespell,spellchecker,searchreplace,insertdatetime,preview,advlink",
  language : "fr",
 
 
  extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[src|width|height|scrolling|frameborder]",
 
  theme_advanced_buttons1 : "fullscreen,|,search,replace,|,forecolor,backcolor,|,bold,italic,underline,strikethrough,|,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,formatselect,|,outdent,indent,|,bullist,numlist,|,undo,redo,cut,copy,paste,",
  theme_advanced_buttons2 : "link,unlink,,anchor,|,media,image,|,code,preview,|,tablecontrols,|,insertdate,inserttime,advhr,|,ltr,rtl,",
  theme_advanced_buttons3 : "",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "",
  
  // Example content CSS (should be your site CSS)
  //content_css : "css/global.css",
 
  file_browser_callback : "tinyBrowser",
	paste_create_paragraphs : false,
	paste_create_linebreaks : false,
	paste_remove_spans: true,
  paste_remove_styles: true,
	paste_auto_cleanup_on_paste : true,
	paste_convert_middot_lists : false,
	paste_unindented_list_class : "unindentedList",
	  paste_strip_class_attributes: "none",
	paste_convert_headers_to_strong : false,
	paste_insert_word_content_callback : "convertWord",
	spellchecker_languages : "+Français=fr,English=en",
	force_br_newlines : true,   force_p_newlines : false
    
});
 
function convertWord(type, content) {
	switch (type) {
		// Gets executed before the built in logic performes it's cleanups
		case "before":
			//content = content.toLowerCase(); // Some dummy logic
			break;
 
		// Gets executed after the built in logic performes it's cleanups
		case "after":
			//content = content.toLowerCase(); // Some dummy logic
			break;
	}
 
	return content;
}
 
 
;
 
</script>
<?php
}
?>