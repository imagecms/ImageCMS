/* CMS Windows */

    initializeWindows = function(){

        //add new page
        MochaUI.add_pageWindow = function(){

            ajax_div('page',base_url + 'admin/pages/');

        }
        if ($('add_page_link')){
            $('add_page_link').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.add_pageWindow();
            });
        }


        //search page window
        MochaUI.search_p_Window = function(){
            new MochaUI.Window({
                id: 'search_page_w',
                title: 'Поиск страниц',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/search',
                width: 490,
                height: 300
            });
        }
        if ($('search_page_link')){
            $('search_page_link').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.search_p_Window();
            });
        }

        //languages page window
        MochaUI.languages_h_p_Window = function(){
            new MochaUI.Window({
                id: 'languages_page_w',
                title: 'Языки',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/languages',
                width: 490,
                height: 230
            });
        }
        if ($('languages_link')){
            $('languages_link').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.languages_h_p_Window();
            });
        }

        //add language page window
        MochaUI.languages_create_lang_w = function(){
            new MochaUI.Window({
                id: 'languages_create_lang_w',
                title: 'Языки - Создать',
                type: 'modal',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/languages/create_form',
                width: 440,
                height: 280
            });
        }

        // main settings window
        MochaUI.settingsWindow = function(){
            new MochaUI.Window({
                id: 'settings_page',
                title: 'Конфигурация Сайта',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/settings',
                width: 490,
                height: 520
            });
        }
        if ($('settings_link')){
            $('settings_link').addEvent('click', function(e){
                //new Event(e).stop();
                //MochaUI.settingsWindow();
                ajax_div('page', base_url + 'admin/settings');
            });
        }

        // main page settings window
        MochaUI.settingsWindowMainPage = function(){
            new MochaUI.Window({
                id: 'settings_page_main',
                title: 'Настройка Главной Страницы',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/settings/main_page',
                width: 410,
                height: 160
            });
        }
        if ($('main_page_link')){
            $('main_page_link').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.settingsWindowMainPage();
            });
        }

        //Create new category window
        MochaUI.create_new_catWindow = function(){
            new MochaUI.Window({
                id: 'create_new_cat',
                title: 'Создать категорию',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/categories/create_form',
                evalResponse: true,
                onClose: function(){ },
                width: 490,
                height: 470
            });
        }
        if ($('create_cat_link')){
            $('create_cat_link').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.create_new_catWindow();
            });
        }

        //User roles window
        MochaUI.userGroupsWindow = function(){
            new MochaUI.Window({
                id: 'user_group_window',
                title: 'Список Групп',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/groups/',
                evalResponse: true,
                width: 490,
                height: 460
            });
        }
        if ($('groups_list_link')){
            $('groups_list_link').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.userGroupsWindow();
            });
        }


    /////////////////////////////////////////////////////////////////////
        // View
        if ($('sidebarLinkCheck')){
            $('sidebarLinkCheck').addEvent('click', function(e){
                new Event(e).stop();
                MochaUI.Desktop.sidebarToggle();
            });
        }

        $$('a.returnFalse').each(function(el){
            el.addEvent('click', function(e){
                new Event(e).stop();
            });
        });

    }

        //edit category window
        function edit_category(cat_id){
            ajax_div('page', base_url + 'admin/categories/edit/' + cat_id);
        }

        //edit lang window
        function edit_lang(lang_id){
            new MochaUI.Window({
                id: 'edit_language_w',
                title: 'Редактировать Язык',
                type: 'modal',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/languages/edit/' + lang_id,
                width: 440,
                height: 280
            });
        }


    window.addEvent('domready', function(){
        MochaUI.Desktop = new MochaUI.Desktop();
        MochaUI.Dock = new MochaUI.Dock();
        MochaUI.Modal = new MochaUI.Modal();
        
        MochaUI.Desktop.desktop.setStyles({
            'background': '#fff',
            'visibility': 'visible'
        });

        initializeWindows();
    });

 
    function show_fast_add_cat(){
        new MochaUI.Window({
            id: 'fast_add_cat_w',
            title: 'Создать категорию',
            type: 'modal',
            loadMethod: 'xhr',
            contentURL: base_url + 'admin/categories/fast_add',
            width: 540,
            height: 180
        });
    }

    ///////////////////////////////////////////////
    //Widgets manager windows
    ///////////////////////////////////////////////
    function widget_create(){
        new MochaUI.Window({
            id: 'widget_create_w',
            title: 'Создать виджет',
            loadMethod: 'xhr',
            contentURL: base_url + 'admin/widgets/create_tpl',
            width: 440,
            height: 280
        });
    }
