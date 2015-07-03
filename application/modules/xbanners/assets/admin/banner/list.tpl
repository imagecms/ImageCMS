<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Banner managment', 'xbanners')}</span>
            </div>

            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/cp/xbanners/updateBannersPlaces" type="button" class="pjax btn btn-small btn-primary">
                        <i class="icon-ok icon-refresh"></i>{lang('Update banners', 'xbanners')}
                    </a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            {if !count($banners)}
                <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                    {lang('Empty banners list', 'xbanners')}
                </div>
            {else:}
                <form method="post" action="#" class="form-horizontal">
                    <table class="table table-striped table-bordered table-banner-managmen table-hover table-condensed content_small_td t-l_a">
                        <thead>
                        <tr>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Visualization', 'xbanners')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Banner position', 'xbanners')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Output page', 'xbanners')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Size', 'xbanners')}</th>
                            <th style="font-size: 12px;color: #3f5a6a;">{lang('Banners count', 'xbanners')}</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach $banners as $banner}
                            <tr {if count($banner->getBannerImages()) != 0}class="has-slides"{/if}>
                                <td style="text-align: center">
                                    <i class="fa fa-eye" class="dropdown-toggle" data-toggle="dropdown"></i>

                                    <div class="dropdown-menu theme-tooltip">
                                        <div class="inside-padd">
                                            <img src="{echo $banner->getPreviewSrc()}"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <a href="/admin/components/init_window/xbanners/edit_banner/{echo $banner->getId()}"
                                       data-rel="tooltip"
                                       data-title="{lang("Editing", 'xbanners')}">
                                        {echo $banner->getName()}
                                    </a>
                                </td>

                                <td>
                                    {echo $pageTypes[$banner->getPageType()]['name']}
                                </td>

                                <td>
                                    {echo $banner->getWidth()}x{echo $banner->getHeight()} {lang('px', 'xbanners')}
                                </td>

                                <td>
                                    {echo count($banner->getBannerImages())}
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </form>
            {/if}
        </div>
    </section>
</div>