<div class="b-sidebar__section b-sidebar__section_search-w">
    <div class="b-search-w_blog">
        <form action="{site_url('search')}" method="get" class="g-form-m">
            <div class="g-form-m__field-section g-form-m__field_icon-right g-clearfix">
                <input class="g-form-m__field-input" type="search" name="text" value="{$search_title}" placeholder="{tlang('Search')}" required>
                <button class="b-search-w_blog__submit g-form-m__field-icon fa fa-search"></button>
            </div>
            {form_csrf()}
        </form>
    </div>
</div>