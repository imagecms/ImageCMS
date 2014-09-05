<div class="container">       
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Category creating","admin")}</span>
            </div>

            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/categories/cat_list" class="t-d_n m-r_15"><span class="f-s_14 pjax">←</span> <span class="t-d_u">{lang("Back","admin")}</span></a>
                    <button type="button" class="btn btn-small action_on btn-success formSubmit" data-action="edit" data-form="#save" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create","admin")}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#save"><i class="icon-check"></i>{lang("Create and exit","admin")}</button>                   
                </div>
            </div>                            
        </div>
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#parameters" class="btn btn-small active">{lang("Settings","admin")}</a>
                <a href="#metatag" class="btn btn-small">{lang("Meta-tags","admin")}</a>
                {if $moduleAdditions}
                    <a href="#modules_additions" class="btn btn-small">{lang('Modules additions', 'admin')}</a>
                {/if}
            </div>                    
        </div>
        <form method="post" id="save" action="{$BASE_URL}admin/categories/create/new" >
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
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="name">{lang("Name","admin")}:</label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="name" required>
                                                </div>
                                            </div>      

                                            <div class="control-group">
                                                <label class="control-label" for="url">{lang("URL","admin")}:</label>

                                                <div class="controls">
                                                    <div class="group_icon pull-right">
                                                        <div class="">                                                                           
                                                            <button onclick="translite_title('#name', '#url');" type="button" class="btn btn-small" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang("AutoFit","admin")}</button>
                                                        </div>
                                                    </div>
                                                    <div class="o_h">
                                                        <input type="text" name="url" id="url">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="parent_id">{lang('Parent category','admin')}:</label>
                                                <div class="controls">
                                                    <select id="parent_id" name="parent_id">
                                                        <option value="0" selected="selected">{lang("No","admin")}</option>
                                                        { $this->view("cats_select.tpl", $this->template_vars); }
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="category_field_group">{lang("Field group","admin")}:</label>
                                                <div class="controls">
                                                    {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                    <select name="category_field_group" id="category_field_group">
                                                        <option value="-1">{lang("No","admin")}</option>
                                                        {foreach $f_groups as $k => $v}
                                                            <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
                                                        {/foreach}
                                                    </select>

                                                    <p class="help-block">{lang("Select a field group for a category","admin")}.</p>
                                                    <span class="frame_label no_connection m-t_20">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="category_apply_for_subcats" /> 
                                                        </span>
                                                        {lang("Apply for subcategories","admin")}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="field_group">{lang("Pages fields group","admin")}:</label>
                                                <div class="controls">
                                                    {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                    <select name="field_group" id="field_group">
                                                        <option value="-1">{lang("No","admin")}</option>
                                                        {foreach $f_groups as $k => $v}
                                                            <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
                                                        {/foreach}
                                                    </select>
                                                    <span class="help-block">{lang("Select a field group to be displayed/ viewed in the created category of the group or group category", 'admin')}.</span>
                                                    <span class="frame_label no_connection m-t_20">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1" name="apply_for_subcats" /> 
                                                        </span>
                                                        {lang("Apply for subcategories","admin")}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="Img">
                                                    {lang("Image","admin")}:                            
                                                </label>
                                                <div class="controls">
                                                    <div class="group_icon pull-right">
                                                        <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                return false;">
                                                            <i class="icon-picture"></i>  
                                                            {lang("Choose an image ","admin")}
                                                        </button>
                                                    </div>
                                                    <div class="o_h">
                                                        <input type="text" name="image" id="Img"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="position">{lang("Position","admin")}:</label>
                                                <div class="controls">
                                                    <input type="text" name="position" value="0"  id="position" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="short_desc">{lang("Description","admin")}:</label>
                                                <div class="controls">
                                                    <textarea name="short_desc" id="short_desc" class="elRTE"></textarea>
                                                </div>
                                            </div>                                                        
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table  table-bordered table-hover table-condensed t-l_a content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("View page","admin")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd span9">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="order_by">{lang("Sort by","admin")}:</label>
                                                <div class="controls">
                                                    <div class="pull-left span6 p-r_10">
                                                        <select name="order_by" id="order_by">
                                                            <option value="publish_date" selected="selected">{lang("by date","admin")}</option>    
                                                            <option value="title">{lang("by alphabet","admin")}</option>    
                                                            <option value="position">{lang("by position","admin")}</option>    
                                                        </select>
                                                    </div>
                                                    <div class="pull-left span6 p-l_10">
                                                        <select name="sort_order">
                                                            <option value="desc" selected="selected">{lang("In descending order","admin")}</option> 
                                                            <option value="asc">{lang("In ascending order","admin")}</option>    
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="per_page">{lang("Posts on page","admin")}:</label>
                                                <div class="controls">
                                                    <input type="text" name="per_page" value="15" id="per_page"/> 
                                                    <div class="frame_label no_connection">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="comments_default" value="1" />
                                                        </span>
                                                        {lang("Comment pages by default ","admin")}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="fetch_pages">{lang("Display pages of other categories","admin")}:</label>
                                                <div class="controls">

                                                    <div class="o_h">
                                                        <select name="fetch_pages[]"  multiple="multiple" size="5" id="fetch_pages">
                                                            {foreach $include_cats as $c}
                                                                <option value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
                                                            {/foreach}
                                                        </select>

                                                    </div>
                                                </div></div>

                                            <div class="control-group">
                                                <label class="control-label" for="main_tpl">{lang("Main template","admin")}:</label>
                                                <div class="controls">
                                                    <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                    <div class="o_h">
                                                        <input type="text" name="main_tpl" value=""  id="main_tpl" />                                                                              </div>
                                                    <span class="help-block">{lang("Main category template by default","admin")}  main.tpl</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="tpl">{lang("Category template","admin")}:</label>
                                                <div class="controls">
                                                    <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                    <div class="o_h">
                                                        <input type="text" name="tpl" value="" id="tpl" /> 

                                                    </div>
                                                    <span class="help-block">{lang("Main category template by default","admin")}  category.tpl</sapn>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="page_tp">{lang("Page template","admin")}:</label>
                                                <div class="controls">
                                                    <div class="help-block pull-right">&nbsp;&nbsp;.tpl</div>
                                                    <div class="o_h">
                                                        <input type="text" name="page_tpl" value="" id="page_tp" />                                                           
                                                    </div>
                                                    <span class="help-block">{lang("Page view template by default","admin")} page_full.tpl</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="metatag">
                    <table class="table  table-bordered table-hover table-condensed t-l_a content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Meta tags","admin")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd span9">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="title">{lang("Meta Title","admin")}:</label>
                                                <div class="controls">
                                                    <input type="text" name="title" value="" id="title" />
                                                </div>
                                            </div>
                                            <div class="control-group"><label class="control-label" for="descriptions">{lang("Meta Description","admin")}:</label>
                                                <div class="controls">
                                                    <textarea id="descriptions"  name="description" rows="10" cols="180" ></textarea>
                                                </div>
                                            </div>
                                            <div class="control-group"><label class="control-label" for="keywordss">{lang("Meta Keywords","admin")}:</label>
                                                <div class="controls">
                                                    <textarea id="keywordss" name="keywords" rows="10" cols="180" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>   
                {include_tpl('modules_additions')}
                {form_csrf()}
        </form>
        <div class="tab-pane">

        </div>
</div>
</section>
</div>
<div id="elFinder"></div>