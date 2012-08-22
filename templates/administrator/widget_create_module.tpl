{foreach $widgets as $item}
<div class="widget_block">
    <div class="widget_header"><b>{$item.module_name} </b></div>

    <div class="info_container">
    {foreach $item.widgets as $widget }
        <div class="widget_info" onclick="select_widget('{$item.module}','{$widget.method}','{$widget.title}');">
            <a>{$widget.title}</a>
            <p>{$widget.description}</p>
        </div>
    {/foreach}
    </div>

</div>
{/foreach}


{literal}
    <script type="text/javascript">
        var selected_module = '';
        var selected_method = '';
    </script>

    <style type="text/css">
        .widget_block {
            width:300px;
            border:2px solid #A2C449;
            margin:5px;
            float:left;
        }

        .widget_header {
            background-color:#E4F5A9;
            padding:5px;
            padding-left:11px;
        }

        .widget_info {
            padding-left:10px;
            border-bottom:1px solid silver;
        }

        .widget_info:hover { 
            background-color: #D1E2EB;
            cursor:pointer; 
        }

        .info_container {
         /*   height:200px;
            overflow:auto;
        */
        }
    </style>
{/literal}
