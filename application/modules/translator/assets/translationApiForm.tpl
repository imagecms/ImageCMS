<form id="trabslateForm" style="display: none; position: absolute;top: 60px;left: 100px;z-index: 100;background-color: rgba(218, 219, 223, 0.951961);padding: 20px;min-width: 350px;border-radius: 5px;border: 4px solid;border-color: rgb(138, 147, 177);">
    <div class="error_text" style="display: none">
        <div class="msg js-msg">
            <div class="error error">
                <span class="icon_info" style="margin-top: 0px; margin-left: 0px; position: relative;"></span>
                <div class="text-el">
                </div>
            </div>
        </div>
    </div>
    <label class="succ" style="display: none">
        <span class="frame-form-field">
            <div class="msg">
                <div class="success">
                </div>
            </div>
        </span>
    </label>
    <input type="hidden" id="domain" name="domain">
    <a class="hideformButton" style="float: right; margin-top: -10px;">{lang('Hide form', 'main', FALSE)}</a>
    <br>
    <label>
        <b>{lang('Origin')}:</b>
        <textarea id="origin" name="origin" readonly="readonly" class="readonly disabled" disabled="disabled" style="max-height: 40px;">
        </textarea>
    </label>
    <a id="autoTranslate" style="float: right;">{lang('Autotranslate')}</a>
    <label>
        <b>{lang('Translation')}:</b>
        <textarea id="translation" name="translation" style="max-height: 40px;">
        </textarea>
    </label>
    <label>
        <b>{lang('Comment')}:</b>
        <textarea id="comment" name="comment" style="max-height: 40px;">
        </textarea>
    </label>
    <button type="button" style="background-color: rgb(163, 170, 207);border: 1px solid rgb(48, 90, 117);border-radius: 3px;margin: 0 auto;margin-top: 10px;padding: 4px;"><b>{lang('Translate', 'main', FALSE)}</b></button>
</form>