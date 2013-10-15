{$top_menu = array(
    'begin-work' => 'Начало работы',
    'manage' => 'Администрир.',
    'step-by-step' => 'Пошаговые инструкции',
    'developers' => 'Разработчикам',
    'templates' => 'Работа с шаблонами',
)}

<ul class="nav navbar-nav top_menu_documentation">
    {foreach $top_menu as $key => $value}
        <li {if $_COOKIE['category_menu'] == $key}class="active"{/if}>
            <a href="#" data-category_menu="{$key}">{$value}</a>
        </li>
    {/foreach}

</ul>