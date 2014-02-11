{literal}
    <style>
        #submit{
            padding: 7px;
            min-width: 80px;
            border: 1px solid silver;
            background: #e1e1e1;
        }

    </style>
{/literal}

<form method="POST" enctype="multipart/form-data" id="upload_template_form">
    {form_csrf()}   
    <input type="text" name="template_name" value="newLevelCart" style='width:200px;' />
    <br /> 
    <input id="submit" type="submit" name="submit" value="Upload" />
</form>

