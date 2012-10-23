<section class="mini-layout">
                
                    <div class="frame_title clearfix">
                        <div class="pull-left w-s_n">
                            <span class="help-inline"></span>
                            <span class="title w-s_n">aaaaaaaaaaaaaaa</span>
						</div>
                        <div class="pull-right">
                            <div class="d-i_b">
                                <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                                <label for="addPictures" style="display:inline;">
                                <button type="button" class="btn btn-small btn-primary action_on"><i class="icon-white icon-plus"></i>Add pictures</button>
                                </label>
                                <button type="button" class="btn btn-small action_on btn-success formSubmit" data-form="#addPics"><i class="icon-white icon-ok"></i>Сохранить</button>
                                <button type="button" class="btn btn-small action_on formSubmit" data-form="#addPics"><i class="icon-check"></i>Сохранить и выйти</button>
                            </div>
                        </div>                            
                    </div>  
          
        
    <div id="picsToUpload" >
    </div>
                
	<div>
        {foreach $album.images as $item}
        <div>
            <div>
                <span title="{$item.file_name}{$item.file_ext}">{truncate($item['file_name'], 10)}{$item.file_ext}</span>
            </div>
            <div >
                <img title="{$item.file_name}{$item.file_ext}" src="{media_url($album_url . '/' . $item['file_name'] .'_prev'. $item['file_ext'])}" style="max-width:160px;" />
            </div>

            <div>
            {$item.file_size} Kb 
            </div>

            <div >
                <img src="{$THEME}/images/edit.png" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_image/{$item.id}'); return false;" title="{lang('amt_edit')}" width="16" height="16" style="cursor:pointer;" />                
                <img src="{$THEME}/images/delete.png" onclick="confirm_delete_image({$item.id}, {$album.id},'{$item.file_name}');" title="Удалить" width="16" height="16" style="cursor:pointer;" />                
            </div>
        </div>
        {/foreach}
    </div>
    
    <div>
    	<form action="/admin/components/cp/gallery/upload_image/{$album.id}" id="addPics" method="post"  enctype="multipart/form-data">
    		<input type="file" multiple="multiple"  name="newPic[]" id="addPictures" class="multiPic" data-previewdiv="#picsToUpload">
    	</form>
    </div>
</section>