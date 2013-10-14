<!DOCTYPE html>
<html>
    <head>
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="generator" content="ImageCMS" />
        <link href="{$THEME}css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link href="{$THEME}css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
        <link href="{$THEME}css/style.css" rel="stylesheet" media="screen"/>
        <link href="{$THEME}css/offcanvas.css" rel="stylesheet" media="screen"/>

        <!--[if lt IE 9]>
            <script src="{$THEME}js/html5shiv.js"></script>
            <script src="{$THEME}js/respond.min.js"></script>
        <![endif]-->
        <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
        <link rel="SHORTCUT ICON" href="favicon.ico" />

        <link media="screen" rel="stylesheet" href="{$THEME}js/highlight/styles/googlecode.css"/>
        <script type="text/javascript" src="{$THEME}js/highlight/highlight.pack.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.min.js"></script>

        {literal}
            <script>hljs.initHighlightingOnLoad();</script>
        {/literal}

        <script type="text/javascript" src="{$THEME}js/tinymce/tinymce.js"></script>

        <script type="text/javascript">
            var id = "{echo $CI->core->core_data['id']}";
        </script>

        <link href="{$THEME}css/left_menu_style.css" rel="stylesheet" media="screen"/>
    </head>
    <body>

        <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="pull-left visible-xs navbar-toggle" data-toggle="offcanvas">
                        <span class="glyphicon glyphicon-chevron-left white"></span>
                        <span class="glyphicon glyphicon-th-list white"></span>
                    </button>

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="/">
                        {lang('ImageCMS Documentation','documentation')}
                    </a>
                </div>

                <div class="collapse navbar-collapse">
                    {load_menu('top_menu')}
                    {if $CI->dx_auth->is_logged_in()}
                        <div class="pull-right">
                            {$CI->load->module('documentation')}
                            {if $CI->documentation->hasCRUDAccess()}
                                <a href="/documentation/create_new_page" type="button" class="btn btn-success navbar-btn ">
                                    <span class="glyphicon glyphicon-new-window"></span>
                                    {lang('Create page','documentation')}
                                </a>
                                {if $CI->core->core_data['data_type'] == 'page'}
                                    <a href="/documentation/edit_page/{echo $CI->core->core_data['id']}" type="button" class="btn btn-success navbar-btn ">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                        {lang('Edit','documentation')}
                                    </a>
                                {/if}
                            {/if}
                        </div>
                    {/if}
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </div>
        <div class="container">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    {if $CI->core->core_data['data_type'] == 'main'}
                        <span id="main_logo" class="logo f_l">
                            <img src="{$THEME}images/logo.png"/>
                        </span>
                    {else:}
                        <a id="main_logo" href="{site_url()}" class="logo f_l">
                            <img src="{$THEME}images/logo.png"/>
                        </a>
                    {/if}
                    <div class="tree_menu">
                        {$CI->load->module('documentation')->load_category_menu('dev')}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-9">
                    <!--div class="jumbotron">
                        <h1>Hello, world!</h1>
                        <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
                    </div-->
                    {if $CI->core->core_data['data_type'] != '404'}
                        <div class="row">
                            <form class="form-group form-inline pull-right" action="{site_url('search')}" method="POST">
                                <div class="form-group">
                                    <input type="text"class="form-control" name="text" placeholder="{lang("Search","documentation")}" />
                                </div>
                                <div class="form-group">
                                    <input class="btn" type="submit" value="{lang("Search","documentation")}"/>
                                </div>
                                {form_csrf()}
                            </form>
                        </div>
                    {/if}
                    <div class="row">
                        {$content}
                    </div>
                </div>
            </div>
            <footer>
                <div class="navbar-inner" style="margin: 8px;">
                    <div class="container">
                        <hr/>
                        © Company 2013
                        {if !$CI->dx_auth->is_logged_in()}
                            <div class="pull-right">
                                <a href="/auth/login" class="navbar-btn">
                                    <span class="glyphicon glyphicon-log-in "></span>
                                    {lang('Log in','documentation')}
                                </a>&nbsp;
                                <a href="/auth/register" class="navbar-btn">
                                    <span class="glyphicon glyphicon-log-in "></span>
                                    {lang('Registration','documentation')}
                                </a>
                            </div>
                        {else:}
                            <div class="pull-right">
                                <a href="/auth/logout" type="button">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    {lang('Exit','documentation')}
                                </a>
                            </div>
                        {/if}
                    </div>
                </div>
            </footer>
        </div>

        <script type="text/javascript" src="{$THEME}js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/offcanvas.js"></script>
    </body>
</html>