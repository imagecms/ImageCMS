<style>
    {literal}
        .item:nth-child(odd){
            float: left;
            clear: both;
        }
        .item:nth-child(even){
            float: right;
        }
        div.items{
            width: 80%;
            margin-top: 28px;
            padding-right: 120px;
            padding-left: 20px;
            height: 340px;
            background-color: #f8f8f8;
        }
        div.item.textarea{
            clear: both;
            top: 40px;
            position: relative;
            width: 100%;
        }
        div.item.textarea  textarea{
            width: 100%;
            margin-top: 10px;
            min-height: 100px;
            border-color: gray;
        }

        input[type="submit"]{
            float: left;
            clear: both;
            margin-top: 20px;
        }

        input[type="file"]{
            float: left;
            margin-top: 60px;
        }

        form > div.errors, form > div.success{
            padding-left: 20px;
            padding-top: 1px;
        }

        form > div.success{
            color: green;
            padding-top: 10px;
        }
    {/literal}
</style>
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

    <div class="items">

        {foreach $form->asArray() as $f}
            <div class="item {echo $f.info.type}">
                {$f.label}
                <div>

                {$f.field} {if $f.info.type == 'checkbox'} {echo strip_tags($f.info.initial)}{/if}

                {$f.help_text}
            </div>
        </div>

    {/foreach}
    {$hf}
    {form_csrf()}
    <input type="file" name="attachment">
    <input type="submit" value="{echo lang('Отправить', 'saas')}">
</div>
</form>


