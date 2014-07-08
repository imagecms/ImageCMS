<style>
    {literal}
        #tutorial_list{
            background-color: #f8f8f8; 
            border: 1px solid lightgray;
        }

        #tutorial_list > li{
            display: inline-block;
            padding: 15px;
            padding-left: 20px;
            border-right: 1px solid lightgray;
            padding-right: 20px;
            margin-left: -4px!important;
            margin-bottom: 0px!important;
            cursor: pointer;
        }
    {/literal}
</style>

<script>
    {literal}
        $('#tutorial_list > li').live('click', function() {
            var tabId = $(this).data('hash');
            $('.tabs > .tab').each(function(){
                $(this).hide();
            });
            $(tabId).show();
        })
    {/literal}
</script>

<ul id="tutorial_list">
    {foreach $pages as $number => $page}
        <li data-hash="#{echo $page.url}">
            <a href="#{echo $page.url}">{echo ++$number}</a>
        </li>
    {/foreach}
</ul>

<div class="tabs">
    {foreach $pages as $number => $page}
        <div id="{echo $page.url}" class="tab" data-hash="{echo $page.url}" style="{if $number}display:none;{/if}">
            {if $page.full_text}
                {echo $page.full_text}
            {else:}
                {echo $page.prev_text}
            {/if}
        </div>
    {/foreach}
</div>

<div class="pagination" align="center">
    {$pagination}
</div>
