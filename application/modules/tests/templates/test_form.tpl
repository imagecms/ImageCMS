

<h2>Test Form</h2>

<form action="{site_url('tests')}" method="POST" enctype="multipart/form-data">

    {echo $form->render()}


    
    <input type="submit" value="Отправить" />
    {form_csrf()}
</form>
