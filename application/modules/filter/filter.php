<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Filter Module
 */

class Filter extends MY_Controller {

    public $items_per_page = 1;
    public $default_tpl    = 'search';

	public function __construct()
	{
		parent::__construct();
        //$this->output->enable_profiler(TRUE);
	}

	public function index()
	{ 
        return;	
    }

    public function no_pages_found()
    {
        $this->load->module('core');
        $this->core->error('По Вашему запросу, страниц не найдено.');
        exit;
    }

    // Фильтр страниц
    public function pages()
    {
        $this->load->module('core')->set_meta_tags('Поиск');

        // Удалим из строки запроса /filter/pages
        $segments = array_slice($this->uri->segment_array(), 2);

        // Парсим строку запроса сгенерированную http_build_query обратно в массив.
        $search_data = $this->parse_url($segments);

        // Получаем ID страниц, которые подходят критериям поиска,
        $ids = $this->search_items($search_data);

        // если ничего не найдено, выводим соответствующее сообщение.
        if (!$ids)
            $this->no_pages_found(); //exit

        // Получаем данные страниц
        $query = $this->_filter_pages($ids, $search_data);

        // Сделаем пагинацию
        $this->load->library('Pagination');
        $config['base_url']    = site_url('filter/pages/'.http_build_query($search_data,'','/'));
        $config['total_rows']  = $this->_filter_pages($ids, $search_data, TRUE);
        $config['per_page']    = $this->items_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $config['first_link']  = lang('first_link');
        $config['last_link']   = lang('last_link');
        $config['cur_tag_open']  = '<span class="active">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->num_links = 5;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        if ($query->num_rows() > 0)
        {
            $tpl = $this->default_tpl;
            $pages = $query->result_array();

            // Продублируем здесь хук core_return_category_pages,
            // чтобы подключить к найденным страницам поля cfcm.
            ($hook = get_hook('core_return_category_pages')) ? eval($hook) : NULL;

            // Если поиск производится по одной категории,
            // то используем ее шаблон.
            if (isset($search_data['category']) AND count((array)$search_data['category']) == 1)
            {
                $category = $this->lib_category->get_category($search_data['category']);

                if ($category['tpl'] == '')
                    $tpl = 'category';
                else
                    $tpl = $category['tpl'];
            }

            $data =array(
                'pages'      => $pages,
                'pagination' => $pagination,
                'category'   => $category,
            );

            if ($tpl == 'search') $data['items'] = $data['pages'];

            $this->template->add_array($data);

            $this->template->show($tpl);
        }
        else
        {
            $this->no_pages_found();
        }
    }


    public function _filter_pages($ids, $search_data, $count = FALSE)
    {
        // Вытягиваем только опубликованные страницы
        $where = array(
            'post_status'     => 'publish',
            'publish_date <=' => time(),
            'lang'            => $this->config->item('cur_lang'),
        );

        $this->db->where($where);
        $this->db->where_in('id', $ids);
        // Если в запросе есть переменная 'category'
        // ищем страницы только из указанных категорий.
        if (isset($search_data['category']) AND $search_data['category'] != '')
            $this->db->where_in('category', $search_data['category']);

        if ($count == FALSE)
        {
            $this->db->select('*');
            $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url', FALSE);
            return $this->db->get('content', $this->items_per_page, (int) $this->uri->segment($this->uri->total_segments()) );
        }
        else
        {
            $this->db->from('content');
            return $this->db->count_all_results(); 
        }
    }

    // Создание и вывод формы по ID cfmcm группы.
    public function group($group_id = 0)
    {
        if (!($form = $this->create_filter_form($group_id)))
        {
            $this->core->error('В группе нет полей.');
            exit;
        }

        $this->load->helper('form');

        if ($form->isValid())
        {
            $data = $form->getData();
            $uri_query = http_build_query($data, '', '/');
            redirect('filter/pages/'.$uri_query);
        }

        // перезаполним форму данными $_POST
        if ($_POST)
            $form->setAttributes($_POST);
 
        $form_html = form_open('filter/group/'.(int)$group_id); 
        $form_html .= $form->render();
        $form_html .= form_csrf();
        $form_html .= form_submit('submit', 'Поиск');
        $form_html .= form_close();

        $this->template->add_array(array(
            'content' => $form_html,
            )
        );

        $this->template->show();
    }

