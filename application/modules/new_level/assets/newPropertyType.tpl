<tr>
    <td>
        <div class="p_r o_h frame_price ">
            <div class="propertyType">{$type}</div>
            <input type="text" name="typeEdit" class="typeEdit" style="display: none"/>
            <button data-update="count" onclick="PropertiesTypes.edit($(this), '{$type}')" class="btn btn-small" type="button" style="display: none;">
                <i class="icon-refresh"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn my_btn_s btn-small btn-danger" type="button" onclick="PropertiesTypes.delete('{$type}', $(this))">
            <i class="icon-trash"></i>
        </button>
    </td>
    <td>
        <button class="btn my_btn_s btn-small btn-success" type="button">
            <i class="icon-edit"></i>
        </button>
    </td>
</tr>