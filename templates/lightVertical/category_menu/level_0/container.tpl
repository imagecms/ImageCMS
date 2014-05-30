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
<div class="container">
    <div class="menu-main not-js {$menuClass}">
        <nav>
            <table>
                <tbody>
                    {$wrapper}
                </tbody>
            </table>
        </nav>
    </div>
</div>