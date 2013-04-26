<section class="mini-layout">
    <div class="tab-content">
            <div class="row-fluid">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" />
                                    </span>
                                </span>
                            </th>
                            <th class="span1">{lang('a_ID')}</th>
                            <th class="span7">Контактная информация</th>
                            <th class="span5">Вопрос</th>
                            <th class="span5">Ссилка</th>
                            <th class="span1" style="width:85px;">Обработан</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        {foreach $data as $d}
                            <tr>
                                <td class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="{echo $d['id']}"/>
                                        </span>
                                    </span>
                                </td>
                                <td>{echo $d['id']}</td>
                                <td>
                                {echo $d['name']}<br/>
                                {echo $d['email']}<br/>
                                {echo $d['phone']}</td>
                                <td>{echo $d['question']}</td>
                                <td></td>
                                <td>
                                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top">
                                        <span class="prod-on_off {if $d['processed'] != 1 }disable_tovar{/if}" style="{if $d['processed'] != 1}left: -28px;{/if}" {if $d['processed'] == 1 }rel="true"{else:}rel="false"{/if}
                                              onclick="ChangeProcessed(this,{echo $d['id']});"></span>
                                    </div>
                                </td>

                                </div>
                                </td>
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
<!--            <div style="float:right;padding:10px 10px 0 0" class="pagination">
                {//$pagination}
            </div>-->
        </div>
</section>
<!--                <div class="form_text">Код для вставки в шаблон:  echo $CI->load->module('share')->_make_share_form()</div>
                <div class="form_overflow"></div>-->

