<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{lang('Edit category','documentation')}</h4>
            </div>
            <div class="modal-body">
                <!-- Start. Modal validation errors block -->
                <div class="alert alert-block alert-danger fade in modalErrosBlock" style="display: none;"></div>
                <!-- End. Modal validation errors block -->

                <!-- Start. Modal category created succes block -->
                <div class="alert alert-block alert-success fade in modalCategoryCreatedSuccesBlock" style="display: none;">
                    {lang("Changes have been saved","documentation")}
                </div>
                <!-- End. Modal category created succes block -->

                <form role="form" id="edit_cat" action="/documentation/edit_cat/{echo $categoryData['id']}" method="POST">
                    <div class="form-group">
                        <label for="name">{lang("Name","documentation")}:</label>
                        <input type="text" value="{echo $categoryData['name']}" class="form-control" maxlength="127" id="name" name="name" required="required" placeholder="{lang("Name","documentation")}">
                    </div>

                    <div class="form-group">
                        <label for="url">{lang("URL","documentation")}:</label>
                        <div class="input-group">
                            <input type="text" value="{echo $categoryData['url_simple']}" class="form-control" id="url" maxlength="127" name="url" required="required" placeholder="{lang("URL","documentation")}">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="translite_title('#name', '#url');">{lang("AutoFit","documentation")}</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="parent_id">{lang('Parent category','documentation')}:</label>
                        <select name="category" class="form-control">
                            <option value="0" selected="selected">{lang("No","documentation")}</option>
                            {$this->view("cats_select_edit.tpl", array('tree' => $tree,'sel_cat' => $categoryData['parent_id']));}
                        </select>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" onclick="editCategory()">{lang("Save changes","documentation")}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<ul class="">
    {foreach $tree as $item}
        <!-- Check show category for group -->
        {if $item['menu_cat'] == null || $item['menu_cat'] == 'all' || $item['menu_cat'] == $group}
            {$active = false;$admin = $CI->dx_auth->is_admin();}
        {if strpos($categoryData['url'], $item['url'].'/') !== false}{$active = true}{/if}
        <li {if $active}class="active"{/if}>
            <a href="{base_url($item['path_url'])}">{$item['name']}  
                {if $categoryData['id'] == $item['id'] && $admin}
                    <span data-toggle="modal" href="#myModalEdit" class="glyphicon glyphicon-pencil pull-right editCategory"></span>
                {/if}
            </a>
            <!-- Show category sublevels -->
            {if $item['subtree']}
                <span class="tree_menu_icon glyphicon glyphicon-chevron-right"></span>
                {$this->view('left_menu.tpl', array('tree' => $item['subtree'], 'cat_path' => $cat_path, 'display' => $active, 'categoryData' => $categoryData, 'admin' =>$admin))}
            {/if}
        </li>
    {/if}
{/foreach}
</ul>
