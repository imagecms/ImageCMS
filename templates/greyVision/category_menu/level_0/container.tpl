<!--    menu-row-category || menu-col-category-->
{$openLevels = getOpenLevels()}
{if $openLevels}
    {if $openLevels == 'all'}
        {$menuClass = 'menu-col-category'}
    {else:}
        {$menuClass = 'menu-row-category'}
    {/if}
{else:}
    {$menuClass = 'menu-row-category'}
{/if}
<div class="menu-main not-js {$menuClass}">
    <div class="container">
        <nav class="not-js">
            <table>
                <tbody>
                    <tr>
                        {$wrapper}
                    </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>