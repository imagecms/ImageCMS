<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{$title}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button class="btn btn-danger btn-small pjax"
                        onclick="$.post('{$BASE_URL}admin/components/init_window/exchange/clear/{$type}');
                                window.location.href = window.location.href;">
                    {lang('Clear log', 'exchange')}
                </button>
                <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                    {lang('Logs', 'exchange')}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="{$SELF_URL}/log/error">{lang('Errors log', 'exchange')}</a>
                    </li>
                    <li>
                        <a href="{$SELF_URL}/log/log">{lang('Query log', 'exchange')}</a>
                    </li>
                    <li>
                        <a href="{$SELF_URL}/log/time">{lang('Time log', 'exchange')}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/init_window/exchange"
                   class="t-d_n m-r_15">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'admin')}</span>
                </a>
            </div>
        </div>
    </div>
    {echo $text}

    {if $text}
        {echo $text}
    {else:}
        <div class="alert alert-info">
            <p>{lang('Empty list','admin')}</p>
        </div>
    {/if}


</section>