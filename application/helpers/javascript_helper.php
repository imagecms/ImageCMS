<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Java Script helper
 */

	/**
	 * Reload window content by windowID
	 */
	function updateContent($windowID,$url)
	{
		echo "<script type=\"text/javascript\"> MochaUI.updateContent($('".$windowID."'), null, '".$url."'); </script>";
	}

	/**
	 * Show Roar message
	 */
	function showMessage( $message, $title = FALSE)
    {
        $del = array("'",'"');  

        $message = str_replace($del, '', $message); 
        $title = str_replace($del, '', $title); 


		if ($title == FALSE)
		{
			$title = 'Сообщение: ';
		}
		$CI =& get_instance();
		$message .= '<br/><strong>Запросов к базе: '.$CI->db->total_queries().'</strong>';
		$message = str_replace("\n",'<br/>',$message);
		$message = str_replace("<p>",'',$message);
		$message = str_replace("</p>",'',$message);
		echo "<script type=\"text/javascript\"> showMessage('".$title."','".$message."'); </script>";
	}

	/**
	 * Build new MochaUI window
	 */
	function buildWindow($id,$title,$contentURL,$width,$height,$method = 'iframe')
	{
			$w = "
			<script type=\"text/javascript\">
			new MochaUI.Window({
				id: '".$id."',
				title: '".$title."',
				loadMethod: '".$method."',
				contentURL: '".$contentURL."',
				width: ".$width.",
				height: ".$height."
			});
			</script>";

			echo $w;
	}

	/**
	 * Close window
	 */
	function closeWindow($windowID)
	{
		echo "<script type=\"text/javascript\"> MochaUI.closeWindow($('".$windowID."')); </script>";
	}


	/**
 	 * Redirect function
 	 */
 	function ajax_redirect($location)
 	{
 		echo  'Перенаправляю: <b>'.$location.'</b> '."<script type='text/javascript'> setTimeout(\"location.href = '".$location."';\",3000); </script>";
 	}

	/*
	 * Load content to DIV
	 */
 	function updateDiv($div_id,$url)
 	{
		echo "<script type=\"text/javascript\"> ajax_div('".$div_id."','".$url."'); </script>";
	}

	/*
	 * Same function as above but with other name ;)
	 */
 	function ajax_div($div_id,$url)
 	{
		echo "<script type=\"text/javascript\"> ajax_div('".$div_id."','".$url."'); </script>";
	}

	/*
	 * Execute java script code
	 */
	function jsCode($code)
	{
		echo "<script type=\"text/javascript\"> ".$code." </script>";
	}

/* End of javascript helper */
