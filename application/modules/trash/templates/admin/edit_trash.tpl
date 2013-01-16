<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Редактирования ссылки</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/trash" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#edit" data-action="save" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#edit" data-action="exit"><i class="icon-check"></i>{lang('a_footer_save_exit')}</button>                    
            </div>
        </div>                            
    </div>
    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
        <thead>
            <tr>
                <th colspan="6">
                    Редактировать ссылку
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="form-horizontal">
                            <form id="edit" method="post" action="{$SELF_URL}/edit_trash/{echo $trash->id}">
                                <div class="span9">
                                    <div class="control-group">
                                        <label class="control-label" for="id">id</label>
                                        <div class="controls">
                                            <label name="id" id="id"/>{echo $trash->id}</label>
                                            <input type="hidden" name="id" id="id" value="{echo $trash->id}" required/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="old_url">Старый Url</label>
                                        <div class="controls">
                                            <label name="old_url" id="old_url">{echo $trash->trash_url}</label>
                                            <input type="hidden" name="old_url" id="old_url" value="{echo $trash->trash_url}" required/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="type">Тип</label>
                                        <div class="controls">
                                            <span class="frame_label no_connection  m-r_15">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="redirect_type" value="url" {if $trash->trash_redirect_type == 'url'}checked="checked"{/if}/>
                                                </span>
                                                Url 
                                            </span>
                                            {if count($CI->db->get_where('components', array('name' => 'shop'))->row()) > 0}
                                                <span class="frame_label no_connection m-r_15">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio" name="redirect_type" value="product" {if $trash->trash_redirect_type == 'product'}checked="checked"{/if}/>
                                                    </span>
                                                    Товар
                                                </span>
                                                <span class="frame_label no_connection m-r_15">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio" name="redirect_type" value="category" {if $trash->trash_redirect_type == 'category'}checked="checked"{/if}/>
                                                    </span>
                                                    Категория
                                                </span>
                                            {/if}
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="redirect_type" value="basecategory" {if $trash->trash_redirect_type == 'basecategory'}checked="checked"{/if}/>
                                                </span>
                                                Категория Базы
                                            </span>
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="redirect_type" value="404" {if $trash->trash_redirect_type == '404'}checked="checked"{/if}/>
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
                                                    <input type="radio" name="type" value="301" {if $trash->trash_type == '301'}checked="checked"{/if}/>
                                                </span>
                                                301 
                                            </span>
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="type" value="302" {if $trash->trash_type == '302'}checked="checked"{/if}/>
                                                </span>
                                                302
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="redirect_url">Редирект Url</label>
                                        <div class="controls">
                                            <input type="text" name="redirect_url" id="redirect_url" value="{echo $trash->trash_redirect}"s/>
                                        </div>
                                    </div>
                                    {if count($CI->db->get_where('components', array('name' => 'shop'))->row()) > 0}
                                        <div class="control-group">
                                            <label class="control-label" for="products">Товар</label>
                                            <div class="controls">
                                                <select id="inputMainC" value="" name="products">
                                                    {foreach $products as $item}
                                                        <option {if $trash->trash_id == $item->id}selected{/if} value="{echo $item->id}">{echo $item->name}</option> 
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="products">Категории</label>
                                            <div class="controls">
                                                <select id="inputMainC" value="" name="category">
                                                    {foreach $category as $item}
                                                        <option {if $trash->trash_id == $item->id}selected{/if} value="{echo $item->id}">{echo $item->name}</option> 
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
                                                    <option {if $trash->trash_id == $item->id}selected{/if} value="{echo $item->id}">{echo $item->name}</option> 
                                                {/foreach}
                                            </select>
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
</section>
{literal}
    <script type="text/javascript">
        window.onload = function() {
            if ($.exists('.datepicker')) {
                $(".datepicker").datepicker({
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    prevText: '',
                    nextText: ''
                });
            }
            $('.ui-datepicker').addClass('dropdown-menu');
        }
    </script>
{/literal}