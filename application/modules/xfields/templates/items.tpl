{ switch $type }
		{case "textbox"}
			<div class="form_text">Имя:</div>
			<div class="form_input"><input type="text" name="name" value="{$name}"  class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">Заголовок:</div>
			<div class="form_input"><input type="text" name="label_text" value="{$data.label_text}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">По умолчанию:</div>
			<div class="form_input"><input type="text" name="default_value" value="{$data.default_value}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">CSS:</div>
			<div class="form_input"><input type="text" name="css" value="{$data.css}" class="textbox_long" /></div>
			<div class="form_overflow"></div>
        {break;}
		{ case "image" }
			<div class="form_text">Имя:</div>
			<div class="form_input"><input type="text" name="name" value="{$name}"  class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">Заголовок:</div>
			<div class="form_input"><input type="text" name="label_text" value="{$data.label_text}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">По умолчанию:</div>
			<div class="form_input">
                <input type="text" name="default_value" value="{$data.default_value}" class="textbox_long" id="default_xfield_image" />
                <input type="button" value="Выбрать Изображение"  onclick="tinyBrowserPopUp('image', 'default_xfield_image');" />
            </div>
			<div class="form_overflow"></div>

			<div class="form_text">CSS:</div>
			<div class="form_input"><input type="text" name="css" value="{$data.css}" class="textbox_long" /></div>
			<div class="form_overflow"></div>
        {break;}

		{ case "user_file" }
			<div class="form_text">Имя:</div>
			<div class="form_input"><input type="text" name="name" value="{$name}"  class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">Заголовок:</div>
			<div class="form_input"><input type="text" name="label_text" value="{$data.label_text}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">По умолчанию:</div>
			<div class="form_input">
                <input type="text" name="default_value" value="{$data.default_value}" class="textbox_long" id="default_xfield_file" />
                <input type="button" value="Выбрать Файл"  onclick="tinyBrowserPopUp('file', 'default_xfield_file');" />
            </div>
			<div class="form_overflow"></div>

			<div class="form_text">CSS:</div>
			<div class="form_input"><input type="text" name="css" value="{$data.css}" class="textbox_long" /></div>
			<div class="form_overflow"></div>
        {break;}

		{ case "textarea" }
			<div class="form_text">Имя:</div>
			<div class="form_input"><input type="text" name="name" value="{$name}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">Заголовок:</div>
			<div class="form_input"><input type="text" name="label_text" value="{$data.label_text}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">По умолчанию:</div>
			<div class="form_input">
				<textarea rows="2" cols="20" name="default_value" >{$data.default_value}</textarea>
			</div>
			<div class="form_overflow"></div>

			<div class="form_text">CSS:</div>
			<div class="form_input"><input type="text" name="css" value="{$data.css}" class="textbox_long" /></div>
			<div class="form_overflow"></div>
        {break;}

		{ case "dropdown" }
			<div class="form_text">Имя:</div>
			<div class="form_input"><input type="text" name="name" value="{$name}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">Заголовок:</div>
			<div class="form_input"><input type="text" name="label_text" value="{$data.label_text}" class="textbox_long" /></div>
			<div class="form_overflow"></div>

			<div class="form_text">Значение:</div>
			<div class="form_input">
				<div id="inject_here">
					<input type="text" name="values[]" class="textbox_long" value="{$data['values'][0]}" />
					<img src="{$THEME}/images/plus.png" onclick="insert_item(); return false;" style="vertical-align: middle;cursor:pointer;" width="16" height="16" />
					{if $data['values']}
					{ foreach $data['values'] as $value }
						<script type="text/javascript">insert_item('{$value}');</script>
					{ /foreach }
					<script type="text/javascript">delete_item(0);</script>
					{/if}
					<br />
				</div>
			</div>
			<div class="form_overflow"></div>

			<div class="form_text">CSS:</div>
			<div class="form_input"><input type="text" name="css" value="{$data.css}" class="textbox_long" /></div>
			<div class="form_overflow"></div>
        {break;}

		{ default }

        {break;}

{ /switch }

		<div class="form_text">Группа</div>
		<div class="form_input">
            <select name="group_id">
                <option value="0">Нет</option>
                {foreach $groups as $group}
                <option value="{$group.id}" {if $group['id'] == $group_id} selected="selected" {/if} >{$group.title}</option>
                {/foreach}
            </select>	        
		</div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
			<input type="submit" name="button"  class="button" value="Сохранить" onclick="ajax_me(this.form.id); " />
		</div>
		<div class="form_overflow"></div>


{literal}
	<script type="text/javascript">

		var n = 0;

		function insert_item(value)
		{

		var input_box = new Element('input', {
			'id': 'values_' + n ,
			'name': 'values[]',
			'class': 'textbox_long',
			'value': value
		});

		var delete_img = new Element('img', {
			'src': theme + '/images/minus.png',
			'id': 'del_img_' + n,
			'name': n,
			'width': '16',
			'height': '16',
			'styles': {
				'vertical-align': 'middle',
				'padding-left': '4px',
				'cursor': 'pointer',
				},
			'events': {
				'click': function(){
					delete_item(this.name);
				}
			}
		});

		var overflow  = new Element('div', {id: 'empty_div'});

		input_box.inject('inject_here');
		delete_img.inject('inject_here');
		overflow.inject('inject_here');

		n = n + 1;

		}

		function delete_item(num)
		{
			$('del_img_' + num).dispose();
			$('values_' + num).dispose();
		}
	</script>
{/literal}
