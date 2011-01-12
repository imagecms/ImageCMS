<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Создание нового голосования</p>
            </li>
            </ul>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/polls/create')}" id="polls_create_form" style="width:100%;">
       	<div class="form_text">Название:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="name" value="" />
		    <span style="color:red;">*</span>
		</div>
        <div class="form_overflow"></div>

       	<div class="form_text">Ответ 1:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="answers[]" value="" />
		</div>
        <div class="form_overflow"></div>

       	<div class="form_text">Ответ 2:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="answers[]" value="" />
		</div>
        <div class="form_overflow"></div>

       	<div class="form_text">Ответ 3:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="answers[]" value="" />
		</div>
        <div class="form_overflow"></div>

       	<div class="form_text">Ответ 4:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="answers[]" value="" />
		</div>
        <div class="form_overflow"></div>

       	<div class="form_text">Ответ 5:</div>
		<div class="form_input">
		    <input type="text" class="textbox_long" name="answers[]" value="" />
		</div>
        <div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Создать" onclick="ajax_me('polls_create_form');" />
        </div>
		<div class="form_overflow"></div>
</form>
