<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <form id="image_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action="{site_url('admin/components/run/gallery/upload_image/' . $album['id'])}">


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

    <div>
        {foreach $album.images as $item}
        <div style="float:left; width:150px; height:150px;background-color: {if $album['cover_id'] == $item.id}#E2EEBE;{else:}#EDEDED;{/if} border:1px solid #E8E8E8;margin:15px;padding:2px;" >
            <div align="left">
                <span title="{$item.file_name}{$item.file_ext}">{truncate($item['file_name'], 10)}{$item.file_ext}</span>
            </div>
            <div align="center" style="width:150px;height:110px;">
                <img title="{$item.file_name}{$item.file_ext}" src="{site_url($album_url . '/_admin_thumbs/' . $item['file_name'] . $item['file_ext'])}" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_image/{$item.id}'); return false;"  style="cursor:pointer;border:4px solid #FFFFFF;" />
            </div>

            <div style="float:left">
            {$item.file_size} Kb 
            </div>

            <div style="height:16px;float:right;" align="right">
                <img src="{$THEME}/images/edit.png" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_image/{$item.id}'); return false;" title="Редактировать" width="16" height="16" style="cursor:pointer;" />                
                <img src="{$THEME}/images/delete.png" onclick="confirm_delete_image({$item.id}, {$album.id},'{$item.file_name}');" title="Удалить" width="16" height="16" style="cursor:pointer;" />                
            </div>
        </div>
        {/foreach}
    </div>

{literal}
	<script type="text/javascript">

        /*
        function get_coo(id)
        {
            $('img_info_box').setStyle('display', 'block'); 

            var windowSize = $(window).getSize();
			var windowScroll = $(window).getScroll();
			var halfWindowY = windowSize['y'] / 2;
			var halfWindowX = windowSize['x'] / 2;


            var info_pos = $(id).getPosition(); 
            var info_size = $('img_info_box').getSize();

            var x_p = info_pos['x'];
            var y_p = info_pos['y'];

            if(y_p > halfWindowY)
            {
                $('img_info_box').setStyle('top', y_p - (info_size['y'] / 2)); 
            }else{
               $('img_info_box').setStyle('top', y_p - 100  ); 
            }
            
            if (x_p > halfWindowX + 300)
            {
                $('img_info_box').setStyle('left', x_p - info_size['x'] - 150 );  
            }else{
                $('img_info_box').setStyle('left', x_p - info_size['x'] ); 
            }
         

            $('img_info_box').addEvent('mouseleave', function(){
			    closeBoxes.delay(1000);									  
    		});
        }

        function closeBoxes()
        {
            $('img_info_box').setStyle('display', 'none');
        }

        */

        function confirm_delete_image(id, album_id ,name)
        {
            alertBox.confirm('<h1> </h1><p>Удалить файл <b>' + name + '</b>? </p>', {onComplete:
            function(returnvalue){
            if(returnvalue)
            {
                    var req = new Request.HTML({
                       method: 'post',
                       url: base_url + 'admin/components/cp/gallery/delete_image/' + id,
                       onRequest: function() { },
                       onComplete: function(response) {
                            ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/' + album_id);
                        }
                    }).post({'img_id': id, 'album_id': album_id });
            }
            }
            });
        } 


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
