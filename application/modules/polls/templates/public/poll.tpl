<div class="poll">
{if $data.userVoted}
    <!-- Пользователь уже голосовал в опросе. Выводим результаты -->
    <div style="width:100%;position:relative;">
    {foreach $data['answers'] as $answer}
        {encode($answer.text)} ({$answer.percent}%)
        <div style="width:{$answer.percent}%;background-color:silver;height:5px;"></div>
    {/foreach}
    </div>
{else:}
    <!-- Пользователь не голосовал в опросе. Выводим форму голосования -->
    <form action="" method="post">
    {foreach $data['answers'] as $answer}
        <label><input name="cms_polls_make_vote" value="{$answer.id}" type="radio">{echo encode($answer.text)}</label><br/>
    {/foreach}
    <input type="submit" value="Проголосовать">
    {form_csrf()}
    </form>
{/if}
</div>