    <div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <form id="image_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action="{site_url('admin/components/run/gallery/upload_image/' . $album['id'])}">
                <!-- <input name="userfile" id="file" size="27" type="file" /> -->

                <div style="height:16px;width:130px;float:left;text-align: center; overflow: hidden;" class="button_silver_130">
                <div style="color:#000000;">Выбрать файл</div>
                <input type="file" name="userfile" id="file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" />
                </div>

                <input type="submit" name="action" value="Загрузить файл" class="button_silver_130" />
                <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
                {form_csrf()}</form>
            </li>
            <li>
                <span id="upload_result"></span>
            </li>
            </ul>
        </div>

        <div align="right" style="padding:7px 13px;">
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;"  >Галерея</a> 
            >
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$category.id}'); return false;">{$category.name}</a> 
            >
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/{$album.id}'); return false;">{$album.name}</a>     
        </div>
    </div>

<div style="clear:both;"></div>


<div style="float:left;padding:10px;min-width:500px;" align="center">
   <img src="{site_url($album_url . '/' . $image['file_name'] .'_prev'. $image['file_ext'])}" style="border:4px solid #D8D8D8;" />     
</div>

<div style="float:left;padding:10px;">
	<div class="form_text">Альбом</div>
	<div class="form_input">
        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/{$album.id}'); return false;">{$album.name}</a>
    </div>
	<div class="form_overflow"></div> 

	<div class="form_text">Имя</div>
	<div class="form_input">{truncate($image.file_name, 25)}{$image.file_ext}</div>
	<div class="form_overflow"></div>

	<div class="form_text">Загружен</div>
	<div class="form_input">{date('Y-m-d H:i', $image.uploaded)}</div>
	<div class="form_overflow"></div>

	<div class="form_text">Просмотров</div>
	<div class="form_input">{$image.views}</div>
	<div class="form_overflow"></div>

	<div class="form_text">Размер файла</div>
	<div class="form_input">{$image.file_size}</div>
	<div class="form_overflow"></div> 

	<div class="form_text">Размеры изображения</div>
	<div class="form_input">{$image.width}px / {$image.height}px</div>
	<div class="form_overflow"></div> 

    <form method="post" action="{site_url('admin/components/run/gallery/update_info/' . $image.id)}" id="change_img_desc">
        <div class="form_text">Обложка</div>
        <div class="form_input"><input type="checkbox" name="cover" value="1" {if $image.id == $album['cover_id']} checked="checked" {/if} /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Позиция</div>
        <div class="form_input">
            <input type="text" class="textbox_short" value="{$image.position}" name="position" />
        </div>
        <div class="form_overflow"></div>
      
        <div class="form_text">Описание</div>
        <div class="form_input">
                    <textarea name="description" class="textarea">{$image.description}</textarea>
        </div>
        <div class="form_overflow"></div> 

        <div class="form_text"></div>
        <div class="form_input">
          <input type="submit" class="button_silver" value="Сохранить" onclick="ajax_me('change_img_desc');"  />  
          <input type="button" class="button_silver" value="Отмена" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/{$album.id}'); return false;" />
        </div>
        <div class="form_overflow"></div>
    {form_csrf()}</form>

	<div class="form_text"></div>
	<div class="form_input"></div>
	<div class="form_overflow"></div> 

	<div class="form_text">Новое имя</div>
	<div class="form_input">
        <form method="post" action="{site_url('admin/components/cp/gallery/rename_image/' . $image.id)}" id="change_imn_name_form">
            <input type="text" class="textbox_short" name="new_name" />
            <br /><br />
            <input type="submit" class="button_silver" value="Сохранить" onclick="ajax_me('change_imn_name_form');" />  
        {form_csrf()}</form>
    </div>
	<div class="form_overflow"></div>
    
	<div class="form_text"></div>
	<div class="form_input"></div>
	<div class="form_overflow"></div>  

</div>

{literal}
	<script type="text/javascript">
		window.addEvent('domready', function() {
            document.getElementById('image_upload_form').onsubmit = function() 
            {
                $('upload_result').set('html', '<img src="' + theme + '/images/spinner.gif" />'); 

                document.getElementById('image_upload_form').target = 'upload_target';
                document.getElementById("upload_target").onload = uploadCallback; 
            }
        });

        // Callback function after upload image
        function uploadCallback()
        {
            var imgIFrame = document.getElementById('upload_target');  
            var data = imgIFrame.contentWindow.document.body.innerHTML;    
            var result_arr = JSON.decode(data); 
            
            if (result_arr.error)
            {
                showMessage('Ошибка', result_arr.error);
                $('upload_result').set('html', '');  
            }else{

        var req = new Request.HTML({
    			method: 'post',
	    		url: base_url + 'admin/components/run/gallery/edit_album/{/literal}{$album.id}{literal}',
    			update: 'page',
		    	evalResponse: true,
	    		onComplete: function(response) {  }
    		}).send();
                
            }
        }
    </script>

{/literal}
