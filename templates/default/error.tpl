<div class="message warning">
      <p>
        {$error_text}
      </p>
</div>

{if $back_button == TRUE}
    <a href="javascript: history.go(-1);">{lang('history_back')}</a>   
{/if}
