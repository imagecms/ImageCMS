<tr>
    <td>
        <div class="p_r o_h frame_price ">
            <div class="Column">{$column}</div>
            <input type="text" name="typeEdit" class="columnEdit" style="display: none"/>
            <button data-update="count" onclick="Columns.edit($(this), '{$column}')" class="btn btn-small" type="button" style="display: none;">
                <i class="icon-refresh"></i>
            </button>
        </div>
    </td>
    <td class="span1">
        <button class="btn my_btn_s btn-small btn-danger" type="button" onclick="Columns.delete('{$column}', $(this))">
            <i class="icon-trash"></i>
        </button>
    </td>
    <td class="span1">
        <button class="btn my_btn_s btn-small btn-success" type="button">
            <i class="icon-edit"></i>
        </button>
    </td>
</tr>