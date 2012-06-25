<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Настройки</p>
            </li>
            </ul>
        </div>

        <div align="right" style="padding:5px;">
            <input type="button" class="button_silver_130" value="Отмена" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;"/>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/gallery/settings/update')}" id="gallery_settings_form" style="width:100%;">
   		<div class="form_text"></div>
		<div class="form_input">
            <b>Категории и альбомы</b>
        </div>
		<div class="form_overflow"></div> 

        <div class="form_text">Сортировать:</div>
        <div class="form_input">
            <select name="order_by">
                <option value="date" {if $settings.order_by == "date"} selected="selected" {/if}>По дате</option>    
                <option value="name" {if $settings.order_by == "name"} selected="selected" {/if}>По алфавиту</option>    
                <option value="position" {if $settings.order_by == "position"} selected="selected" {/if}>По позиции</option> 
            </select>

            <select name="sort_order">
                <option value="desc" {if $settings.sort_order == "desc"} selected="selected" {/if}>Убыванию</option> 
                <option value="asc" {if $settings.sort_order == "asc"} selected="selected" {/if}>Возрастанию</option>    
            </select>
        </div>
        <div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <b>Изображения</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Максимальный размер файла</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.max_file_size}" name="max_file_size" /> в мегабайтах
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Максимальная ширина</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.max_width}" name="max_width" /> px
        </div>
		<div class="form_overflow"></div> 


   		<div class="form_text">Максимальная высота</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.max_height}" name="max_height" /> px
        </div>
		<div class="form_overflow"></div> 


   		<div class="form_text">Качество</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.quality}" name="quality" /> %
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Сохранять пропорции</div>
		<div class="form_input">
            <label><input type="radio" value="1" {if $settings.maintain_ratio == TRUE}checked="checked"{/if}   name="maintain_ratio" /> Да</label>
            <label><input type="radio" value="0" {if $settings.maintain_ratio == FALSE}checked="checked"{/if} name="maintain_ratio" /> Нет</label>
        </div>
		<div class="form_overflow"></div> 

		<div class="form_text">Обрезать края</div>
		<div class="form_input">
           	<label><input type="radio" value="1" {if $settings.crop == TRUE}checked="checked"{/if}   name="crop" /> Да</label>
           	<label><input type="radio" value="0" {if $settings.crop == FALSE}checked="checked"{/if} name="crop" /> Нет</label>
       	</div>
		<div class="form_overflow"></div>	 


   		<div class="form_text"></div>
		<div class="form_input">
            <b>Предварительный просмотр изображений</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Ширина</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.prev_img_width}" name="prev_img_width" /> px
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Высота</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.prev_img_height}" name="prev_img_height" /> px
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Сохранять пропорции</div>
		<div class="form_input">
            <label><input type="radio" value="1" {if $settings.maintain_ratio_prev == TRUE}checked="checked"{/if}   name="maintain_ratio_prev" /> Да</label>
            <label><input type="radio" value="0" {if $settings.maintain_ratio_prev == FALSE}checked="checked"{/if} name="maintain_ratio_prev" /> Нет</label>
        </div>
		<div class="form_overflow"></div> 

		<div class="form_text">Обрезать края</div>
		<div class="form_input">
           	<label><input type="radio" value="1" {if $settings.crop_prev == TRUE}checked="checked"{/if}   name="crop_prev" /> Да</label>
           	<label><input type="radio" value="0" {if $settings.crop_prev == FALSE}checked="checked"{/if} name="crop_prev" /> Нет</label>
       	</div>
		<div class="form_overflow"></div>	 


   		<div class="form_text"></div>
		<div class="form_input">
            <b>Иконки изображений</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Ширина</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.thumb_width}" name="thumb_width" /> px
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Высота</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.thumb_height}" name="thumb_height" /> px
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Сохранять пропорции</div>
		<div class="form_input">
            <label><input type="radio" value="1" {if $settings.maintain_ratio_icon == TRUE}checked="checked"{/if} name="maintain_ratio_icon" /> Да</label>
            <label><input type="radio" value="0" {if $settings.maintain_ratio_icon == FALSE}checked="checked"{/if} name="maintain_ratio_icon" /> Нет</label>
        </div>
		<div class="form_overflow"></div> 

		<div class="form_text">Обрезать края</div>
		<div class="form_input">
           	<label><input type="radio" value="1" {if $settings.crop_icon == TRUE}checked="checked"{/if}   name="crop_icon" /> Да</label>
           	<label><input type="radio" value="0" {if $settings.crop_icon == FALSE}checked="checked"{/if} name="crop_icon" /> Нет</label>
       	</div>
		<div class="form_overflow"></div>	 


   		<div class="form_text"></div>
		<div class="form_input">
            <b>Водяной знак</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Горизонтальное выравнивание</div>
		<div class="form_input">
            <select name="wm_hor_alignment">
                <option {if $settings.wm_hor_alignment == 'left'}selected="selected"{/if} value="left">слева</option>
                <option {if $settings.wm_hor_alignment == 'center'}selected="selected"{/if} value="center">по центру</option>
                <option {if $settings.wm_hor_alignment == 'right'}selected="selected"{/if} value="right">справа</option>
            </select>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Вертикальное выравнивание</div>
		<div class="form_input">
            <select name="wm_vrt_alignment">
                <option {if $settings.wm_vrt_alignment == 'top'}selected="selected"{/if} value="top">вверху</option>
                <option {if $settings.wm_vrt_alignment == 'middle'}selected="selected"{/if} value="middle">посередине</option>
                <option {if $settings.wm_vrt_alignment == 'bottom'}selected="selected"{/if} value="bottom">снизу</option>
            </select>
        </div>
		<div class="form_overflow"></div> 

  		<div class="form_text">Тип</div>
		<div class="form_input">
            <select name="watermark_type" onchange="show_watermark_block();" id="watermark_type">
                <option value="text"  {if $settings.watermark_type == 'text'}selected="selected"{/if}  >Текст</option>
                <option value="overlay" {if $settings.watermark_type == 'overlay'}selected="selected"{/if} >Изображение</option>
            </select>
        </div>
		<div class="form_overflow"></div> 

        <!-- Image settings -->
        <div id="image_settings"  {if $settings.watermark_type == 'text'}style="display:none;"{/if} >
            <div class="form_text">Путь к изображению</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_image}" name="watermark_image"/>
                <br/><span class="lite">Файл должен находится на сервере. Например: ./uploads/images/logo.png</span>            
            </div>
            <div class="form_overflow"></div> 
         
            <div class="form_text">Прозрачность</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_image_opacity}" name="watermark_image_opacity" /> %
                <br/><span class="lite">Укажите значение от 1 до 100.</span> 
            </div>
            <div class="form_overflow"></div> 

            <div class="form_text">Смещение</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_padding}" name="watermark_padding" /> px
            </div>
            <div class="form_overflow"></div> 
        </div>
        <!-- / image settings -->
        
        <div id="text_settings" {if $settings.watermark_type == 'overlay'}style="display:none;"{/if}>
            <div class="form_text">Текст</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_text}" name="watermark_text" />
            </div>
            <div class="form_overflow"></div> 

            <div class="form_text">Размер шрифта</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_font_size}" name="watermark_font_size" />
            </div>
            <div class="form_overflow"></div>
            
            <div class="form_text">Цвет шрифта</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_color}" name="watermark_color" />
            </div>
            <div class="form_overflow"></div>   

            <div class="form_text">Смещение</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_padding}" name="watermark_padding" /> px
            </div>
            <div class="form_overflow"></div> 

            <div class="form_text">Путь к шрифту</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_font_path}" name="watermark_font_path" />
            </div>
            <div class="form_overflow"></div>
        </div>
               
   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Сохранить" onclick="ajax_me('gallery_settings_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery'); return false;" style="padding:5px;">Отмена</a> 
        </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>

{literal}
    <script type="text/javascript">
        function show_watermark_block()
        {
            var type = $('watermark_type').value;

            if (type == 'text')
            {
                $('text_settings').setStyle('display', 'block');
                $('image_settings').setStyle('display', 'none');
            }else{
                $('text_settings').setStyle('display', 'none');
                $('image_settings').setStyle('display', 'block');
            }
        }
    </script>
{/literal}
