{foreach $pages as $page}
	{$CI->template->display('widgets/main_page', array(
		'page'=>$page
	))}
{/foreach}