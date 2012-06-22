{# Show brand products list #}

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

    <div id="titleExt">
        <h5 class="left">Запросить обратный звонок</h5>
        <div class="right"></div>
        <div class="sp"></div>
    </div>

    {if $errors}
        <div class="errors">
            {$errors}
        </div>
    {/if}

    <form action="" method="post" class="form commentForm">
        <p class="clear">
            <label for="name" style="width:140px;" class="left">Ваше Имя</label>
            <input type="text" name="Name"  value=""/> <span style="color:red;">*</span>
        </p>

        <p class="clear">
            <label for="phone" style="width:140px;" class="left">Телефон с кодом города</label>
            <input type="text" name="Phone"  value=""/> <span style="color:red;">*</span>
        </p>

       <p class="clear">
            <label for="theme_id" style="width:140px;" class="left">Тема вопроса</label>
            <select name="ThemeId">
                {foreach SCallbackThemesQuery::create()->orderByPosition()->find() as $t}
                    <option value="{echo $t->getId()}">{echo encode($t->getText())}</option>
                {/foreach}
            </select>
            <span style="color:red;">*</span>
        </p>

        <p class="clear">
            <label for="comment" style="width:140px;" class="left">Дополнительная информация</label>
            <textarea name="Comment" cols="40" rows="10"></textarea>
        </p>

        <p class="clear">
            <label class="left" style="width:140px;" >&nbsp;</label>
            <input type="submit" value="Оставить запрос"/>
        </p>

        {form_csrf()}
    </form>
</div>
