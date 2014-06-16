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
	<h3 align="center">{lang('Внимание','corporate')}!</h3>
	<p>{lang('Не обнаружен необходимый файл шаблона для меню','corporate')} <b>{$menu}</b></p>
	<ul>
	{foreach $errors as $e}
	<li>{if $tpl_folder}{$THEME}/{$e.user_template}{else:}{$e.system_template}{/if}</li>
	{/foreach}
	</ul>
	<p>
		{if $tpl_folder}
		{lang('Проверьте наличие файла или измените настройки меню','corporate')} <b>{$menu}</b>
		{else:}
		{lang('Переустановите модуль меню','corporate')}
		{/if}
	</p>
</div>	