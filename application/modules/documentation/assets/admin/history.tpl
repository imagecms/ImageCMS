<div class="modal hide fade" id="articles_diff">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="mvMv">{lang("Diff", 'documentation')}</h3>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <a class="btn" onclick="$('.modal').modal('hide');">{lang("Close", "documentation")}</a>
    </div>
</div>

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{$page.title}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$_SERVER['HTTP_REFERER']}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'documentation')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">

        <div class='history_row collapsed main-article active-article-status'>
            <div class="smini_left">
                Создано <br>
                {date("d.m.Y H:i",$page.created)}
                {$page.author}-ом
            </div>
            <div class='smini_left collapsed_controls showFullText' style="width: 74%;">Отобразить текст</div>
            <div style="clear:both"></div>
        </div>

        <div class="article-view main-article" style="display:none" data-page-id="{$page.id}">
            <div class="span4 left-info" style="width: 292px;">
                <table>
                    <tr>
                        <td>Категория:</td>
                        <td>{if $page.category_name == 0}Без категории{else:}$page.category_name{/if}</td>
                    </tr>
                    <tr>
                        <td>Версия:</td>
                        <td>Актуальная</td>
                    </tr>
                    <tr>
                        <td>Создано:</td>
                        <td>{date("d.m.Y H:i",$page.created)}</td>
                    </tr>
                    <tr>
                        <td>Посл. редакт.:</td>
                        <td>{date("d.m.Y H:i",$page.updated)}</td>
                    </tr>
                    <tr>
                        <td>Пользователь:</td>
                        <td>{$page.author}</td>
                    </tr>
                </table>
                <div class="history-bottom-link">
                    <a class="hideFullText">
                        Скрыть текст
                    </a>
                </div>

            </div>
            <div class="span9 article-data active-article-status" style="margin: 0px;">
                {$page.full_text}
            </div>
            <div style="clear:both"></div>
        </div>



        {if count($history) > 0}

            {foreach $history as $historyRow}

                <div class='history_row collapsed history-article-status' data-id="{$historyRow.id}">
                    <div class="smini_left">
                        <span class="historyId">{$historyRow.id}</span> Редактировано <br>
                        {date("d.m.Y H:i",$historyRow.updated)} 
                        {$historyRow.username}-ом
                    </div>
                    <div class='smini_left collapsed_controls showFullText'>Отобразить текст</div>
                    <div class='smini_left collapsed_controls compareWithOriginalCollapsed'>Сравнить с оригиналом</div>
                    <div style="clear:both"></div>
                </div>


                <div class="article-view history" data-id="{$historyRow.id}">
                    <div class="span3 left-info"  style="width: 292px;">
                        <table>
                            <tr>
                                <td>Версия:</td>
                                <td>Устаревшая</td>
                            </tr>
                            <tr>
                                <td>Посл. редакт.:</td>
                                <td>{date("d.m.Y H:i",$historyRow.updated)}</td>
                            </tr>
                            <tr>
                                <td>Пользователь:</td>
                                <td>{$historyRow.username}</td>
                            </tr>
                        </table>
                        <div class="history-bottom-link">
                            <a class="hideFullText">
                                Скрыть текст
                            </a>
                            <br />
                            <br />
                            <a class="compareWithOriginal">
                                Сравнить с оригиналом
                            </a>
                            <br />
                            <a class="articleHistoryControl" data-url='{$BASE_URL}admin/components/cp/documentation/makeRelevant/{$historyRow.page_id}/{$historyRow.id}'>
                                Сделать актуальной
                            </a>
                            <br />
                            <a class="articleHistoryControl" data-url='{$BASE_URL}admin/components/cp/documentation/deleteHistoryRow/{$historyRow.id}'>
                                Удалить
                            </a>
                        </div>
                    </div>
                    <div class="span9 article-data history-article-status"  style="margin: 0px;">
                        {$historyRow.full_text}
                    </div>
                    <div style="clear:both"></div>
                </div>
            {/foreach}
        {else:}
            <p class="no_changes">Нет изменений</p>
        {/if}

        {$paginator}

    </div>

</section>