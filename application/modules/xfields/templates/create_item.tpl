<div class="form_input">
		<div style="border: solid silver 0px;padding:3px;margin-left:50px;">
		Создать поле:
			<a href="#" onclick="load_item_tpl('textbox'); return false;">Textbox</a>
			/
			<a href="#" onclick="load_item_tpl('textarea'); return false;">Textarea</a>
			/
			<a href="#" onclick="load_item_tpl('dropdown'); return false;">Dropdown</a>
			/
            <a href="#" onclick="load_item_tpl('image'); return false;">Image</a>
			/
            <a href="#" onclick="load_item_tpl('user_file'); return false;">File</a>
<hr/>
		</div>
	</div>

<div style="padding:5px;clear:both;"> <!-- main block -->
	<form action="{$SELF_URL}/create/textbox" method="post" id="create_from">
		<div id="create_tpls"></div>        
	{form_csrf()}</form>
</div> 
