<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_edit_menu_item')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="t-d_n m-r_15 pjax"><span class="f-s_14"></span>←<span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit submit_link" data-form="#saveForm" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit submit_link" data-form="#saveForm" data-action="tomain"><i class="icon-ok"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>  


    <div class="row">
        <div class="span5">
            <ul class="btn-group myTab m-t_10 nav-tabs horiz link_type">
                <li class="btn btn-small {if $item.item_type == 'page'} active{/if}" onClick="loadContent('/admin/components/cp/menu/view/{echo $item.id}/page','.contentAjax')"><a href="#page" >{lang('a_page')}</a></li>
                <li class="btn btn-small {if $item.item_type == 'category'}active{/if}" onClick="loadContent('/admin/components/cp/menu/view/{echo $item.id}/category','.contentAjax')"><a href="#category">{lang('a_category')}</a></li>
                <li class="btn btn-small {if $item.item_type == 'module'}active{/if}" onClick="loadContent('/admin/components/cp/menu/view/{echo $item.id}/module','.contentAjax')"><a href="#module">{lang('a_module')}</a></li>
                <li class="btn btn-small {if $item.item_type == 'url'}active{/if}" onClick="loadContent('/admin/components/cp/menu/view/{echo $item.id}/url','.contentAjax')"><a href="#url">{lang('amt_link')}</a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content content_big_td form-horizontal">
        <!--<form method="post" action="/admin/components/cp/menu/edit_item/{$item.id}" id="saveForm" >-->
        <div class="contentAjax"></div>
        <!--</form>-->

        <!--<div id="content"></div>-->
    </div>


</section>
<div id="elFinder"></div>
{literal}
    <script type="text/javascript">
       
  function loadContent(urlToload, container) {
     $.ajax({
          url: urlToload,
          cache: false,
          beforeSend: function() { $('#loading').stop().fadeIn(200);},
          success: function(html) { $(container).hide(); $(container).html(html); $(container).show(); }
      });          
          
  }
    
    </script>
{/literal}