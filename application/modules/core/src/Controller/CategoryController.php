<?php namespace core\src\Controller;

use CMSFactory\Events;
use core\src\CoreFactory;
use core\src\Exception\PageNotFoundException;

class CategoryController extends Controller
{

    public function index($id) {
        $category = $this->model->getCategory($id);

        if (!$category) {
            throw new PageNotFoundException();
        }

        /** Register event 'Core:_displayCategory' */
        Events::create()->registerEvent($category, 'Core:_displayCategory')->runFactory();

        $paginationPage = $this->ci->input->get('per_page');
        if ($paginationPage) {
            $offset = $paginationPage;
            $segment = $this->ci->uri->total_segments();
        } else {
            $offset = 0;
            $segment = $this->ci->uri->total_segments() + 1;
        }

        $row_count = $category['per_page'];
        $pages = $this->model->getCategoryPages($category, $row_count, $offset);

        if (!$pages && $offset > 0) {
            throw new PageNotFoundException();
        }

        $category['total_pages'] = $this->model->countCategoryPages($category);

        if ($category['total_pages'] > $category['per_page']) {
            $this->ci->load->library('Pagination');

            $get = $this->ci->input->get();
            if (isset($get['per_page'])) {
                unset($get['per_page']);
            }
            $get = http_build_query($get);

            $get = $get ? '?' . $get : '';

            $categoryUrl = '/' . CoreFactory::getUrlParser()->getFullUrl(true, true, false) . $get;
            $paginationConfig['base_url'] = $categoryUrl;
            $paginationConfig['first_url'] = $categoryUrl;
            $paginationConfig['first_link'] = '1';
            $paginationConfig['num_links'] = 3;
            $paginationConfig['total_rows'] = $category['total_pages'];
            $paginationConfig['per_page'] = $category['per_page'];
            $paginationConfig['uri_segment'] = $segment;
            $paginationConfig['page_query_string'] = false;

            include_once './templates/' . config_item('template') . '/paginations.php';

            $pagination = $this->ci->pagination;

            $pagination->initialize($paginationConfig);
            $this->ci->template->assign('pagination', $pagination->create_links());
        }
        // End pagination

        $template = $this->ci->template;
        $template->assign('category', $category);

        $countPages = count($pages);

        if ($category['tpl'] == '') {
            $categoryTemplate = 'category';
        } else {
            $categoryTemplate = $category['tpl'];
        }

        if ($countPages > 0) {
            if (!file_exists($template->template_dir . $categoryTemplate . '.tpl')) {
                show_error(lang("Can't locate category template file."));
            }
            $content = $template->read($categoryTemplate, ['pages' => $pages]);

        } else {
            $content = $template->read($categoryTemplate, ['no_pages' => lang('In the category has no pages.', 'core')]);
        }

        $category['title'] == NULL ? $category['title'] = $category['name'] : TRUE;

        $category['description'] = $this->ci->core->_makeDescription($category['description']);

        $category['keywords'] = $this->ci->core->_makeKeywords($category['keywords'], $category['short_desc']);

        // adding page number for pages with pagination (from second page)
        $currentPage = $pagination->cur_page;
        if ($currentPage > 1) {
            $title = $category['title'] . ' - ' . $currentPage;
            $description = $category['description'] . ' - ' . $currentPage;

            $this->ci->core->set_meta_tags($title, $category['keywords'], $description);
        } else {
            $this->ci->core->set_meta_tags($category['title'], $category['keywords'], $category['description']);
        }

        $this->ci->core->cat_content = $category;

        $template->assign('content', $content);

        Events::create()->registerEvent($category, 'pageCategory:load');
        Events::runFactory();

        $category['main_tpl'] ? $template->display($category['main_tpl']) : $template->show();

    }

}