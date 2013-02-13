<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Комментарии</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <div class="dropdown d-i_b">
                    <button type="button" class="btn btn-small dropdown-toggle disabled action_on" data-toggle="dropdown">
                        <i class="icon-tag"></i>
                        {lang('a_mark')}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="to_pspam">В спам</a></li>
                        <li><a href="#" class="to_wait">В ожидающие</a></li>
                        <li><a href="#" class="to_approved">В одобреные</a></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-small btn-danger disabled action_on" id="comment_delete"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                <a class="btn btn-small pjax" href="/admin/components/cp/comments/show_settings"><i class="icon-wrench"></i>Настройки</a>
            </div>
        </div>    
    </div>
    <div class="btn-group myTab m-t_20">
        <a class="btn btn-small pjax {if $status == 'all' OR $status== NULL}active{/if}" href="/admin/components/cp/comments/index/status/all/page/0">{lang('amt_all_comments')}
            {if $all_comm_show}
                <span style="top:-13px;" class="badge badge-important">
                    {$all_comm_show}
                </span>
            {/if}
        </a>
        <a class="btn btn-small pjax {if $status == 'waiting'}active{/if}" href="/admin/components/cp/comments/index/status/waiting/page/0">{lang('amt_waighting_for_moderation')}
            {if $total_waiting>0}
                <span style="top:-13px;" class="badge badge-important">{$total_waiting}</span>
            {/if}
        </a>
        <a class="btn btn-small pjax {if $status == 'approved'}active{/if}" href="/admin/components/cp/comments/index/status/approved/page/0">{lang('amt_approved')}
            {if $total_app>0}
                <span style="top:-13px;" class="badge badge-important">
                    {$total_app}
                </span>
            {/if}
        </a>
        <a class="btn btn-small pjax {if $status == 'spam'}active{/if}" href="/admin/components/cp/comments/index/status/spam/page/0">
            {lang('amt_spam')}
            {if $total_spam>0}
                <span style="top:-13px;" class="badge badge-important">
                    {$total_spam}
                </span>
            {/if}
        </a>
    </div>
    <div class="tab-content">
        {if count($comments) > 0 AND is_array($comments)}
            <div class="tab-pane active" id="modules">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" value="On"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('amt_id')}</th>
                                <th class="span5">{lang('amt_text')}</th>
                                <th class="span2">Оценка</th>
                                <th class="span2">{lang('amt_user')}</th>
                                <th class="span2">Email пользователя</th>
                                <th class="span2">{lang('amt_page')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $comments as $item}
                                {if count($item.child) == 0}
                                    <tr data-id="{$item.id}" data-tree>
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" value="{echo $item.id}" id="nc{$item.id}" name="ids"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td>{$item.id}</td>
                                        <td>
                                            <span class="time muted">{date('d-m-Y H:i', $item.date)}</span>
                                            <span class="text_comment" id="comment_text_holder{$item.id}">{truncate(htmlspecialchars($item.text), 80, '...')}</span>
                                            <span class="frame_edit_comment ref_group" id="comment_text_editor{$item.id}">
                                                <textarea id="edited_com_text{$item.id}">{$item.text}</textarea>
                                                {if $item.module == 'shop'}
                                                    Плюсы:
                                                    <textarea id="edited_com_text_plus{$item.id}">{$item.text_plus}</textarea>
                                                    Минусы:
                                                    <textarea id="edited_com_text_minus{$item.id}">{$item.text_minus}</textarea>
                                                {/if}
                                                <span class="js ref comment_update" data-cid="{$item.id}" data-uname="{$item.user_name}" data-uemail="{$item.user_mail}" data-cstatus="{$item.status}">Сохранить</span>
                                                &nbsp;&nbsp;
                                                <span class="js ref comment_update_cancel" data-cid="{$item.id}">Отменить</span>
                                                {if $item.status == 1}
                                                    <a href="#" class="to_approved" data-id="{$item.id}">В одобренные</a>
                                                {/if}
                                                {if $item.status != 2}
                                                    <a href="#" class="to_spam" data-id="{$item.id}">В спам</a>
                                                {else:}
                                                    <a href="#" class="to_waiting" data-id="{$item.id}">В ожидающие модерации</a>
                                                {/if}
                                                <a href="#" class="ref_remove com_del" data-id="{$item.id}">Удалить</a>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="p_r frame_rating">
                                                <div class="patch_disabled"></div>
                                                <div class="star">
                                                    {for $i=0; $i<5; $i++}
                                                        <a href="#">
                                                            <i class="icon-star{if $i>=(int)$item.rate}-empty{/if}">
                                                            </i>
                                                        </a>
                                                    {/for}
                                                </div>
                                                <a href="#">
                                                    <i class="icon-thumbs-up"></i>
                                                    <span>+{$item.like}</span>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="#">
                                                    <i class="icon-thumbs-down"></i>
                                                    <span>-{$item.disslike}</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text_comment">
                                                <a href="#">{$item.user_name}</a>
                                            </span>
                                            <span class="frame_edit_comment ref_group u_ed">
                                                <input type="text" value="{$item.user_name}" name="user_name" id="u_ed{$item.id}">
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text_comment">
                                                <a href="#">{$item.user_mail}</a>
                                            </span>
                                            <span class="frame_edit_comment ref_group m_ed text_comment">
                                                <input type="text" value="{$item.user_mail}" name="user_mail" id="m_ed{$item.id}">
                                            </span>
                                        </td>
                                        <td>
                                            {if $item.module == 'core'}
                                                <a href="{$item.page_url}#comment_{$item.id}" target="_blank" title="{$item.page_title}">{truncate($item.page_title, 25, '...')}</a>
                                            {/if}
                                            {if $item.module == 'shop'}
                                                {if $this->CI->db->where('name','shop')->get('components')->num_rows() > 0}
                                                    {$p_name = encode(SProductsQuery::create()->filterById($item.item_id)->findOne()->name)}
                                                    {$p_url = encode(SProductsQuery::create()->filterById($item.item_id)->findOne()->url)}
                                                    <a href="/shop/product/{$p_url}" target="_blank">{truncate($p_name,25,'...')}</a>
                                                {/if}
                                            {/if}
                                        </td>
                                    </tr>
                                {else:}    
                                    <tr>
                                        <td colspan="7">
                                            <table>
                                                <thead>
                                                    <tr class="no_vis">
                                                        <th class="span1"></th>
                                                        <th class="span1"></th>
                                                        <th class="span5"></th>
                                                        <th class="span2"></th>
                                                        <th class="span2"></th>
                                                        <th class="span2"></th>
                                                        <th class="span2"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-id="{$item.id}" class="comments">
                                                        <td class="t-a_c">
                                                            <span class="frame_label">
                                                                <span class="niceCheck b_n">
                                                                    <input type="checkbox" value="{echo $item.id}" id="nc{$item.id}" name="ids"/>
                                                                </span>
                                                            </span>
                                                        </td>
                                                        <td>{$item.id}</td>
                                                        <td>
                                                            <span class="time muted">{date('d-m-Y H:i', $item.date)}</span>
                                                            <span class="text_comment" id="comment_text_holder{$item.id}">{truncate(htmlspecialchars($item.text), 80, '...')}</span>
                                                            <span class="frame_edit_comment ref_group" id="comment_text_editor{$item.id}">
                                                                <textarea id="edited_com_text{$item.id}">{$item.text}</textarea>
                                                                {if $item.module == 'shop'}

                                                                    Плюсы:
                                                                    <textarea id="edited_com_text_plus{$item.id}">{$item.text_plus}</textarea>

                                                                    Минусы:
                                                                    <textarea id="edited_com_text_minus{$item.id}">{$item.text_minus}</textarea>

                                                                {/if}
                                                                <span class="js ref comment_update" data-cid="{$item.id}" data-uname="{$item.user_name}" data-uemail="{$item.user_mail}" data-cstatus="{$item.status}">
                                                                    Сохранить
                                                                </span>
                                                                <span class="js ref comment_update_cancel" data-cid="{$item.id}">
                                                                    Отменить
                                                                </span>
                                                                {if $item.status == 1}
                                                                    <a href="#" class="to_approved" data-id="{$item.id}">В одобренные</a>
                                                                {/if}
                                                                {if $item.status != 2}
                                                                    <a href="#" class="to_spam" data-id="{$item.id}">В спам</a>
                                                                {else:}
                                                                    <a href="#" class="to_waiting" data-id="{$item.id}">В ожидающие модерации</a>
                                                                {/if}
                                                                <a href="#" class="ref_remove com_del" data-id="{$item.id}">Удалить</a>
                                                                </div>
                                                                </div>
                                                        </td>
                                                        <td>
                                                            <div class="p_r frame_rating">
                                                                <div class="patch_disabled"></div>
                                                                <div class="star">
                                                                    {for $i=0; $i<5; $i++}
                                                                        <a href="#">
                                                                            <i class="icon-star{if $i>=(int)$item.rate}-empty{/if}">
                                                                            </i>
                                                                        </a>
                                                                    {/for}
                                                                </div>
                                                                <a href="#">
                                                                    <i class="icon-thumbs-up"></i>
                                                                    <span>+{$item.like}</span>
                                                                </a>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <a href="#">
                                                                    <i class="icon-thumbs-down"></i>
                                                                    <span>-{$item.disslike}</span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="u_ed">{$item.user_name}</a>
                                                            <span class="frame_edit_comment ref_group u_ed">
                                                                <input type="text" value="{$item.user_name}" name="user_name" id="u_ed{$item.id}">
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="m_ed">{$item.user_mail}</a>
                                                            <span class="frame_edit_comment ref_group m_ed">
                                                                <input type="text" value="{$item.user_mail}" name="user_mail" id="m_ed{$item.id}">
                                                            </span>
                                                        </td>
                                                        <td>
                                                            {if $item.module == 'core'}
                                                                <a href="{$item.page_url}#comment_{$item.id}" target="_blank" title="{$item.page_title}">{truncate($item.page_title, 25, '...')}</a>
                                                            {/if}
                                                            {if $item.module == 'shop'}
                                                                {if $this->CI->db->where('name','shop')->get('components')->num_rows() > 0}
                                                                    {$p_name = encode(SProductsQuery::create()->filterById($item.item_id)->findOne()->name)}
                                                                    {$p_url = encode(SProductsQuery::create()->filterById($item.item_id)->findOne()->url)}
                                                                    <a href="/shop/product/{$p_url}" target="_blank">{truncate($p_name,25,'...')}</a>
                                                                {/if}
                                                            {/if}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7">
                                                            <table>
                                                                <thead>
                                                                    <tr class="no_vis">
                                                                        <th class="span1"></th>
                                                                        <th class="span1"></th>
                                                                        <th class="span5"></th>
                                                                        <th class="span2"></th>
                                                                        <th class="span2"></th>
                                                                        <th class="span2"></th>
                                                                        <th class="span2"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {foreach $item.child as $ic}
                                                                        <tr data-id={$ic.id} class="comments">
                                                                            <td class="t-a_c">
                                                                                <span class="frame_label">
                                                                                    <span class="niceCheck b_n">
                                                                                        <input type="checkbox" value="{echo $ic.id}" id="nc{$ic.id}" name="ids"/>
                                                                                    </span>
                                                                                </span>
                                                                            </td>
                                                                            <td>{$ic.id}</td>
                                                                            <td>
                                                                                <span class="simple_tree pull-left">&#8627;</span>
                                                                                <div class="o_h">
                                                                                    <span class="time muted">{date('d-m-Y H:i', $ic.date)}</span>
                                                                                    <span class="text_comment" id="comment_text_holder{$ic.id}">{truncate(htmlspecialchars($ic.text), 80, '...')}</span>
                                                                                    <span class="frame_edit_comment ref_group" id="comment_text_editor{$ic.id}">
                                                                                        <textarea id="edited_com_text{$ic.id}">{$ic.text}</textarea>
                                                                                        <span class="js ref comment_update" data-cid="{$ic.id}" data-uname="{$ic.user_name}" data-uemail="{$ic.user_mail}" data-cstatus="{$ic.status}">Сохранить</span>
                                                                                        <span class="js ref comment_update_cancel" data-cid="{$ic.id}">Отменить</span>
                                                                                    {if $ic.status == 1}<a href="#" class="to_approved" data-id="{$ic.id}">В одобренные</a>{/if}
                                                                                    {if $ic.status != 2}
                                                                                        <a href="#" class="to_spam" data-id="{$ic.id}">В спам</a>
                                                                                    {else:}
                                                                                        <a href="#" class="to_waiting" data-id="{$ic.id}">В ожидающие модерации</a>
                                                                                    {/if}
                                                                                    <a href="#" class="ref_remove com_del" data-id="{$ic.id}">Удалить</a>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="p_r frame_rating">
                                                                                <div class="patch_disabled"></div>
                                                                                <div class="star">
                                                                                    {for $i=0; $i<5; $i++}
                                                                                        <a href="#"><i class="icon-star{if $i>=(int)$item.rate}-empty{/if}"></i></a>
                                                                                        {/for}
                                                                                </div>
                                                                                <a href="#">
                                                                                    <i class="icon-thumbs-up"></i>
                                                                                    <span>+{$ic.like}</span>
                                                                                </a>
                                                                                &nbsp;&nbsp;&nbsp;
                                                                                <a href="#">
                                                                                    <i class="icon-thumbs-down"></i>
                                                                                    <span>-{$ic.disslike}</span>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <a href="#" class="u_ed">{$ic.user_name}</a>
                                                                            <span class="frame_edit_comment ref_group u_ed">
                                                                                <input type="text" value="{$ic.user_name}" name="user_name" id="u_ed{$ic.id}">
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <a href="#" class="m_ed">{$ic.user_mail}</a>
                                                                            <span class="frame_edit_comment ref_group m_ed">
                                                                                <input type="text" value="{$ic.user_mail}" name="user_mail" id="m_ed{$ic.id}">
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            {if $ic.module == 'core'}
                                                                                <a href="{$item.page_url}#comment_{$ic.id}" target="_blank" title="{$ic.page_title}">{truncate($ic.page_title, 25, '...')}</a>
                                                                            {/if}
                                                                            {if $ic.module == 'shop'}
                                                                                {if $this->CI->db->where('name','shop')->get('components')->num_rows() > 0}
                                                                                    {$p_name = encode(SProductsQuery::create()->filterById($ic.item_id)->findOne()->name)}
                                                                                    {$p_url = encode(SProductsQuery::create()->filterById($item.item_id)->findOne()->url)}
                                                                                    <a href="/shop/product/{$p_url}" target="_blank">{truncate($p_name,25,'...')}</a>
                                                                                {/if}
                                                                            {/if}
                                                                        </td>
                                                                    </tr>
                                                                {/foreach}
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    {else:}
        </br>
        <div class="alert alert-info">
            {lang('amt_nothing_found')}
        </div>
    {/if}
</div>
<div class="clearfix">
    {$paginator}
</div>
</section>