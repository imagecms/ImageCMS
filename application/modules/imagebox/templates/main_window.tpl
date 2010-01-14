<div id="imagebox_main_tabs">

<h4>Загрузка файлов</h4>
<div>
    <form id="image_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action="{site_url('admin/components/run/imagebox/upload')}">
        <div class="form_text">Выберите файл:</div>
        <div class="form_input"><input type="file" name="userfile" id="file" size="30" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Или укажите URL</div>
        <div class="form_input">
            <input type="text" class="textbox_long" name="file_url" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text"></div>
        <div class="form_input">
            <input type="submit" name="action" value="Загрузить файл" class="button_silver_130" />
            <input type="button" value="Отмена"  class="button_silver_130" onclick="MochaUI.closeWindow($('imagebox_module_main_w')); return false;" />
        </div>
        <div class="form_overflow"></div>

        <iframe id="imagebox_upload_target" name="imagebox_upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
    {form_csrf()}</form>
</div>

<h4>Настройки</h4>
<div>
    <form style="width:100%;" id="imagebox_settings_form" method="post" action="{site_url('admin/components/run/imagebox/save_settings')}">
        <div class="form_text">Максимальная ширина изображения</div>
        <div class="form_input"><input type="text" class="textbox_long" name="max_width" value="{$settings.max_width}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Максимальная высота изображения</div>
        <div class="form_input"><input type="text" class="textbox_long" name="max_height" value="{$settings.max_height}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Ширина иконки</div>
        <div class="form_input"><input type="text" class="textbox_long" name="thumb_width" value="{$settings.thumb_width}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Высота иконки</div>
        <div class="form_input"><input type="text" class="textbox_long" name="thumb_height" value="{$settings.thumb_height}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Качество изображения</div>
        <div class="form_input"><input type="text" class="textbox_long" name="quality" value="{$settings.quality}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Созранять пропорции</div>
        <div class="form_input">
            <select name="maintain_ratio">
                <option value="1" {if $settings.maintain_ratio == TRUE}selected="selected"{/if}>Да</option>
                <option value="0" {if $settings.maintain_ratio == FALSE}selected="selected"{/if}>Нет</option>
            </select>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text"></div>
        <div class="form_input">
            <input type="submit" name="action" value="Сохранить" class="button_silver_130"  onclick="ajax_me('imagebox_settings_form');" />
        </div>
        <div class="form_overflow"></div>
    {form_csrf()}</form>
</div>

</div> <!-- /main tabs -->

{literal}
<script>
		window.addEvent('domready', function() {
		    var imagebox_tabs = new SimpleTabs('imagebox_main_tabs', {
		    selector: 'h4'
		    });

            document.getElementById('image_upload_form').onsubmit = function() 
            {
                document.getElementById('image_upload_form').target = 'imagebox_upload_target';
                document.getElementById("imagebox_upload_target").onload = imagebox_uploadCallback; 
            }
        });
</script>
{/literal}
