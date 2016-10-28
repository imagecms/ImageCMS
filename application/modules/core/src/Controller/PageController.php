<?php namespace core\src\Controller;

use CMSFactory\Events;
use core\src\Exception\PageNotFoundException;

class PageController extends Controller
{
    const PAGE_TPL_DEFAULT = 'page_full';

    public function index($id) {

        $page = $this->model->getPage($id);

        if (!$page) {
            throw new PageNotFoundException();
        }

        $this->model->checkPageAccess($page['roles']);

        $category = $this->model->getCategory($page['category']);

        Events::create()->registerEvent($page, 'Core:_displayPage')->runFactory();

        $pageTemplate = null;
        $pageLayout = null;

        if ($category) {
            $pageTemplate = $page['full_tpl'] ?: $category['page_tpl'];
            $pageLayout = $page['main_tpl'] ?: $category['main_tpl'];
        } else {
            $pageTemplate = $page['full_tpl'];
            $pageLayout = $page['main_tpl'];
        }

        $pageTemplate = $pageTemplate ?: self::PAGE_TPL_DEFAULT;

        $this->ci->template->add_array(
            [
             'page'     => $page,
             'category' => $category,
            ]
        );

        if ($this->ci->input->get()) {
            $this->ci->template->registerCanonical(site_url());
        }

        $this->ci->template->assign('content', $this->ci->template->read($pageTemplate));

        $this->ci->core->page_content = $page;
        $this->ci->core->cat_content = $category;

        $page['description'] = $this->ci->core->_makeDescription($page['description'], $page['full_text']);
        $page['keywords'] = $this->ci->core->_makeKeywords($page['keywords'], $page['full_text'] ?: $page['prev_text']);
        $this->ci->core->set_meta_tags($page['meta_title'] == NULL ? $page['title'] : $page['meta_title'], $page['keywords'], $page['description']);

        $this->model->iteratePageShowed($id);

        Events::create()->registerEvent($page, 'page:load');
        Events::runFactory();

        if (!$pageLayout) {
            $this->ci->template->show();
        } else {
            $this->ci->template->display($pageLayout);
        }
    }

}