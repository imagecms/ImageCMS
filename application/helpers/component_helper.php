<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function ajax_links($module)
	{
		echo '<script  type="text/javascript">
				var items = $(\''.$module.'_module_block\').getElements(\'a\');
				items.each(function(el,i){
						el.removeEvents(\'click\');
						el.addEvent(\'click\',function() { if(el.hasClass(\'ajax\')) { ajax_request(el.href); return false; }  });
				});
				</script>';
	}

	function tpl_assign($name = '', $value = '')
	{
		$CI =& get_instance();
		$CI->template->assign($name,$value);
	}

/* End of file component_helper.php */
