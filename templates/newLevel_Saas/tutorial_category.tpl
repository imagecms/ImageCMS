<div class="panel-form">
    {if !$pages}
        <h3>
            <center>
                {lang('Нет страниц', 'template')}
            </center>
        </h3>
    {else:}
        <ul class="tabs tabs-tour" data-rel="tabs">
            {foreach $pages as $number => $page}
                <li>
                    <a href="#t{echo ++$number}">
                        <span class="text-el">{echo $number}</span>
                    </a>
                </li>
            {/foreach}
        </ul>
        <div class="frame-tabs-ref frame-tabs-ref-tour">
            {foreach $pages as $number => $page}
                <div id="t{echo ++$number}">
                    <div class="inside-padd text">
                        {if $page.full_text}
                            {echo $page.full_text}
                        {else:}
                            {echo $page.prev_text}
                        {/if}
                    </div>
                </div>
            {/foreach}
        </div>
    {/if} 

</div>