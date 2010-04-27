<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Для подключения, нужно прописать в шаблоне:
   {echo $star_rating->create($page)}
 
   Рейтинг: 
   {(float)@round($page.rating_value / $page.rating_votes, 1)} / 5 - {$page.rating_votes} голос. 
 
 * Также, включить автозагрузку и доступ по url.
 * Star rating module
 *
 */

class Star_rating extends Controller {

	public function __construct()
	{
		parent::Controller();
		$this->load->module('core');
	}

    public function autoload()
    {
        $this->template->assign('star_rating', $this);
    }

    public function rate($page, $rating)
    {
        $page = (int)$page;
        $rating = (int)$rating;

        if(!in_array($rating, range(1, 5)))
            exit;

        $this->db->limit(1);
        $this->db->where('id', $page);
        $this->db->set('rating_votes', 'rating_votes + 1', FALSE);
        $this->db->set('rating_value', 'rating_value + '.$rating, FALSE);
        $this->db->update('content');
    }

    public function create($page)
    {
        $id = $page['id'];

        $code = "
            $$('.rate').each(function(element,i){
                    element.addEvent('click', function(){
                            var myStyles = ['nostar', 'onestar', 'twostar', 'threestar', 'fourstar', 'fivestar'];
                            myStyles.each(function(myStyle){
                                    if(element.getParent().hasClass(myStyle)){
                                            element.getParent().removeClass(myStyle)
                                    }
                            });             
                            myStyles.each(function(myStyle, index){
                                    if(index == element.id){
                                            element.getParent().toggleClass(myStyle);
                                            var req = new Request.HTML({
                                                method: 'post',
                                                url: '".site_url('star_rating/rate')."' + '/' + element.getParent().id + '/' + element.id ,
                                                onComplete: function(response) {  }
                                            }).post();
                                    }
                            }); 
                        $(element.getParent()).getElements('li').removeEvents('click');
                    });
            });
        ";

        $this->template->registerCssFile('application/modules/star_rating/templates/public/star-rating.css');
        $this->template->registerJsFile('js/mocha/mootools-1.2-core.js');
        $this->template->registerJsCode(__CLASS__.'star-rating', $code);

        $hr = array('nostar', 'onestar', 'twostar', 'threestar', 'fourstar', 'fivestar');

        $cur_rating = (int)@round($page['rating_value'] / $page['rating_votes']); 

        return '
        <ul id="'.$id.'_star_rating" class="rating '.$hr[$cur_rating].'">
          <li id="1" class="rate one"><a href="#" >1</a></li>
          <li id="2" class="rate two"><a href="#" >2</a></li>
          <li id="3" class="rate three"><a href="#" >3</a></li>
          <li id="4" class="rate four"><a href="#" >4</a></li>
          <li id="5" class="rate five"><a href="#" >5</a></li>
        </ul> 
        ';
    }

    // Install
    // Create votes table
    public function _install()
    {
    	if($this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $this->dbforge->add_column('content', array(
            'rating_votes' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => '0',
            ),
        ));


        $this->dbforge->add_column('content', array(
            'rating_value' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => '0',
            ),
        ));

        $this->db->where('name', 'star_rating');
        $this->db->update('components', array(
           'enabled'=>'1',
           'autoload'=>'1',
           'in_menu'=>'0',
        ));
    }

    // Delete module
    // Delete votes table
    public function _deinstall()
    {
       	if( $this->dx_auth->is_admin() == FALSE) exit;
    
        $this->load->dbforge();
        $this->dbforge->drop_column('content', 'rating_votes');  
        $this->dbforge->drop_column('content', 'rating_value');
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

