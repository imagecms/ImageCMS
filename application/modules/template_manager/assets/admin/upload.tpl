{literal}
    <style>
        #upload_template_form table tr td {
            padding: 8px;

        }

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
        <table>
            <tr>
                <td>Enter URL</td>
                <td><input type="text" name="template_url" value="http://localhost/newLevelCart.zip" /></td>
            </tr>
            <tr>
                <td colspan='2' style="text-align: center; color: #622">OR</td>
            </tr>
            <tr>
                <td>Select file</td>
                <td><input type="file" name="template_file" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input id="submit" type="submit" name="submit" value="Upload" /></td>
            </tr>
        </table>
    </form>



