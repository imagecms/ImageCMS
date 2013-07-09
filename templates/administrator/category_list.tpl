<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang("Delete category")}</h3>
        </div>
        <div class="modal-body">
            <p>{lang("Remove selected categories")}?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}admin/categories/delete')" >{lang("Delete")}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel")}</a>
        </div>
    </div>


    <div id="delete_dialog" title="{lang("Delete a category")}" style="display: none">
        {lang("Delete category")}?
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Categories")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i>{lang("Delete")}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/categories/create_form'"><i class="icon-plus-sign icon-white"></i>{lang("Create category")}</button>
                </div>
            </div>                            
        </div>       
        <div class="frame_table table table-striped table-bordered table-hover table-condensed pages-table">
            <div id="category">
                <div class="row-category head">
                    <div class="t-a_c">
                        <span class="frame_label">
                            <span class="niceCheck b_n">
                                <input type="checkbox"/>
                            </span>
                        </span>
                    </div>
                    <div>{lang("ID")}</div>
                    <div>{lang("Title")}</div>
                    <div>{lang("URL")}</div>
                    <div>{lang("Pages")}</div>
                </div>
                <div class="body_category frame_level">
                    <div class="sortable save_positions" data-url="/admin/categories/save_positions/">
                        {$catTreeHTML}                                              
                    </div>
                </div>
            </div>


    </section>
</div>
<div class="hfooter"></div>