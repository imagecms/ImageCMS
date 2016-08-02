<div class="content__header">
  <h1 class="content__title">
      {tlang('Request a Call back')}
  </h1>
</div>
<div class="content__cell content__cell--sm">
  <div class="typo">{tlang('Leave a number and we will call you back')}</div>
</div>
<div class="content__cell">
  <div class="row">
    <div class="col-sm-7">
      <form class="form" action="{site_url('callbacks')}" method="post" novalidate>

        {if $success}
          <div class="form__messages">
            <div class="message message--success">{$success}</div>
          </div>
        {/if}

        <!-- User Name field -->
        {view('includes/forms/input-base.tpl', [
          'label' => tlang('Name'),
          'type' => 'text',
          'name' => 'Name',
          'value' => get_value('Name'),
          'required' => true
        ])}

        <!-- User Phone field -->
        {view('includes/forms/input-base.tpl', [
          'label' => tlang('Phone number'),
          'type' => 'text',
          'name' => 'Phone',
          'value' => get_value('Phone'),
          'required' => true
        ])}

        <!-- Message -->
        {view('includes/forms/textarea-base.tpl', [
          'label' => tlang('Message'),
          'name' => 'Comment',
          'value' => get_value('Comment'),
          'rows' => 15,
          'required' => false
        ])}

        <!-- Submit button -->
        <div class="form__field">
          <div class="form__label"></div>
          <div class="form__inner">
            <input class="btn btn-primary" type="submit" value="{tlang('Call back')}">
          </div>
        </div>
      
      {form_csrf()}
      </form>
    </div>
    <div class="col-sm-5"></div>
  </div>
</div>