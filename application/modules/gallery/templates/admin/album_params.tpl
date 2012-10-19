<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_album')} #{$album.id}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span7">
                <form method="post" action="{site_url('admin/components/cp/gallery/update_album/' . $album.id )}" id="create_album_form">
                    <div class="control-group">
                        <label class="control-label" for="category_id">{lang('amt_category')}:</label>
                        <div class="controls">
                            <select name="category_id" id="category_id">
                                {foreach $categories as $item}
                                <option value="{$item.id}"  {if $item['id'] == $album['category_id'] }selected="selected"{/if} >{$item.name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name">{lang('amt_name')}:</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value="{htmlspecialchars($album.name)}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="">{lang('amt_description')}:</label>
                        <div class="controls">
                            <textarea name="description" class="mceEditor">{htmlspecialchars($album.description)}</textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="">{lang('amt_position')}:</label>
                        <div class="controls">
                            <input type="text" name="position" value="{$album.position}" class="textbox_long" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="">{lang('amt_template_file')}:</label>
                        <div class="controls">
                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                            <div class="o_h">
                                <input type="text" name="tpl_file" value="{$album.tpl_file}" class="textbox_long" />
                                <div class="help-block">{lang('amt_by_default')} album.tpl</div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for=""></label>
                        <div class="controls">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for=""></label>
                        <div class="controls">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for=""></label>
                        <div class="controls">

                        </div>
                    </div>
                   
                    <div class="form_input">
                        <input type="submit" name="button"  class="button_130" value="{lang('amt_save')}" onclick="ajax_me('create_album_form');" /> 
                        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$album.category_id}'); return false;" style="padding:5px;">{lang('amt_cancel')}</a> 
                    </div>
                    <div class="form_overflow"></div> 


                    {form_csrf()}</form>

                <form method="post" action="" style="width:100%;margin-top:50px;">

                    <div class="form_text"></div>
                    <div class="form_input"><b>{lang('amt_album_delete')}</b></div>
                    <div class="form_overflow"></div> 

                    <div class="form_text"></div>
                    <div class="form_input">
                        <label><input type="checkbox" value="1" name="delete_folder" id="delete_folder" /> {lang('amt_delete_all_images')}</label>
                    </div>
                    <div class="form_overflow"></div> 

                    <div class="form_text"></div>
                    <div class="form_input">
                        <input type="button" name="button"  class="button_130" value="{lang('amt_delete')}" onclick="confirm_delete_album({$album.id}, '{str_replace(array("'",'"'), '', $album.name)}');" /> 
                    </div>
                    <div class="form_overflow"></div> 

                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</section>
