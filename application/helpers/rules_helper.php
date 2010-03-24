<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('admin_or_redirect'))
    {
        function admin_or_redirect()
        {
            $ci =& get_instance();

            if ( ! $ci->dx_auth->is_logged_in())
            {
		        redirect('admin/login', '');
                exit;
            }

            if ($ci->dx_auth->get_permission_value('cp_access'))
            {
                return TRUE;
            }
            else
            {
                redirect('admin/login', '');
                exit;
            }
        }
    }

    // Check user access to control panel page
    if (!function_exists('cp_check_perm'))
    {
        function cp_check_perm($perm)
        {
            $ci =& get_instance();

            if ($ci->dx_auth->is_logged_in())
            {
                if ($ci->dx_auth->get_permission_value($perm))
                {
                    return TRUE;
                }
                else
                {
                    $perms = get_permissions_array();

                    if (isset($perms[$perm]))
                    {
                        $err_text = 'Не достаточно прав для: <b>'.$perms[$perm].'</b>.';

                        echo '<script type="text/javascript">
                            $(\'page\').set(\'html\',\'<div id="notice" style="width: 500px;">'.$err_text.'</div>\');
                        </script>';
                    }
                    else
                    {
                        return TRUE;
                    }

                    die();
                }
            }
            else
            {
                die('Ошибка проверки прав доступа.');
            }
        }
    }

    // Check if user permission
    if (!function_exists('check_perm'))
    {
        function check_perm($perm)
        {
            $ci =& get_instance();

            if ($ci->dx_auth->is_logged_in())
            {
                if ($ci->dx_auth->get_permission_value($perm))
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
    }


    if (!function_exists('get_perms_groups'))
    {
        function get_perms_groups()
        {
            $group_names = array(
                'cp'       => 'Панель управления',
                'lang'     => 'Языки',
                'cache'    => 'Кеш',
                'page'     => 'Страницы',
                'category' => 'Категории',
                'module'   => 'Модули',
                'widget'   => 'Виджеты',
                'menu'     => 'Меню',
                'user'     => 'Пользователи',
                'roles'    => 'Группы',
                'logs'     => 'Логи',
                'backup'   => 'Резервное копирование',
            );

            ($hook = get_hook('on_get_perms_groups')) ? eval($hook) : NULL; 

            return $group_names;
        }
    }

    if (!function_exists('get_permissions_array'))
    {
        function get_permissions_array()
        {
            $all_perms = array(
                'cp_access'             => 'Доступ к панели управления',
                'cp_autoupdate'         => 'Обновление системы',
                'cp_page_search'        => 'Поиск страниц в панели управления',
                  
                'lang_create'           => 'Создание языков',
                'lang_edit'             => 'Изменение языков',
                'lang_delete'           => 'Удаление языков',
                    
                'cp_site_settings'      => 'Изменение настроек сайта',
                    
                'cache_clear'           => 'Очистка кеша',
                    
                'page_create'           => 'Создание страниц',
                'page_edit'             => 'Редактирование страниц',
                'page_delete'           => 'Удаление страниц',
                    
                'category_create'       => 'Создание категорий',
                'category_edit'         => 'Редактирование категорий',
                'category_delete'       => 'Удаление категорий',
                    
                'module_install'        => 'Установка модулей',
                'module_deinstall'      => 'Удаление модулей',
                'module_admin'          => 'Администрирование модулей',
                    
                'widget_create'         => 'Создание виджетов',
                'widget_delete'         => 'Удаление виджетов',
                'widget_access_settings'=> 'Доступ к настройкам виджетов',
                    
                'menu_create'           => 'Создание меню',
                'menu_edit'             => 'Редактирование меню',
                'menu_delete'           => 'Удаление меню',
                    
                'user_create'           => 'Создание пользователей своей группы',
                'user_create_all_roles' => 'Создание пользователей всех групп',
                'user_edit'             => 'Редактирование пользователей',
                'user_delete'           => 'Удаление пользователей',
                'user_view_data'        => 'Просмотр данных пользователей',
                                        
                'roles_create'          => 'Создание групп',
                'roles_edit'            => 'Редактирование групп',
                'roles_delete'          => 'Удаление групп',
                    
                'logs_view'             => 'Просмотр журнала событий',
                'backup_create'         => 'Создание резервных копий',
            );

            ($hook = get_hook('get_permissions_array')) ? eval($hook) : NULL; 

            return $all_perms;        
        }
    }

?>
