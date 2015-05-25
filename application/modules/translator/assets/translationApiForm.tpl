{literal}
    <style type="text/css">
        #trabslateForm > button:hover{
            background: linear-gradient(to bottom, rgba(224, 224, 224, 0.53) 0%,rgba(219, 214, 214, 0.51) 100%)!important;

        }
        #trabslateForm > button{
            margin: 0 auto;
            margin-top: 10px;
            padding: 4px;
            color: #333;
            background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(231,231,231,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e7e7e7',GradientType=0 );
            background-repeat: repeat-x;
            border: 1px solid #ccc;
            border-radius: 2px;
            width: 100px;
        }

        #trabslateForm{
            position: absolute;
            top: 176px;
            left: 305px;
            z-index: 10000;
            padding: 20px;
            min-width: 350px;
            cursor: move;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            border: 2px solid rgb(223, 223, 223);
            background-color: rgb(255, 255, 255);
            -webkit-box-shadow: 0px 0px 30px 0px rgba(48, 50, 50, 0.75);
            -moz-box-shadow:    0px 0px 30px 0px rgba(48, 50, 50, 0.75);
            box-shadow:         0px 0px 30px 0px rgba(48, 50, 50, 0.75);
        }

        #trabslateForm > div.hideformButton{
            position: absolute;
            top: 0px;
            right: 0px;
            width: 6%;
            height: 6%;
            text-align: center;
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
            background-color: #da4f49;
            background-image: -webkit-gradient(linear,0 0,0 100%,from(#ee5f5b),to(#bd362f));
            background-image: -webkit-linear-gradient(top,#ee5f5b,#bd362f);
            background-image: -o-linear-gradient(top,#ee5f5b,#bd362f);
            background-image: linear-gradient(to bottom,#ee5f5b,#bd362f);
            background-image: -moz-linear-gradient(top,#ee5f5b,#bd362f);
            background-repeat: repeat-x;
            border-color: #bd362f #bd362f #802420;
            border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
            cursor: pointer;
            border-radius: 2px;
            -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
            -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
        }

        #trabslateForm > div.hideformButton:hover{
            transition: background-position .1s linear;
            background-position: 0 -15px;
            background-color: #bd362f;
        }

        #trabslateForm textarea{
            margin-bottom: 20px;
        }

        #trabslateForm > div.hideformButtonHolder{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to bottom, rgba(239, 225, 225, 0.53) 0%,rgba(211, 189, 189, 0.51) 100%)!important;

        }

        #trabslateForm div.success{
            display: inline-block;
            border: 1px solid #0eb759;
            color: #635959;
            background: #C2FFDD;
            padding: 5px 20px;
            margin-bottom: 10px;
            margin-top: 10px;
            width: 87%;
        }

        #trabslateForm div.error{
            background-color: #ffefe8;
            border: 1px solid #e89b88;
            padding: 7px 13px 10px;
            display: block;
            margin-top: 10px;
            width: 87%;
        }

        #trabslateForm div.success > p, #trabslateForm div.error p{
            margin: 0;
        }       

    </style> 
{/literal}
<form id="trabslateForm" style="display: none;">
    <div class="error_text" style="display: none">
        <div class="msg js-msg">
            <div class="error">
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
    <!--div class="hideformButtonHolder"></div-->
    <div class="hideformButton">X</div>
<!--a class="hideformButton" style="float: right; margin-top: -10px;">{lang('Hide form', 'translator')}</a-->
    <br>
    <label>
        <b>{lang('Origin', 'translator')}:</b>
        <textarea id="origin" name="origin" readonly="readonly" class="readonly disabled" disabled="disabled" style="max-height: 40px;">
        </textarea>
    </label>
    <a id="autoTranslate" style="float: right;">{lang('Autotranslate', 'translator')}</a>
    <label>
        <b>{lang('Translation', 'translator')}:</b>
        <textarea id="translation" name="translation" style="max-height: 40px;">
        </textarea>
    </label>
    <label>
        <b>{lang('Comment', 'translator')}:</b>
        <textarea id="comment" name="comment" style="max-height: 40px;">
        </textarea>
    </label>
    <button type="button" ><b>{lang('Translate', 'translator')}</b></button>
</form>