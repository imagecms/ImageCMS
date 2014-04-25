<tr>
    <td>
        <div class="variable">
            {echo $variable}
        </div>
        <input type="text" name="variableEdit" class="variableEdit" style="display: none"/>
    </td>
    <td>
        <div class="variableValue">
            {echo $variable_value}
        </div>
        <input type="text" name="variableValueEdit" class="variableValueEdit" style="display: none"/>
    </td>
    <td style="width: 100px">
        <button class="btn my_btn_s btn-small btn-success editVariable" type="button">
            <i class="icon-edit"></i>
        </button>
        <button data-update="count" onclick="EmailTemplateVariables.update($(this), '{echo $template_id}', '{echo $variable}', '{echo $locale}')" class="btn btn-small refreshVariable" type="button" style="display: none;">
            <i class="icon-refresh"></i>
        </button>
    </td>
    <td class="span1">
        <button class="btn my_btn_s btn-small btn-danger " type="button" onclick="EmailTemplateVariables.delete('{echo $template_id}', '{echo $variable}', $(this), '{echo $locale}')">
            <i class="icon-trash"></i>
        </button>
    </td>
</tr>