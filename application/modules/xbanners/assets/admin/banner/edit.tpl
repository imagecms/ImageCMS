<section class="mini-layout">

    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">
                {lang('Banner editing', 'xbanners')}
            </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/xbanners" class="t-d_n m-r_15"><span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'xbanners')}</span>
                </a>
                {if $bannerImages}
                    <button onclick="" type="button" class="btn btn-small btn-success btnAddNewSlide"
                            data-form="#edit_banner_form" data-submit data-action="toedit">
                        <i class="icon-plus-sign icon-white"></i>
                        {lang('Add slide', 'xbanners')}
                    </button>
                {/if}
                <button type="button" class="btn btn-small btn-primary formSubmit"
                           data-form="#edit_banner_form" data-submit data-action="toedit"><i
                            class="icon-ok icon-white"></i>{lang('Save', 'admin')}
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/xbanners/edit_banner/" . $banner->getId())}
            </div>
        </div>
    </div>

    <div class="tabbable m-t_15"> <!-- Only required for left/right tabs -->
        <div class="myTab btn-group" data-toggle="buttons-radio">
            <a href="#banners" class="btn btn-small active">{lang('Slides', 'xbanners')}</a>
            <a href="#settings" class="btn btn-small btn-small-setting">{lang('Settings', 'xbanners')}</a>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="banners">
                <!-- Add slide form start -->
                {include_tpl('add_slide')}
                <!-- Add slide form end -->

                <!-- Banner slides list start -->
                {include_tpl('slides_list')}
                <!-- Banner slides list end -->

            </div>
            <div class="tab-pane" id="settings">
                <!-- Banner settings tpl start-->
                {include_tpl('settings')}
                <!-- Banner settings tpl end-->
            </div>
        </div>
    </div>

    <div id="elFinder"></div>



</section>