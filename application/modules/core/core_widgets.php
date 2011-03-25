<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 */

class Core_Widgets extends MY_Controller {

    private $defaults = array(
        'news_count'  => 10,
        'max_symdols' => 150,
        'display'     => 'recent' //possible values: recent/popular
        );

   	public function __construct()
	{
		parent::__construct();
    } 

    // Display recent or popular news
    public function recent_news($widget = array())
    {
        if ( $widget['settings'] == FALSE)
        {
            $settings = $this->defaults;
        }else{
            $settings = $widget['settings'];
        }

        $this->db->select('CONCAT_WS("", cat_url, url) as full_url, id, title, prev_text, publish_date, author', FALSE); 
        $this->db->where('post_status', 'publish');
        $this->db->where('prev_text !=', 'null');
        $this->db->where('publish_date <=', time());
        $this->db->where('lang', $this->config->item('cur_lang'));

        if ( count($settings['categories']) > 0)
        {
            $this->db->where_in('category', $settings['categories']);
        }

        if ($settings['display'] == 'recent')
        {
            $this->db->order_by('publish_date', 'desc'); // Recent news
        }elseif ($settings['display'] == 'popular'){
            $this->db->order_by('showed', 'desc'); // Pupular news
        }

        $query = $this->db->get('content', $settings['news_count']);

        if ($query->num_rows() > 0)
        {
            $news = $query->result_array();

            $cnt = count($news);
            for ($i = 0; $i < $cnt; $i++) 
            {
                $news[$i]['prev_text'] = htmlspecialchars_decode($news[$i]['prev_text']);

                // Truncate text
                if ($settings['max_symdols'] > 0 AND mb_strlen($news[$i]['prev_text'], 'utf-8') > $settings['max_symdols'])
                {
                    $news[$i]['prev_text'] = strip_tags( mb_substr($news[$i]['prev_text'], 0, $settings['max_symdols'], 'utf-8') ).'...';
                }
            } 

            $data['recent_news'] = $news;

            return $this->template->fetch('widgets/'.$widget['name'], $data);
            //return $this->fetch_tpl('recent_news', $data);
        }else{
            return '';
        }
    }

    // Configure form
    public function recent_news_configure($action = 'show_settings', $widget_data = array())
    {
        if( $this->dx_auth->is_admin() == FALSE) exit;

        switch ($action)
        {
            case 'show_settings':
                $this->load->library('lib_category');
                $cats = $this->lib_category->build();

                $this->display_tpl('recent_news_form', array('widget' => $widget_data, 'cats' => $cats));
            break;

            case 'update_settings':
                $this->form_validation->set_rules('news_count', 'Количество новостей', 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('max_symdols', 'Максимальное количество символов', 'trim|required|is_natural|min_length[1]');

                if ($this->form_validation->run($this) == FALSE)
                {
                    showMessage( validation_errors() );
                }
                else{
                    $data = array(
                        'news_count'  => $_POST['news_count'],
                        'max_symdols' => $_POST['max_symdols'],
                        'categories'  => $_POST['categories'],
                        'display'     => $_POST['display'],
                    );                       

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                    showMessage('Настройки сохранены.');
                }
            break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $this->defaults);            
            break;
        }
    }

    // Similar posts
    public function similar_posts($widget=array())
    {
        $this->load->module('core');

        if($this->core->core_data['data_type']=='page')
        {
            $sql=array();

            // Get page title
            $title=$this->core->page_content['title'];

            // Clean title
            $title=str_replace(array(',',';',':','-','+','=','@','.','/','\''),'',$title);
            $titleParts=explode(' ',$title);

            if (!empty($titleParts))
            {
                foreach($titleParts as $key=>$text)
                {
                    $text=trim($text);
                    if ($text != '')
                        $sql[]="title LIKE '%$text%'"; 
                }

                if (!empty($sql))
                {
                    $this->db->where('('.implode(' OR ',$sql).') AND id != '.$this->core->page_content['id']);

                    $this->db->limit(5);
                    $this->db->select('content.*');
                    $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url');
                    $this->db->where('post_status', 'publish');
                    $this->db->where('publish_date <=', time()); 
                    $this->db->where('lang', $this->config->item('cur_lang'));
                    $query=$this->db->get('content');

                    if ($query->num_rows() > 0)
                    {
                        $data=array(
                            'pages'=>$query->result_array(),        
                        );
                        
                        return $this->template->fetch('widgets/'.$widget['name'], $data); 
                    }
                }
            }
        }
    }

    // Template functions
	function display_tpl($file, $vars = array())
    {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

	function fetch_tpl($file, $vars = array())
    {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}
