<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Category editing","admin")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/categories/cat_list" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span
                            class="t-d_u">{lang("Back","admin")}</span></a>
                    <button type="submit" class="btn btn-small btn-primary action_on formSubmit" data-action="edit"
                            data-form="#save" data-submit><i class="icon-ok icon-white"></i>{lang("Save","admin")}
                    </button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="close"
                            data-form="#save"><i class="icon-check"></i>{lang("Save and exit","admin")}</button>
                        {if count($langs) > 1}
                        <div class="dropdown d-i_b">
                            {foreach $langs as $l}
                                {if $l['default'] == 1}
                                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                                        {$l.lang_name}
                                        <span class="caret"></span>
                                    </a>
                                {/if}
                            {/foreach}
                            <ul class="dropdown-menu pull-right">
                                {foreach $langs as $l}
                                    {if !$l.default}
                                        <li>
                                            <a href="{$BASE_URL}admin/categories/translate/{$id}/{$l.id}">{$l.lang_name}</a>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>

                        </div>
                    {/if}

                </div>
            </div>
        </div>
        <form method="post" action="{$BASE_URL}admin/categories/create/update/{$id}" id="save" class="form-horizontal">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#parameters" class="btn btn-small active">{lang("Settings","admin")}</a>
                    <a href="#metatag" class="btn btn-small">{lang("Meta tags","admin")}</a>
                    <a href="#dodPol" class="btn btn-small">{lang("Additional fields","admin")}</a>
                    {if $moduleAdditions}
                        <a href="#modules_additions" class="btn btn-small">{lang('Modules additions', 'admin')}</a>
                    {/if}
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Information","admin")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="name">{lang("Name","admin")}: <span
                                                        class="must">*</span></label>

                                                <div class="controls">
                                                    <input type="text" name="name" value="{$name}" id="name">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="url">{lang("URL","admin")}:</label>

                                                <div class="controls">
                                                    <div class="group_icon pull-right">
                                                        <div>
                                                            <button onclick="translite_title('#name', '#url');"
                                                                    type="button" class="btn btn-small"
                                                                    id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang("AutoFit","admin")}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="o_h">
                                                        <input type="text" name="url" value="{$url}" id="url">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"
                                                       for="parent_id">{lang("Parent category","admin")}:</label>

                                                <div class="controls">
                                                    <select name="parent_id" id="parent_id">
                                                        <option value="0">{lang("No","admin")}</option>
                                                        { $this->view("cats_select.tpl", $this->template_vars)}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"
                                                       for="category_field_group">{lang("Field group","admin")}:</label>

                                                <div class="controls">

                                                    {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                    <select name="category_field_group" id="category_field_group">
                                                        <option value="-1">{lang("No","admin")}</option>
                                                        {foreach $f_groups as $k => $v}
                                                            <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
                                                        {/foreach}
                                                    </select>

                                                    <p class="help-block">{lang("Select a field group for a category","admin")}</p>
                                                    <span class="frame_label no_connection m-t_5 m-b_10">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" value="1"
                                                                   name="category_apply_for_subcats"
                                                                   {if  $settings['category_apply_for_subcats']== '1'} checked {/if}>
                                                        </span>
                                                        {lang("Apply for subcategories","admin")}
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"
                                                   for="field_group">{lang("Pages fields group","admin")}:</label>

                                            <div class="controls">
                                                {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                <select name="field_group" id="field_group">
                                                    <option value="-1">{lang("No","admin")}</option>
                                                    {foreach $f_groups as $k => $v}
                                                        <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
                                                    {/foreach}
                                                </select>

                                                <p class="help-block">{lang('Select a field group to be displayed/ viewed in the created category of the group or group category', 'admin')}</p>
                                                <span class="frame_label no_connection m-t_5 m-b_10">
                                                    <span class="niceCheck b_n">
                                                        <input type="checkbox" value="1" name="apply_for_subcats"
                                                               {if  $settings['apply_for_subcats']== '1'} checked {/if}>
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
                                                        <a href="{echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img');}"
                                                           class="btn  btn-small iframe-btn" type="button">
                                                            <i class="icon-picture"></i>
                                                            {lang('Choose an image ','admin')}
                                                        </a>
                                                </div>
                                                <div class="o_h">
                                                    <input type="text" name="image" id="Img" value="{$image}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="position">{lang('Position', 'admin')}:</label>

                                            <div class="controls">
                                                <input type="text" name="position" value="{$position}" id="position">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="short_desc">{lang('Description', 'admin')}
                                                :</label>

                                            <div class="controls">
                                                <textarea name="short_desc" id="short_desc"
                                                          class="elRTE">{htmlspecialchars($short_desc)}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('View page', 'admin')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="order_by">{lang('Sort by', 'admin')}:</label>

                                                <div class="controls">
                                                    <div class="pull-left span3">
                                                        <select name="order_by" id="order_by">
                                                            <option value="publish_date" {if $order_by == "publish_date"} selected="selected" {/if}>{lang('by date', 'admin')}</option>
                                                            <option value="title" {if $order_by == "title"} selected="selected" {/if}>{lang('by alphabet', 'admin')}</option>
                                                            <option value="position" {if $order_by == "position"} selected="selected" {/if}>{lang('by position', 'admin')}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <select name="sort_order">
                                                        <option value="desc" {if $sort_order == "desc"} selected="selected" {/if}>{lang('In descending order', 'admin')}</option>
                                                        <option value="asc" {if $sort_order == "asc"} selected="selected" {/if}>{lang('In ascending order', 'admin')}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="per_page">{lang('Posts on page', 'admin')}
                                                    :</label>

                                                <div class="controls">
                                                    <input type="text" name="per_page" value="{$per_page}" id="per_page"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <span class="frame_label no_connection m-t_0 m-b_15">
                                                        <span class="niceCheck b_n">
                                                            <input type="checkbox" name="comments_default"
                                                                   value="1" {if $comments_default == 1} checked="checked" {/if}  />
                                                        </span>
                                                        {lang('Comment pages by default ', 'admin')}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"
                                                       for="fetch_pages">{lang('Display pages of other categories', 'admin')}
                                                    :</label>

                                                <div class="controls">
                                                    <select name="fetch_pages[]" multiple="multiple" id="fetch_pages">
                                                        {if !$fetch_pages}
                                                            {$fetch_pages = Array()}
                                                        {/if}
                                                        {foreach $include_cats as $c}
                                                            <option value="{$c.id}" {if in_array($c.id, $fetch_pages)}  selected="selected" {/if}>{for $i=0; $i < $c.level;$i++}-{/for}{$c.name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="main_tp">{lang('Main template', 'admin')}
                                                    :</label>

                                                <div class="controls span6">
                                                    <div class="group_icon pull-right" style="margin-right: 45px;">
                                                        <button type="button" class="btn btn-small btn-success" id="create_category_tpl">
                                                            <i class="icon-plus-sign icon-white"></i>{lang('Create a new template','admin')}
                                                        </button>
                                                    </div>
                                                    <span class="d_b">
                                                        <select type="text" name="main_tpl" style="width:220px">
                                                            <option value="">--{echo lang('Not selected', 'admin')}--</option>
                                                            {foreach $template_files as $template_file}
                                                                <option {if $main_tpl == $template_file}selected="selected"{/if} value="{echo $template_file}">{echo $template_file}</option>
                                                            {/foreach}
                                                        </select>
                                                    </span>
                                                    <span class="help-block">
                                                        {lang('Main category template by default', 'admin')}
                                                        main.tpl
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="tpl">{lang('Category template', 'admin')}
                                                    :</label>

                                                <div class="controls span6">
                                                    <div class="group_icon pull-right" style="margin-right: 45px;">
                                                        <button type="button" class="btn btn-small btn-success" id="create_category_tpl">
                                                            <i class="icon-plus-sign icon-white"></i>{lang('Create a new template','admin')}
                                                        </button>
                                                    </div>
                                                    <span class="d_b">
                                                        <select type="text" name="tpl" style="width:220px">
                                                            <option value="">--{echo lang('Not selected', 'admin')}--</option>
                                                            {foreach $template_files as $template_file}
                                                                <option {if $tpl == $template_file}selected="selected"{/if} value="{echo $template_file}">{echo $template_file}</option>
                                                            {/foreach}
                                                        </select>
                                                    </span>
                                                    <span class="help-block">
                                                        {lang('Main category template by default', 'admin')}
                                                        category.tpl
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="page_tpl">{lang('Page template', 'admin')}
                                                    :</label>

                                                <div class="controls span6">
                                                    <div class="group_icon pull-right" style="margin-right: 45px;">
                                                        <button type="button" class="btn btn-small btn-success" id="create_category_tpl">
                                                            <i class="icon-plus-sign icon-white"></i>{lang('Create a new template','admin')}
                                                        </button>
                                                    </div>
                                                    <span class="d_b">
                                                        <select type="text" name="page_tpl" style="width:220px">
                                                            <option value="">--{echo lang('Not selected', 'admin')}--</option>
                                                            {foreach $template_files as $template_file}
                                                                <option {if $page_tpl == $template_file}selected="selected"{/if} value="{echo $template_file}">{echo $template_file}</option>
                                                            {/foreach}
                                                        </select>
                                                    </span>
                                                    <span class="help-block">
                                                        {lang('Page view template by default', 'admin')}
                                                        page_full.tpl
                                                    </span>
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
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('Meta tags', 'admin')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div class="control-group"><label class="control-label"
                                                                              for="title">{lang('Meta Title', 'admin')}:</label>

                                                <div class="controls">
                                                    <input type="text" name="title" value="{$title}" id="title"/>
                                                </div>
                                            </div>
                                            <div class="control-group"><label class="control-label"
                                                                              for="description">{lang('Meta Description', 'admin')}
                                                    :</label>

                                                <div class="controls">
                                                    <textarea id="description" name="description" rows="10"
                                                              cols="180">{$description}</textarea>
                                                </div>
                                            </div>
                                            <div class="control-group"><label class="control-label"
                                                                              for="keywords">{lang('Meta Keywords', 'admin')}
                                                    :</label>

                                                <div class="controls">
                                                    <textarea id="keywords" name="keywords" rows="10"
                                                              cols="180">{$keywords}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="dodPol">
                    {echo $this->CI->load->module('cfcm/admin')->form_from_category_group($id, $id, 'category')}
                </div>
                {include_tpl('modules_additions')}
            </div>
            {form_csrf()}
        </form>
    </section>
</div>
<div id="elFinder"></div>