{if $success == 1}
<div class="fancy_info text">
    <h1>Сообщение отправлено.</h1>
    <!--<h2>Ждите дзвонка</h2>-->
</div>
{else:}
<div class="products_list nopadTop" id="collback_forms">
    <h1>Запрос звонка</h1>

    <form action="#" method="post" class="new_user commentForm callback_form">
        <dl>
            <dt>Ваше Имя<span>*</span></dt>
            <dd><input type="text" name="Name" class="required" value="" /></dd>
        </dl>
        <dl>
            <dt>Телефон с кодом города<span>*</span></dt>
            <dd><input type="text" name="Phone" class="required" value="" /></dd>
        </dl>        
        <dl>
            <dt>Тема вопроса</dt>
            <dd>
                <select name="ThemeId" >
                    {foreach SCallbackThemesQuery::create()->orderByPosition()->find() as $t}
                        <option value="{echo $t->getId()}">{echo encode($t->getText())}</option>
                    {/foreach}
                </select>
            </dd>
        </dl>
        <dl>
            <dt>Удобное время звонка</dt>
            <dd>
                <select name="CalltimeId">
                    {foreach SCallbackCalltimeQuery::create()->orderByPosition()->find() as $ct}
                        <option value="{echo $ct->getId()}">{echo encode($ct->getText())}</option>
                    {/foreach}
                </select>
            </dd>
        </dl>
        <dl>
            <dt>Дополнительная информация</dt>
            <dd><textarea name="Comment" cols="40" rows="10"></textarea></dd>
        </dl>

       <div class="button"><input type="submit" value="Отправить" /></div>		
        {form_csrf()}
    </form>
</div>
{/if}
{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $('#collback_forms form').validate({
            submitHandler: function(){
                    $.fancybox.showActivity();
                    $.ajax({
                        type: "POST",
                        data: $("#collback_forms form").serialize(),
                        url: "/shop/callback/",
                        success: function(){
                            $.fancybox({
                                'href': '/shop/add_callback/1'
                            });
                        }
                    });
                    return false;
            }
        });

    });
</script>
{/literal}