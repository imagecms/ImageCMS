<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Language edit")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back")}</span></a>
                    <button type="submit"   class="btn btn-small btn-success formSubmit" data-form="#editLang" data-action="edit"><i class="icon-list-alt icon-white"></i>{lang("Have been saved")}</button>
                    <button type="submit"   class="btn btn-small formSubmit" data-form="#editLang" data-action="close"><i class="icon-ok"></i>{lang("Save and go back")}</button>
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
                                    {lang("Settings")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <form action="{$BASE_URL}admin/languages/update/{$id}" method="post" id="editLang">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang("Name")}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="" value="{$lang_name}" />
                                                        </div>
                                                    </div>    
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang("Identifier")}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="identif" id="" value="{$identif}"  />
                                                        </div>
                                                    </div> 
                                                    <div class="row-fluid">
                                                        <!--<div class="control-group">
                                                            <label class="control-label" for="inputName">{lang("Image URL")}:</label>
                                                            <div class="controls">
                                                                <input type="text" name="image" id="" value="{$image}"/>
                                                            </div>
                                                        </div>-->
                                                        <div class="control-group">
                                                            <label class="control-label" for="Img">
                                                                {lang("Image URL")}:
                                                            </label>
                                                            <div class="controls">
                                                                <div class="group_icon pull-right">            
                                                                    <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang("Choose an image")}</button>
                                                                </div>
                                                                <div class="o_h">		            
                                                                    <input type="text" name="image" id="Img" value="{$image}">					
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputParent">{lang("Folder")}:</label>
                                                            <div class="controls">
                                                                <select name="folder">
                                                                    {foreach $lang_folders as $folder}
                                                                        <option {if $folder == $folder_selected} selected="selected" {/if} >{$folder}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputParent">{lang("Template")}:</label>
                                                            <div class="controls">
                                                                <select name="template">
                                                                    {foreach $templates as $template}
                                                                        <option {if $template == $template_selected} selected="selected" {/if} >{$template}</option>
                                                                    {/foreach}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="elFinder"></div>