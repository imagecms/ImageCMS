<form action="{echo $form->action}" method="pos" id="{echo $f_id = uniqid()}" class="CForms">

    <div class="form_text"></div>
    <div class="form_input"><b>{echo $form->title}</b></div>
    <div class="form_overflow"></div>

    {foreach $form->asArray() as $f}
    	<div class="form_text">{$f.label}</div>
	    <div class="form_input">
            {$f.field}
            {$f.help_text}
        </div>
    	<div class="form_overflow"></div>
    {/foreach}

	<div class="form_text"></div>
	<div class="form_input">
    	<input type="submit" name="button" class="button" value="Отправить" onclick="ajax_me('{$f_id}');" />
	</div>

{form_csrf()}
</form>
