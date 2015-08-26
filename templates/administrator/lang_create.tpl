
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("The creation of a new language","admin")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back","admin")}</span></a>
                    <button type="submit" class="btn btn-small btn-success formSubmit" data-form="#createLang" data-action="edit" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create","admin")}</button>
                    <button id="clickButton" type="submit" class="btn btn-small formSubmit" data-form="#createLang" data-action="close" data-submit style="display: none">z</button>
                    <button type="submit" class="btn btn-small" onclick="submitAndExit()">
                        <i class="icon-check"></i>
                        {lang("Create and exit","admin")}
                    </button>
                </div>
            </div>                            
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="parameters">
                <form action="{$BASE_URL}admin/languages/insert" method="post"  id="createLang" >
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Properties","admin")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="name">{lang("Language","admin")}: <span class="must">*</span></label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="name" required/>
                                                </div>
                                            </div>    
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label" for="identif">{lang("Identifier","admin")}: <span class="must">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name="identif" id="identif" required/>
                                                    </div>
                                                </div> 
                                                <div class="control-group">
                                                    <label class="control-label" for="locale">{lang("Localization","admin")}:</label>
                                                    <div class="controls">
                                                        <select id="locale" name="locale">
                                                            {foreach $locales as $locale_name}
                                                                <option {if $locale_name == $locale} selected="selected" {/if} >{echo $locale_name}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row-fluid">
                                                    <!--<div class="control-group">
                                                        <label class="control-label" for="image">{lang("Image URL","admin")}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="image" id="image"/>
                                                        </div>
                                                    </div>  -->
                                                    <div class="control-group">
                                                        <label class="control-label" for="Img">
                                                            {lang("Image URL","admin")}:
                                                        </label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">  
                                                                {if MAINSITE != ''}
                                                                    <button type="button" class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;"><i class="icon-picture"></i>  {lang("Choose an image ","admin")}</button>
                                                                {else:}
                                                                    <a href="{echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img');}" class="btn  btn-small iframe-btn" type="button">
                                                                        <i class="icon-picture"></i>
                                                                        {lang('Choose an image ','admin')}
                                                                    </a>
                                                                {/if}    
                                                                {/*<button type="button" class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;"><i class="icon-picture"></i>  {lang("Choose an image ","admin")}</button>*/}
                                                            </div>
                                                            <div class="o_h">		            
                                                                <input type="text" name="image" id="Img" value="" accept="image/gif, image/jpeg, image/png, image/jpg">					
                                                            </div>
                                                        </div>
                                                    </div>
                                                    { /* } 
                                                    <div class="control-group">
                                                        <label class="control-label" for="folder">{lang("Folder","admin")}:</label>
                                                        <div class="controls">
                                                            <select name="folder" id="folder">
                                                                {foreach $lang_folders as $folder}
                                                                    <option value="{$folder}">{$folder}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    { */ }
                                                    { /* }
                                                    <div class="control-group">
                                                        <label class="control-label" for="template">{lang("Template","admin")}:</label>
                                                        <div class="controls">
                                                            <select name="template" id="template">
                                                                {foreach $templates as $tpl_folder}
                                                                    <option value="{$tpl_folder}">{$tpl_folder}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    { */ }
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <span id="insertSubmitAndExit"></span>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </section>
</div>
<div id="elFinder"></div>
{literal}
    <script type="text/javascript">
        function submitAndExit() {
            var hiddenInsert = "<input type='hidden' value='1' name='create_exit'>";
            $('#insertSubmitAndExit').append(hiddenInsert);
            $('#clickButton').click();
        }
    </script>
{/literal}