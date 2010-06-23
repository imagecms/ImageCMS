<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Image CMS
 * lib_editor.php
 */

 class Lib_editor {

	private $text_areas = array();

 	function Lib_editor()
 	{
 		$this->CI =& get_instance();
 	}

	function init()
	{
        ($hook = get_hook('lib_editor_init')) ? eval($hook) : NULL;

		return $this->tiny_mce();
	}

	function tiny_mce()
	{
		$theme = $this->CI->cms_admin->editor_theme();

        ($hook = get_hook('lib_editor_create_js_code')) ? eval($hook) : NULL;

        //var_dump($theme);

		switch ($theme['editor_theme'])
		{
			case 'simple':

			$theme = "
			theme_advanced_buttons1 : \"imagebox, bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,undo,redo,|,styleselect,forecolor,backcolor,|,link,unlink,anchor,image,media,emotions,cleanup,code   \",
			theme_advanced_buttons2 : \"\",
			theme_advanced_buttons3 : \"\",
			";

			break;

			case 'advanced':

			$theme = "
			theme_advanced_buttons1 : \"imagebox, bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,undo,redo,|,forecolor,backcolor,|,styleselect,formatselect,fontselect,fontsizeselect \",
			theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,outdent,indent,blockquote,|,link,unlink,anchor,image,media,|,pagebreak,cleanup,code,|,fullscreen \",
			theme_advanced_buttons3 : \"\",
			";

			break;

			case 'full':

			$theme = "
			theme_advanced_buttons1 : \"imagebox, save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect\",
			theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
			theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
			theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
			";

			break;
		}

        $code =  "
        <script type=\"text/javascript\" src=\"".media_url('application/modules/imagebox/templates/js/imagebox.js')."\"></script>

		<!-- TinyMCE -->
		<script type=\"text/javascript\">

		function load_editor()
        {            
			tinyMCE.init({
                mode : 'specific_textareas',
            	editor_selector : 'mceEditor',
                language: 'ru',
				theme : 'advanced',
				skin : \"o2k7\",
				skin_variant : \"silver\",
				plugins : \"safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups\",
				".$theme."
				theme_advanced_toolbar_location : \"top\",
				theme_advanced_toolbar_align : \"left\",
				theme_advanced_statusbar_location : \"bottom\",
				theme_advanced_resizing : true,
				content_css : theme + \"/css/content.css\",
				paste_use_dialog : false,
				theme_advanced_resizing : true,
				file_browser_callback : \"tinyBrowser\",
				theme_advanced_resize_horizontal : true,
				apply_source_formatting : true,
				force_br_newlines : true,
				force_p_newlines : false,
                relative_urls : false,
                setup : function(ed) {
                    ed.addButton('imagebox', {
                    title : 'Imagebox',
                    image : '/application/modules/imagebox/templates/images/button.png',
                    onclick : function() {
                                show_main_window();
                            }
                    });
                },
				});
		}
		</script>
		";

		return $code;
	}
 }

/* End of lib_editor.php */
