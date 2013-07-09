<div class="frame-inside">
    <div class="container">
        <div class="clearfix">
            <div class="text">
                {if $page_title}
                    <h1>{$page_title}</h1>
                {/if}
                <div class="garant clearfix text m-40ti">
                    {if $system_errors}
                        {if $is_logged_in}
                            <script type="text/javascript">
                                location.href = "{site_url()}";
                            </script>
                        {/if}    
                        <div class="msg">
                            <div class="error">
                                {$system_errors}
                            </div>
                        </div>
                    {elseif $system_notice}
                        <div class="msg">
                            <div class="notice">
                                {$system_notice}
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>
