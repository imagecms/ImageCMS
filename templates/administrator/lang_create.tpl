
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_sett_base_create_new_language')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="submit" class="btn btn-small btn-success formSubmit" data-form="#createLang" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</button>
                </div>
            </div>                            
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <form action="{$BASE_URL}admin/languages/insert" method="post"  id="createLang" >
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_param')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span9">
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="name">{lang('a_name')}:</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" id="name" required/>
                                                    </div>
                                                </div>    
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="identif">{lang('a_identif')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="identif" id="identif" required/>
                                                        </div>
                                                    </div> 
                                                    <div class="row-fluid">
                                                        <!--<div class="control-group">
                                                            <label class="control-label" for="image">{lang('a_image_url')}:</label>
                                                            <div class="controls">
                                                                <input type="text" name="image" id="image"/>
                                                            </div>
                                                        </div>  -->
                                                        <div class="control-group">
                                                            <label class="control-label" for="Img">
                                                                {lang('a_image_url')}:
                                                            </label>
                                                            <div class="controls">
                                                                <div class="group_icon pull-right">            
                                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                                </div>
                                                                <div class="o_h">		            
                                                                    <input type="text" name="image" id="Img" value="">					
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="folder">{lang('a_folder')}:</label>
                                                            <div class="controls">
                                                                <select name="folder" id="folder">
                                                                    {foreach $lang_folders as $folder}
                                                                    <option value="{$folder}">{$folder}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="template">{lang('a_tpl')}:</label>
                                                            <div class="controls">
                                                                <select name="template" id="template">
                                                                    {foreach $templates as $tpl_folder}
                                                                    <option value="{$tpl_folder}">{$tpl_folder}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {form_csrf()}
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="elFinder"></div>
