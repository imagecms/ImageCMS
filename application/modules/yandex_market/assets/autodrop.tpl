{if count($entity) >0}
    {literal}
        <style type=text/css>
            .finder {position: absolute; z-index: 500; height: 180px; overflow: auto}
            ul.auto_entity {background: white; list-style: none; border: 1px dotted black; margin: 0 }
            ul.auto_entity li {cursor: pointer; padding: 5px; }
            ul.auto_entity li:hover{background: #C0C0C0}
        </style>
    {/literal}

    <div class="finder">
        <ul class="auto_entity">
            <li onclick="selectEntity(this)" data-id="0">all</li>
                {foreach $entity as $e}
                <li onclick="selectEntity(this)" data-id="{echo (int)$e['Id']}">{echo $e['Name']}</li>
                {/foreach}
        </ul>
    </div>
{/if}


