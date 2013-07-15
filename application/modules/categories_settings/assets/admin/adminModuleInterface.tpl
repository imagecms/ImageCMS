<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
                Дополнительные настройки:
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    <div class="row-fluid">
                        <div class="span3">
                            <div class="control-group">
                                <label class="control-label" for="iddCategory">Колонка:</label>
                                <div class="controls number">
                                    <form  type="post">
                                        <input id="cattegoryColumnMod" name="column" type="text" value="{echo $data['column']}" maxlength="1">
                                        <input id="cattegoryIdMod" type="hidden"  name="categoryId" value="{echo $data['categoryId']}" >
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" class="btn btn-small btn-primary btn-success" id="cattegoryColumnSaveButtonMod"><i class="icon-ok icon-white"></i>Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>