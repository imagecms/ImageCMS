<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Редактирование голосования</p>
            </li>
            </ul>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/polls/edit/' . $poll.id)}" id="polls_create_form" style="width:100%;">
       	<div class="form_text">Название:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="name" value="{encode($poll.name)}" />
		    <span style="color:red;">*</span>
		</div>
        <div class="form_overflow"></div>

        {$n=1}
        {foreach $answers as $a}
       	<div class="form_text">Ответ {$n}:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="answers[{$a.id}]" value="{encode($a.text)}" />
		    <img align="middle" src="{$THEME}/images/delete.png" onclick="ajax_div('page', base_url + 'admin/components/cp/polls/delete_answer/{$poll.id}/{$a.id}');" title="Удалить" width="16" height="16" style="cursor:pointer;" />
		</div>
        <div class="form_overflow"></div>
        {$n++}
        {/foreach}

       	<div class="form_text">Следующий ответ:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="next_answer" value="" />
		</div>
        <div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Сохранить" onclick="ajax_me('polls_create_form');" />
        </div>
		<div class="form_overflow"></div>
</form>
