{if $form}
    {$result = $CI->session->flashdata('result');}

    <form action="{site_url('saas/additional_services_order')}" method="post" enctype="multipart/form-data">
        {if $result}
            {if $result['errors']}
                <div class="errors">
                    {echo $result['errors']}
                </div>
            {/if}

            {if $result['success']}
                <div class="success">
                    {echo $result['success']}
                </div>
            {/if}
        {/if}

        <div class="group-checkboxes default-patch m-b_10 clearfix">
            {foreach $form->asArray() as $f}
                {if $f.info.type == 'checkbox'}
                    <div class="frame-checkbox">
                        <input type="checkbox" id="{echo $f.name}" {if $result['errors'] && $result['POST'][$f.name]}checked="checked"{/if} name="{echo $f.name}" value="{echo strip_tags($f.info.initial)}"/>
                        <label for="{echo $f.name}">
                            <span class="title">{$f.info.label},</span> 
                            <span class="price">
                                {if $f.info.type == 'checkbox'}
                                    {echo strip_tags($f.info.initial)}
                                {/if}
                            </span>
                        </label>
                    </div>
                {/if}

                {if $f.info.type == 'textarea'}
                    <textarea id="{echo $f.name}" name="{echo $f.name}" placeholder="{echo $f.info.label}&hellip;" class="m-b_15">{if $result['errors'] && $result['POST'][$f.name]}{echo $result['POST'][$f.name]}{/if}</textarea>
                {/if}
            {/foreach}
        </div>
        {$hf}
        {form_csrf()}
        <div class="footer-panel clearfix">
            <button type="submit" class="btn btn-primary f_l">
                <span class="text-el">{echo lang('Send', 'cfcm')}</span>
            </button>
            <div class="hidden-type-file f_r btn-attach-file2 btn">
                <span class="icon-attach"></span>
                <span class="text-el">{echo lang('Attach', 'cfcm')}</span>
                <input type="file" name="attachment" title="{echo lang('Choose file', 'cfcm')}"/>
            </div>
        </div>
    </form>
{else:}
    {lang('Empty page.', 'saas')}
{/if}
