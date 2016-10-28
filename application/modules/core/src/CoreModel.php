<?php namespace core\src;

use CI;
use CI_DB_active_record;
use core\models\Base\RouteQuery;
use core\models\Route;
use Doctrine\Common\Cache\Cache;

class CoreModel
{

    const CACHE_LANG = 'main_site_langs';

    /**
     * @var CI_DB_active_record
     */
    private $db;

    /**
     * @var CI
     */
    private $ci;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var array
     */
    private $languages;

    /**
     * @var array
     */
    private $defaultLanguage;

    /**
     * FrontModel constructor.
     * @param CI $ci
     * @param Cache $cache
     */
    public function __construct(CI $ci, Cache $cache) {
        $this->ci = $ci;
        $this->db = $ci->db;
        $this->cache = $cache;
    }

    public function getPage($id) {

        // Select page permissions and page data
        $this->db->select('content.*');
        $this->db->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as full_url", false);
        $this->db->select('content_permissions.data as roles', FALSE);

        if (CoreFactory::getConfiguration()->isDefaultLanguage()) {
            $this->db->where('content.id', $id);
        } else {
            $this->db->where('content.lang_alias', $id);
        }

        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        $this->db->where('lang', config_item('cur_lang'));
        $this->db->join('content_permissions', 'content_permissions.page_id = content.id', 'left');
        $this->db->join('route', 'route.id = content.route_id');

        $query = $this->db->get('content', 1);

        if ($query->num_rows() > 0) {
            $page = $query->row_array();
            $page['roles'] = unserialize($page['roles']);
            $page['full_text'] = $page['full_text'] ?: $page['prev_text'];
            $page = $this->ci->cfcm->connect_fields($page, 'page');

            return $page;
        }
    }

    public function iteratePageShowed($id) {
        $this->db->set('showed', 'showed + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->update('content');
    }

    public function getCategory($id) {

        $defaultLanguage = $this->getDefaultLanguage();
        $this->db->select('category.*');
        if ($defaultLanguage['id'] != config_item('cur_lang')) {

            $this->db->select(
                'category_translate.name, category_translate.title, category_translate.short_desc,
category_translate.image, category_translate.keywords, category_translate.description, category_translate.lang'
            );
            $this->db->join('category_translate', 'category.id = category_translate.alias')
                ->where('category_translate.lang', config_item('cur_lang'));
        }
        $this->db->where('category.id', $id);

        $query = $this->db->get('category');

        if ($query->num_rows() > 0) {
            $category = $query->row_array();
            $category['fetch_pages'] = unserialize($category['fetch_pages']);
            $route = $this->getRoute($category['id'], Route::TYPE_CATEGORY);
            $category['path'] = $this->getRoutePath($route);
            $category['path_url'] = $route->getFullUrl();
            return $category;
        }
    }

    public function getRoutePath(Route $route) {
        $routes = $route->getPathRoutes();

        $path = [];
        foreach ($routes as $route) {
            $path[$route->getEntityId()] = $route->getUrl();
        }

        return $path;

    }

    public function getCategoryPages(array $category, $row_count = 0, $offset = 0) {

        $query = $this->createCategoryPagesQuery($category);

        $query->select('content .*');
        $query->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as full_url", false);
        $query->join('route', 'route.id = content.route_id');

        $query->order_by($category['order_by'], $category['sort_order']);
        $query = $row_count > 0 ? $query->get('content', (int) $row_count, (int) $offset) : $query->get('content');

        if ($query->num_rows() > 0) {
            $pages = $query->result_array();
            foreach ($pages as $key => $page) {
                $pages[$key] = $this->ci->cfcm->connect_fields($page, 'page');
            }

            return $pages;
        }
    }

    public function countCategoryPages($category) {

        $query = $this->createCategoryPagesQuery($category);
        $query->from('content');

        return $query->count_all_results();

    }

    public function getRoute($id, $type) {
        $route = RouteQuery::create()->filterByEntityId($id)
            ->filterByType($type)
            ->findOne();

        return $route;
    }

    private function createCategoryPagesQuery($category) {

        $query = $this->db->where('post_status', 'publish')
            ->where('publish_date <= ', time())
            ->where('lang', config_item('cur_lang'));

        if (count($category['fetch_pages']) > 0) {
            $category['fetch_pages'][] = $category['id'];
            $query->where_in('category', $category['fetch_pages']);
        } else {
            $query->where('category', $category['id']);
        }

        return $query;
    }

    public function getDefaultLanguage() {

        if ($this->defaultLanguage === null) {
            foreach ($this->getLanguages() as $language) {
                if ($language['default'] == 1) {
                    $this->defaultLanguage = $language;
                }
            }
        }
        return $this->defaultLanguage;
    }

    public function getLanguages() {

        if ($this->languages === null) {
            if ($this->cache->contains(self::CACHE_LANG)) {
                $this->languages = $this->cache->fetch(self::CACHE_LANG);
            } else {
                $languages = $this->ci->cms_base->get_langs(TRUE);

                foreach ($languages as $language) {

                    $language['name'] = $language['lang_name'];
                    unset($language['lang_name']);
                    $this->languages[$language['identif']] = $language;

                }
                $this->cache->save(self::CACHE_LANG, $this->languages);

            }

        }

        return $this->languages;

    }

    /**
     * Check user access for page
     * @param array $roles
     * @return bool
     */
    public function checkPageAccess($roles) {

        if ($roles == FALSE OR count($roles) == 0) {
            return TRUE;
        }

        $access = FALSE;
        $logged = $this->ci->dx_auth->is_logged_in();
        $my_role = $this->ci->dx_auth->get_role_id();

        if ($this->ci->dx_auth->is_admin() === TRUE) {
            $access = TRUE;
        }

        // Check roles access
        if ($access != TRUE) {
            foreach ($roles as $role) {
                if ($role['role_id'] == $my_role) {
                    $access = TRUE;
                }

                if ($role['role_id'] == 1 AND $logged == TRUE) {
                    $access = TRUE;
                }

                if ($role['role_id'] == '0') {
                    $access = TRUE;
                }
            }
        }

        if ($access == FALSE) {
            $this->ci->dx_auth->deny_access('deny');
            exit;
        }
    }

}