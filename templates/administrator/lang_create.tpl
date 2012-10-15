
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_param')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="submit"   class="btn btn-small btn-success formSubmit" data-form="#createLang" data-action="edit"><i class="icon-list-alt icon-white"></i>{lang('a_save')}</button>
                    <button type="submit"   class="btn btn-small formSubmit" data-form="#createLang" data-action="close"><i class="icon-ok"></i>{lang('a_save_and_exit')}</button>
                </div>
            </div>                            
        </div>
        <div class="content_big_td">
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('a_sett')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                        <form action="{$BASE_URL}admin/languages/insert" method="post"  id="createLang" >
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="form-horizontal">

                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="inputName">{lang('a_name')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="" />
                                                </div>
                                            </div>    
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label" for="inputName">{lang('a_identif')}:</label>
                                                    <div class="controls">
                                                        <input type="text" name="identif" id=""  />
                                                    </div>
                                                </div> 
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang('a_image_url')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="image" id="inputName"/>
                                                        </div>
                                                    </div>   
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputParent">{lang('a_folder')}:</label>
                                                        <div class="controls">
                                                            <select name="folder">
                                                                {foreach $lang_folders as $folder}
                                                                    <option value="{$folder}">{$folder}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputParent">{lang('a_tpl')}:</label>
                                                        <div class="controls">
                                                            <select name="template">
                                                                {foreach $templates as $tpl_folder}
                                                                    <option value="{$tpl_folder}">{$tpl_folder}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {form_csrf()}
                                </form>            
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>