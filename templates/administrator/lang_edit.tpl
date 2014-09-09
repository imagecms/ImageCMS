<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Language edit","admin")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/languages" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span> 
                        <span class="t-d_u">
                            {lang("Go back","admin")}
                        </span>
                    </a>
                    <button type="submit" class="btn btn-small btn-success formSubmit" data-form="#editLang" data-action="edit">
                        <i class="icon-list-alt icon-white"></i>
                        {lang("Save","admin")}
                    </button>
                    <button type="submit" class="btn btn-small formSubmit" data-form="#editLang" data-action="close">
                        <i class="icon-ok"></i>
                        {lang("Save and go back","admin")}
                    </button>
                </div>
            </div>                            
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="parameters">
                <table class="table  table-bordered table-hover table-condensed t-l_a content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Settings","admin")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="form-horizontal">
                                        <form action="{$BASE_URL}admin/languages/update/{$id}" method="post" id="editLang">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label" for="inputName">{lang("Language","admin")}:</label>
                                                    <div class="controls">
                                                        <input type="text" name="lang_name" id="" value="{$lang_name}" />
                                                    </div>
                                                </div>    
                                                <div class="control-group">
                                                    <label class="control-label" for="inputName">{lang("Identifier","admin")}:</label>
                                                    <div class="controls">
                                                        <input type="text" name="identif" id="" value="{$identif}"  />
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
                                                        <label class="control-label" for="inputName">{lang("Image URL","admin")}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="image" id="" value="{$image}"/>
                                                        </div>
                                                    </div>-->
                                                    <div class="control-group">
                                                        <label class="control-label" for="Img">
                                                            {lang("Image URL","admin")}:
                                                        </label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">            
                                                                <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;"><i class="icon-picture"></i>  {lang("Choose an image","admin")}</button>
                                                            </div>
                                                            <div class="o_h">		            
                                                                <input type="text" name="image" id="Img" value="{$image}" accept="image/gif, image/jpeg, image/png, image/jpg" >					
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputParent">{lang("Template","admin")}:</label>
                                                        <div class="controls">
                                                            <select name="template">
                                                                {foreach $templates as $template}
                                                                    <option {if $template == $template_selected} selected="selected" {/if} >{$template}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div id="elFinder"></div>