    // Создание формы с полей группы модуля cfcm.
    // $group_id - ID cfcm группы или список нужных полей через запятую.
    public function create_filter_form($group_id, $by_fields = FALSE)
    {
        $this->load->module('forms');
        $group = $this->db->get_where('content_field_groups', array('id' => $group_id))->row();
 
        if ($by_fields == FALSE)
        {
            $this->db->where('group', $group_id);
        }
        else
        {
            $exp_fields = explode(",", $group_id);
            if (count($exp_fields) > 0)
                $this->db->where_in('field_name', $exp_fields);
            else
                return FALSE;
        }

        $this->db->where('in_search', '1');
        $this->db->order_by('weight', 'ASC');
        $query = $this->db->get('content_fields');

        if ($query->num_rows() > 0)
        {
            $form_fields = array();
            $fields = $query->result_array();
                
            foreach ($fields as $field)
            {
                $f_data = unserialize($field['data']);
                if ($f_data == FALSE)
                    $f_data = array();

                $form_fields[$field['field_name']] = array(
                    'type'  => $field['type'],
                    'label' => $field['label'],
                );

                $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
            }

            $form = $this->forms->add_fields($form_fields);

            //TODO: set form attrs from session data

            return $form;
        }
        else
        {
            // В группе нет полей;
            return FALSE;
        }        
    }

    // Поиск ID страниц или категорий в таблице `content_fields_data`
    // $fields - Массив field_name => value
    // $type - Возможные значения: page, category
    public function search_items($fields = array(), $type = 'page')
    {
        $search_fields = array();
        $select = array();
        $from   = array();
        $where  = array();
        $strict = array();
        $ids    = array();
       
        if (!$fields)
            return FALSE;

        // Оставим поля, которые имеют префикс field_
        foreach ($fields as $key => $val)
        {
            if ($val != '' AND substr($key, 0, 6) == 'field_')
            {
                $search_fields[] = $key;
            }
        }

        if (count($search_fields) == 0)
            return FALSE;
            
        // В поиске будут участвовать, только поля, которые присутствуют в БД. 
        $this->db->select('field_name, type');
        $this->db->where_in('field_name', (array) $search_fields);
        $this->db->where_in('in_search', '1');
        $query = $this->db->get('content_fields');

        if ($query->num_rows() == 0)
            return FALSE;
        else
            $query = $query->result_array();

 
        $n = 0;
        foreach ($query as $key => $field)
        {
            $name = $field['field_name'];
            
            $select[] = "t_$name.item_id as $name"."_item_id";
            $from[]   = "`content_fields_data` t_$name";

            if ($query[$n+1]['field_name'])
            {
                $strict[]    = "t_$name.item_id = t_".$query[$n+1]['field_name'].".item_id";
                $strict[]    = "t_$name.item_type = '".$type."'";
            }


            if (in_array($field['type'], array('select','checkgroup','radiogroup')))
            {
                $where[] = "(t_$name.field_name='$name' AND t_$name.data IN (".$this->implode($fields[$name])."))";
            }
            elseif(in_array($field['type'], array('text','textarea')))
            {
                $where[] = "(t_$name.field_name='$name' AND t_$name.data LIKE '%".$this->db->escape_str($fields[$name])."%')";
            }
            elseif(in_array($field['type'], array('checkbox')))
            {
                $where[] = "(t_$name.field_name='$name' AND t_$name.data = '".$this->db->escape_str($field_name[$name])."')";
            }

            $n++;
        } 

        // Если есть условия для поиска,
        // составим запрос.
        if (count($where) > 0)
        {
            $sql  = "SELECT \n".implode(",",$select)."\n";
            $sql .= "FROM \n".implode(",", $from)."\n";
            $sql .= "WHERE \n".implode("\nAND\n", $where)."\n";

            if (count($strict) > 0)
                $sql .= "AND \n".implode(" \nAND\n ", $strict)."\n";


            $query = $this->db->query($sql);

            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $key => $val)
                {
                    $ids = array_merge($ids, array_values($val));
                }

                $ids = array_values(array_unique($ids));
            }

            return $ids; 
        } 
        else
        {
            return FALSE;
        }
    }

    // Парсим сегменты http_build_query 
    // обратно в массив.
    public function parse_url($request)
    {
        $result = array();

        if (is_array($request) AND count($request) > 0)
        {
            foreach ($request as $key => $val)
            {
                $vals = explode('=', $val);
                
                $segment_key = preg_replace('/\[.*?\]/', '', $vals[0]);
                $segment_val = $vals[1];

                if (isset($result[$segment_key]))
                {
                    $result[$segment_key] = (array) $result[$segment_key];
                    $result[$segment_key][] = urldecode($segment_val);
                }
                else
                {
                    $result[$segment_key] = $segment_val;
                }
            }

            return $result;
        }

        return FALSE;
    }

    public function implode($array = array())
    {
        $array = array_values((array)$array);

        for ($i=0; $i<count($array); $i++)
        {
            $array[$i] = '"'.$this->db->escape_str($array[$i]).'"';
        }

        return implode(', ', (array) $array); 
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file filter.php */
