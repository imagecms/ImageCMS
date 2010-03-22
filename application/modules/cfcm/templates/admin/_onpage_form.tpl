<div class="CForms">

    <div class="form_text"></div>
    <div class="form_input"><b>{echo $form->title}</b></div>
    <div class="form_overflow"></div>

    {foreach $form->asArray() as $f}
    	<div class="form_text">{htmlentities_to_xml($f.label)}</div>
	    <div class="form_input">
            {$f.field}
            {$f.help_text}
        </div>
    	<div class="form_overflow"></div>
    {/foreach}

{form_csrf()}
</div>
