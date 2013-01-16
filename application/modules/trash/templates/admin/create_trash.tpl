<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Создание нового редиректа</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/init_window/trash" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>                   
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#create" data-action="create" data-submit><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#create" data-action="exit"><i class="icon-check"></i>{lang('a_cre_exit_form')}</button>
                </div>
            </div>                            
        </div>

        <!----------------------------------------------------- CREATE TRASH-------------------------------------------------------------->
        <div class="tab-pane">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                            Данные нового треша
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span12">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="create" method="post" action="{$SELF_URL}/create_trash">

                                            <div class="control-group">
                                                <label class="control-label" for="url">Url</label>
                                                <div class="controls">
                                                    <input type="text" name="url" id="Url" value="" required autocomplete="off"/>
                                                </div> 
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="redirect_type">Тип</label>
                                                <div class="controls">
                                                    <span class="frame_label no_connection m-r_15">
                                                        <span class="niceRadio b_n">
                                                            <input type="radio" name="redirect_type" value="url" checked="checked"/>
                                                        </span>
                                                        Url 
                                                    </span>
                                                    {if count($CI->db->get_where('components', array('name' => 'shop'))->row()) > 0}
                                                        <span class="frame_label no_connection m-r_15">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="redirect_type" value="product" />
                                                            </span>
                                                            Товар
                                                        </span>
                                                        <span class="frame_label no_connection m-r_15">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="redirect_type" value="category" />
                                                            </span>
                                                            Категория
                                                        </span>
                                                    {/if}
                                                    <span class="frame_label no_connection m-r_15">
                                                        <span class="niceRadio b_n">
                                                            <input type="radio" name="redirect_type" value="basecategory" />
                                                        </span>
                                                        Категория Базы
                                                    </span>
                                                    <span class="frame_label no_connection m-r_15">
                                                        <span class="niceRadio b_n">
                                                            <input type="radio" name="redirect_type" value="404" />
                                                        </span>
                                                        404
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="type">Вид</label>
                                                <div class="controls">
                                                    <span class="frame_label no_connection m-r_15">
                                                        <span class="niceRadio b_n">
                                                            <input type="radio" name="type" value="301" checked="checked"/>
                                                        </span>
                                                        301 
                                                    </span>
                                                    <span class="frame_label no_connection m-r_15">
                                                        <span class="niceRadio b_n">
                                                            <input type="radio" name="type" value="302" />
                                                        </span>
                                                        302
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="redirect_url">Redirect Url</label>
                                                <div class="controls">
                                                    <input type="text" name="redirect_url" id="RedirectUrl" value="" autocomplete="off"/>
                                                </div>
                                            </div>
                                                    
                                            {if count($CI->db->get_where('components', array('name' => 'shop'))->row()) > 0}
                                                <div class="control-group">
                                                    <label class="control-label" for="products">Продукты</label>
                                                    <div class="controls">
                                                        <select id="inputMainC" value="" name="products">
                                                            {foreach $products as $item}
                                                                <option value="{echo $item->id}">{echo $item->name}</option> 
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="products">Категории</label>
                                                    <div class="controls">
                                                        <select id="inputMainC" value="" name="category">
                                                            {foreach $category as $item}
                                                                <option value="{echo $item->id}">{echo $item->name}</option> 
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                            {/if}
                                            
                                            <div class="control-group">
                                                <label class="control-label" for="products">Категории Базы</label>
                                                <div class="controls">
                                                    <select id="inputMainC" value="" name="category_base">
                                                        {foreach $category_base as $item}
                                                            <option value="{echo $item->id}">{echo $item->name}</option> 
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </section>
</div>