<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Search Module
 * TODO:
 *     refresh cache after $search_ttl expry.
 */
class Search extends MY_Controller
{

    public $search_ttl = 3600; //Search time to live in minutes.

    public $table = '';

    public $cache_on = FALSE;

    public $row_count = 15;

    public $table_pk = 'id';

    public $search_tpl = 'search';

    public $query_hash = '';

    public $search_title = '';

    public $hash_prefix = '';

    public $hash_data = FALSE;

    public $select = [];

    public $title_delimiter = ' - ';

    public $default_operator = 'where';

    public $min_s_len = 3; // Min. length to make search request.

    private $where = [];

    private $order_by = [];

    private $search_table = 'search';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('search');
    }

    // Search pages

    public function index($hash = '', $offset = 0) {
        $this->template->registerMeta('ROBOTS', 'NOINDEX, NOFOLLOW');

        $offset = (int) $offset;

        if ($hash != '') {
            $hash_data = $this->query($hash, $offset);
            $s_text = $this->search_title;
        } else {
            $s_text = $this->getSearchText();
        }

        $text_len = mb_strlen(trim($s_text), 'UTF-8');

        if ($text_len >= $this->min_s_len AND $text_len < 50) {
            $config = [
                       'table'    => 'content',
                       'order_by' => ['publish_date' => 'DESC'],
                       'select'   => [
                                      'content.*',
                                      'CONCAT_WS( "", content.cat_url, content.url ) as full_url',
                                     ],
                      ];

            $this->init($config);

            $where = [
                      [
                       'post_status' => 'publish',
                       'operator'    => 'WHERE',
                      ],
                      [
                       'publish_date <=' => 'UNIX_TIMESTAMP()',
                       'backticks'       => FALSE,
                      ],
                      [
                       'lang' => $this->config->item('cur_lang'),
                      ],
                      [
                       'group1' => '(title LIKE "%' . $this->db->escape_str($s_text) . '%" OR prev_text LIKE "%' . $this->db->escape_str($s_text) . '%" OR full_text LIKE "%' . $this->db->escape_str($s_text) . '%" )',
                       'group'  => TRUE,
                      ],
                     ];

            /** Data for categories in search * */
            $dataForFoundInCategories = $this->countSearchResults($where);
            $dataForFoundInCategories = $dataForFoundInCategories->result_array();

            if ($hash == '') {
                $result = $this->execute($where, $offset);
            } else {
                $result = $this->query($hash, $offset);
            }

            if (!$this->search_title) {
                $this->search_title = $s_text;
            }

            //Pagination
            if ($result['total_rows'] > $this->row_count) {
                $this->load->library('Pagination');

                $paginationConfig['base_url'] = site_url('search/index/' . $result['hash'] . '/');
                $paginationConfig['total_rows'] = $result['total_rows'];
                $paginationConfig['per_page'] = $this->row_count;
                $paginationConfig['uri_segment'] = 4;
                include_once "./templates/{$this->config->item('template')}/paginations.php";
                $paginationConfig['page_query_string'] = FALSE;

                $this->pagination->initialize($paginationConfig);
                $this->template->assign('pagination', $this->pagination->create_links());
            }
            //End pagination
        } else {
            $result = FALSE;
        }

        if ($result === FALSE) {
            $data = FALSE;
        } else {
            $data = $result['query']->result_array();
        }

        if (isset($s_text)) {
            $this->template->assign('search_title', $s_text);
        }

        $data = $this->_highlight_text($data, $s_text);

        $this->core->set_meta_tags([lang('Search', 'search'), $this->search_title]);
        $this->core->core_data['data_type'] = 'search';
        $this->_display($data, $dataForFoundInCategories);
    }

    public function getSearchText() {
        $text = $this->input->post('text') ? $this->input->post('text') : $this->input->get('text');
        return trim($text);
    }

    /**
     * Highlight found text
     * @param array $data Pages to highlight
     * @param string $text
     * @return array
     */
    protected function _highlight_text($data, $text) {
        if (!$data) {
            return;
        }
        $dataCount = count($data);
        for ($i = 0; $i < $dataCount; $i++) {
            $tempText = strip_tags($data[$i]['prev_text'] . ' ' . $data[$i]['full_text']);
            $pos = mb_strpos($tempText, $text);
            $length = mb_strlen($tempText, 'UTF-8');
            $start = $pos - 40;
            $stop = $pos + 40;
            if ($start < 0) {
                $start = 0;
            }
            if ($stop > $length) {
                $stop = $length;
            }

            $tempText = mb_substr($tempText, $start, $stop, 'UTF-8');
            $tempText = str_replace($text, '<mark>' . $text . '</mark>', $tempText);
            $data[$i]['parsedText'] = '...' . mb_substr($tempText, 0, 500, 'utf-8') . '...';
        }

        return $data;
    }

    // Init search settings

    public function init($config = []) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            } else {
                $m = 'set_' . $key;

                if (method_exists($this, $m)) {
                    $this->$m($val);
                }
            }
        }
    }

    public function clear() {
        $this->search_ttl = 600;
        $this->table = '';
        $this->cache_on = FALSE;
        $this->default_operator = 'where';
        $this->where = [];
        $this->order_by = [];
        $this->search_table = 'search';
        $this->query_hash = '';
        $this->hash_data = FALSE;
    }

    // Search by hash

    public function query($hash = '', $offset = 0) {
        if (($hash_data = $this->hash_data($hash)) == FALSE) {
            $this->load->module('core');
            $this->core->error_404();
        }

        $this->table = $hash_data->table_name;
        $this->hash = $hash_data->hash;
        $this->order_by = unserialize($hash_data->order_by);
        $this->select = unserialize($hash_data->select_array);
        $this->search_title = $this->hash_data->search_title;

        return $this->execute(unserialize($hash_data->where_array), $offset);
    }

    // Search

    public function execute($where = [], $offset = 0) {
        $collect_ids = FALSE;

        if ($this->table == '') {
            $error = lang('Error. Select or specify the table for search', 'search');
            return $error;
        }

        $this->query_hash = $this->generate_hash($where);

        $hs = $this->hash_data();

        if ($this->hash_data->datetime + $this->search_ttl < time() AND $this->hash_data->datetime > 0) {
            $refresh = TRUE;
            $this->hash_data->datetime = time();
        } else {
            $refresh = FALSE;
        }

        if ($hs == FALSE OR $refresh == TRUE) {
            $collect_ids = TRUE;

            if ($refresh == FALSE) {
                // Store query data
                if (!$this->search_title) {
                    $this->search_title = $this->getSearchText();
                }

                $q_data = [
                           'hash'         => $this->query_hash,
                           'datetime'     => time(),
                           'where_array'  => serialize($where),
                           'select_array' => serialize($this->select),
                           'table_name'   => $this->table,
                           'order_by'     => serialize($this->order_by),
                           'row_count'    => $this->row_count,
                           'search_title' => $this->search_title,
                          ];

                $this->db->insert($this->search_table, $q_data);
            }
        } else {
            if (!is_array($this->hash_data->ids)) {
                $this->hash_data->ids = unserialize($this->hash_data->ids);
            }

            $where = [];
            $ids = [];

            for ($i = $offset; $i < $offset + $this->row_count; $i++) {
                if (isset($this->hash_data->ids[$i])) {
                    $ids[] = $this->hash_data->ids[$i];
                }
            }

            if (count($ids) > 0) {
                $this->db->where_in($this->table_pk, $ids);
            } else {
                return FALSE;
            }
        }

        // begin query
        if (count($where) > 0) {
            foreach ($where as $params) {
                // Set search operator. (where, like, or_where, etc..)
                if (isset($params['operator'])) {
                    $operator = strtolower($params['operator']);
                    unset($params['operator']);
                } else {
                    $operator = $this->default_operator;
                }

                // Protect field names with backticks.
                if (isset($params['backticks'])) {
                    $backticks = $params['backticks'];
                    unset($params['backticks']);
                } else {
                    $backticks = TRUE;
                }

                if (isset($params['group']) AND $params['group'] == TRUE) {
                    $use_group = TRUE;
                    unset($params['group']);
                } else {
                    $use_group = FALSE;
                }

                foreach ($params as $key => $val) {
                    if ($use_group == FALSE) {
                        $this->db->$operator($key, $val, $backticks);
                    } else {
                        $this->db->where($val);
                    }
                }
            }
        }

        // Set order_by params
        if (count($this->order_by) > 0) {
            foreach ($this->order_by as $key => $val) {
                $this->db->order_by($key, $val);
            }
        }

        // Add SELECT string
        if (count($this->select) > 0) {
            foreach ($this->select as $key => $val) {
                $this->db->select($val);
            }
        }

        if ($collect_ids == TRUE) {
            $ids = [];

            $this->db->select($this->table_pk);
            $query = $this->db->get($this->table)->result_array();

            foreach ($query as $row) {
                $ids[] = $row[$this->table_pk];
            }

            $this->db->where('hash', $this->query_hash);
            $this->db->update('search', ['datetime' => time(), 'ids' => serialize($ids), 'total_rows' => count($ids)]);

            return $this->execute($where, $offset);
        } else {
            if (!$this->search_title) {
                $this->search_title = $this->input->post('text');
            }

            $data = [
                     'query'        => $this->db->get($this->table),
                     'total_rows'   => $this->hash_data->total_rows,
                     'hash'         => $this->query_hash,
                     'search_title' => $this->search_title,
                    ];

            return $data;
        }
    }

    private function countSearchResults($where) {
        // begin query
        if (count($where) > 0) {
            foreach ($where as $params) {
                // Set search operator. (where, like, or_where, etc..)
                if (isset($params['operator'])) {
                    $operator = strtolower($params['operator']);
                    unset($params['operator']);
                } else {
                    $operator = $this->default_operator;
                }

                // Protect field names with backticks.
                if (isset($params['backticks'])) {
                    $backticks = $params['backticks'];
                    unset($params['backticks']);
                } else {
                    $backticks = TRUE;
                }

                if (isset($params['group']) AND $params['group'] == TRUE) {
                    $use_group = TRUE;
                    unset($params['group']);
                } else {
                    $use_group = FALSE;
                }

                foreach ($params as $key => $val) {
                    if ($use_group == FALSE) {
                        $res = $this->db->$operator($key, $val, $backticks);
                    } else {
                        $res = $this->db->where($val);
                    }
                }
            }
        }

        return $res->get($this->table);
    }

    // Generate search hash

    private function generate_hash($where = []) {
        return sha1($this->hash_prefix . $this->table . serialize($this->order_by) . serialize($where) . $this->row_count . serialize($this->select));
    }

    /**
     * @return integer
     */
    private function hash_data($hash = '') {
        if ($hash == '') {
            $hash = $this->query_hash;
        }

        if ($this->hash_data != FALSE) {
            return $this->hash_data;
        }

        $this->db->limit(1);
        $this->db->where('hash', $hash);
        $query = $this->db->get($this->search_table);

        if ($query->num_rows == 1) {
            $this->hash_data = $query->row();
            return $query->row();
        } else {
            return FALSE;
        }
    }

    // Display search template file

    public function _display($pages = [], $foundInCategories = null) {
        /*         * Prepare categories for search results * */
        $categoriesInSearchResults = null;
        $tree = null;
        $categories = [];

        if ($foundInCategories != null) {
            $this->load->library('lib_category');
            foreach ($foundInCategories as $key => $value) {
                if (array_key_exists($value['category'], $categories)) {
                    $categories[$value['category']]['count'] ++;
                } else {
                    $value['count'] = 1;
                    $categories[$value['category']] = $value;
                }
            }

            $categoriesInSearchResults = $this->prepareCategoriesForSearchResults($categories);
            $tree = $this->lib_category->build();
            $categoriesInfo = $this->lib_category->unsorted();
        }

        if (count($pages) > 0) {
            ($hook = get_hook('core_return_category_pages')) ? eval($hook) : NULL;

            $this->template->add_array(
                [
                 'items'                     => $pages,
                 'categoriesInSearchResults' => $categoriesInSearchResults,
                 'tree'                      => $tree,
                 'countAll'                  => count($foundInCategories),
                 'categoriesInfo'            => $categoriesInfo,
                ]
            );
        }

        $this->template->show($this->search_tpl);
    }

    /**
     * Prepare categories for search results
     * @param array $foundInCategories
     * @return boolean|array
     */
    private function prepareCategoriesForSearchResults($foundInCategories) {
        $categoriesArray = [];
        $categoriesAll = $this->lib_category->unsorted();
        foreach ($categoriesAll as $key => $value) {
            /** Count of found pages in category * */
            if (array_key_exists($key, $foundInCategories)) {
                $categoriesArray[$key] = $foundInCategories[$key]['count'];
            }
            /** For fetched pages * */
            $mainCategory = $key;
            if (($fetchCategories = unserialize($categoriesAll[$mainCategory]['fetch_pages'])) != false) {
                foreach ($foundInCategories as $page) {
                    if (in_array($page['category'], $fetchCategories)) {
                        if (array_key_exists($mainCategory, $categoriesArray)) {
                            $categoriesArray[$mainCategory] = $categoriesArray[$mainCategory] + $page['count'];
                        } else {
                            $categoriesArray[$mainCategory] = $page['count'];
                        }
                    }
                }
            }
        }
        return $categoriesArray;
    }

    // Create search table

    public function _install() {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        $this->load->dbforge();

        $fields = [
                   'id'           => [
                                      'type'           => 'INT',
                                      'constraint'     => 11,
                                      'auto_increment' => TRUE,
                                     ],
                   'hash'         => [
                                      'type'       => 'VARCHAR',
                                      'constraint' => 264,
                                     ],
                   'datetime'     => [
                                      'type'       => 'INT',
                                      'constraint' => 11,
                                     ],
                   'where_array'  => ['type' => 'TEXT'],
                   'select_array' => ['type' => 'TEXT'],
                   'table_name'   => [
                                      'type'       => 'VARCHAR',
                                      'constraint' => 100,
                                     ],
                   'order_by'     => ['type' => 'TEXT'],
                   'row_count'    => [
                                      'type'       => 'INT',
                                      'constraint' => 11,
                                     ],
                   'total_rows'   => [
                                      'type'       => 'INT',
                                      'constraint' => 11,
                                     ],
                   'ids'          => ['type' => 'TEXT'],
                   'search_title' => [
                                      'type'       => 'VARCHAR',
                                      'constraint' => '250',
                                     ],
                  ];

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('search', TRUE);
    }

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        $this->load->dbforge();
        $this->dbforge->drop_table('search');
    }

}

/* End of file search.php */