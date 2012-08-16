<div class="top-navigation">
    <ul style="float:left;">
        <li><p>Добавить поле в форму <b>"{echo $CI->load->model('xform_m')->get_form_name($fid)}"</b></p></li>
    </ul>
    <div align="right" style="float:right;padding:7px 13px;">
        <input type="button" class="button_silver_130" value="Отмена" onclick="ajax_div('page', base_url + 'admin/components/cp/xform/fields/{$fid}'); return false;" />
    </div>
</div>

<div style="clear:both"></div> 

<form method="post" action="{site_url('admin/components/cp/xform/mix_field')}/{$fid}/{$field.id}" id="add_field" style="width:100%;">
      	<div class="form_text">Тип: </div>
		<div class="form_input">
            <select name="type" id="type">
            <option value="text"{if $field.type=='text'} selected="selected"{/if}>text</option>
            <option value="textarea"{if $field.type=='textarea'} selected="selected"{/if}>textarea</option>
            <option value="checkbox"{if $field.type=='checkbox'} selected="selected"{/if}>checkbox</option>
            <option value="select"{if $field.type=='select'} selected="selected"{/if}>select</option>
            <option value="radio"{if $field.type=='radio'} selected="selected"{/if} disabled="disabled">radio</option>
            <option value="file"{if $field.type=='file'} selected="selected"{/if} disabled="disabled">file</option>
            </select>
            <br />
            <span class="lite">Тип поля</span>
        </div>
        <div class="form_overflow"></div>
        
        <div class="form_text">Имя</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="name" id="name" value="{$field.label}" />
            <br />
            <span class="lite"></span>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">Значение</div>
		<div class="form_input">
            <textarea name="value" id="value">{$field.value}</textarea>
            <br />
            <span class="lite">Аттрибут value, для checkbox, select, radio каждое новое значение указывайте в новой строке.</span>
        </div>
        <div class="form_overflow"></div>
        
        <div class="form_text">Описание</div>
		<div class="form_input">
        <textarea name="desc" id="desc">{$field.desc}</textarea>
         <br />
         <span class="lite">Подсказка для поля</span>
        </div>
        <div class="form_overflow"></div> 
        
        <div class="form_text">Операции и стили</div>
		<div class="form_input">
        <textarea name="oper" id="oper">{$field.operation}</textarea>
         <br />
         <span class="lite">Возможность добавить к полю новые аттрибуты, классы, стили, события.</span>
        </div>
        <div class="form_overflow"></div> 
        
        <div class="form_text">Позиция</div>
			<div class="form_input">
          		<input type="text" class="textbox_short" name="position" id="position" value="{if $field.position!==0}{$field.position}{else:}0{/if}" />
        	</div>
        <div class="form_overflow"></div> 
        
        <div class="form_text">Максимальное значение</div>
			<div class="form_input">
          		<input type="text" class="textbox_short" name="max" id="max" value="{$field.maxlength}" />
        	</div>
        <div class="form_overflow"></div> 
        
        <div class="form_text">Отмечен</div>
			<div class="form_input">
          		<input type="checkbox" class="textbox_short" name="check" id="check" value="1"{if $field.checked==1} checked="checked"{/if} />
        	</div>
        <div class="form_overflow"></div> 
        
        <div class="form_text">Отключён</div>
			<div class="form_input">
          		<input type="checkbox" class="textbox_short" name="disable" id="disable" value="1"{if $field.disabled==1} checked="checked"{/if} />
        	</div>
        <div class="form_overflow"></div> 
        
         <div class="form_text">Обязателен</div>
			<div class="form_input">
          		<input type="checkbox" class="textbox_short" name="required" id="required" value="1"{if $field.require==1} checked="checked"{/if} />
        	</div>
        <div class="form_overflow"></div> 
        
   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130"{if $field}value="Сохранить"{else:}value="Добавить поле"{/if} onclick="ajax_me('add_field');" />
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/xform/fields/{$fid}'); return false;" style="padding:5px;">Отмена</a> 
        </div>
		<div class="form_overflow"></div> 
        {form_csrf()}
</form>