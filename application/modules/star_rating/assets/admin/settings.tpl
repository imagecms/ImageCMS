<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки модуля Рейтинг</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-edit"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <form action="{$BASE_URL}admin/components/cp/star_rating/update_settings" id="widget_form" method="post" class="form-horizontal">
        <div class="tab-content">
            <div class="tab-pane active" id="likes">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <th>Отображать на страницах:</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="inside_padd">
                                        <div class="row-fluid" style ='padding:10px'>
                                            <div class="controls-group" style ='padding:5px'>
                                                 <span class="frame_label">
                                                     <span class="niceCheck">
                                                         <input type="checkbox" name="sr[main]" value="1" {if $settings->main == 1}checked="checked"{/if}/>
                                                     </span> Главной
                                                 </span>
                                             </div>
                                             <hr style ='margin:5px'>
                                             <div class="controls-group" style ='padding:5px'>
                                                 <span class="frame_label ">
                                                     <span class="niceCheck">
                                                         <input type="checkbox" name="sr[page]" value="1" {if $settings->page == 1}checked="checked"{/if}/>
                                                     </span> Cодержимого
                                                 </span>
                                             </div>
                                             <div class="controls-group" style ='padding:5px'>
                                                 <span class="frame_label">
                                                     <span class="niceCheck">
                                                         <input type="checkbox" name="sr[category]" value="1" {if $settings->category == 1}checked="checked"{/if}/>
                                                     </span>
                                                         Категории
                                                 </span>
                                             </div>
                                             {if $is_shop != null}
                                                 <hr style ='margin:5px'>
                                                 <div class="controls-group" style ='padding:5px'>
                                                     <span class="frame_label">
                                                         <span class="niceCheck">
                                                             <input type="checkbox" name="sr[product]" value="1" {if $settings->product == 1}checked="checked"{/if}/>
                                                         </span> Продукта
                                                     </span>
                                                 </div>
                                                 <div class="controls-group" style ='padding:5px'>
                                                     <span class="frame_label">
                                                         <span class="niceCheck">
                                                             <input type="checkbox" name="sr[shop_category]" value="1" {if $settings->shop_category == 1}checked="checked"{/if}/>
                                                         </span> Категории продуктов
                                                     </span>
                                                 </div>
                                                 <div class="controls-group" style ='padding:5px'>
                                                     <span class="frame_label">
                                                         <span class="niceCheck">
                                                             <input type="checkbox" name="sr[brand]" value="1" {if $settings->brand == 1}checked="checked"{/if}/>
                                                         </span> Брендов
                                                     </span>
                                                 </div>
                                             {/if}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {form_csrf()}
        </div>
    </form>
</section>
<!--                <div class="form_text">Код для вставки в шаблон:  echo $CI->load->module('share')->_make_share_form()</div>
                <div class="form_overflow"></div>-->

