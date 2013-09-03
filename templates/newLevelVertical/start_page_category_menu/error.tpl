{literal}
<style>
	.error { border: 1px solid #f00; width: 450px; background-color: #fff; padding: 10px;}
	.error h3 { color: #f00; padding: 5px;}
	.error p { color: #000; }
	.error p b { color: #f00; }
	.error ul { padding: 10px; margin: 0 0 0 0px; }
	.error ul li { list-style: decimal; padding: 2px; margin: 0 0 0 10px; color: #000; }
</style>	
{/literal}
<div class="error">
	<h3 align="center">{lang('Attention','newLevel')}!</h3>
	<p>{lang('Not found the required template file for the menu','newLevel')}<b>{$menu}</b></p>
	<ul>
	{foreach $errors as $e}
	<li>{if $tpl_folder}{$THEME}{$e.user_template}{else:}{$e.system_template}{/if}</li>
	{/foreach}
	</ul>
	<p>
		{if $tpl_folder}
		{lang('Check the file existing or change the menu settings','newLevel')} <b>{$menu}</b>
		{else:}
		{lang('Reinstall the menu module','newLevel')}
		{/if}
	</p>
</div>	