<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_del_catego_ba')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('a_del_category_selec')}?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}/admin/categories/delete')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>


    <div id="delete_dialog" title="{lang('a_del_categoy_ba')}" style="display: none">
        {lang('a_del_catego_ba')}?
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_category')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang('a_delete')}</button>
                    <button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}/admin/categories/create_form'"><i class="icon-plus-sign icon-white"></i>{lang('create_cat')}</button>
                </div>
            </div>                            
        </div>       
        <div class="frame_level">
            {if sizeof($tree) > 0}
                <div id="category">
                    <div class="row-category p_cat_row-category head">
                        <div class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                    <input type="checkbox">
                                </span>
                            </span>
                        </div>
                        <div>{lang('a_id')}</div>
                        <div>{lang('a_title')}</div>
                        <div>{lang('a_url')}</div>
                        <div>{lang('a_pages')}</div>
                    </div>
                    <div class="body_category">
                        {$htmlTree}
                    </div>
                </div>
            {else:}
                </br>
                <div class="alert alert-info">
                    На сайте не создано ниодной категории
                </div>
            {/if}
        </div>
</div>
<div class="clearfix">

</section>
</div>
<div class="hfooter"></div>
</div>
