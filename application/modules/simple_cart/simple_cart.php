<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Simple Cart (demo)
 */

class Simple_cart extends Controller {

	public function __construct()
	{
		parent::Controller();
		$this->load->module('core');
	}

	// Display user items list
	public function index()
	{
        $this->load->library('form_validation');

        $this->core->set_meta_tags('Корзина');
   
        $this->template->add_array(array(
            'items' => $this->cart_content()
        ));

        $this->template->show('catalog/cart');
	}

    public function autoload()
    {
        $this->load->helper('cart');
    }

    public function add_item()
    {
        if ($_POST)
        {
            // Get page
            $page = $this->db->get_where('content', array('id' => $this->input->post('item_id')));

            if ($page->num_rows() == 0)
            {
                $this->core->error('Ошибка добавления товара. Страница не нейдена.');
            }
            else
            {
                $page = $page->row();
            }

            // Get page xfields
            $fields = page_fields_extended($page->id);

            $data = array(
                           'id'      => $page->id,
                           'price'   => (float) $fields['price']['field_data'], 
                           'name'    => $page->title,
                        );

            // Insert cart data
            $this->insert_cart_item($data);

            // Set flash message
            $this->session->set_flashdata('cart_added', TRUE);

            // Redirect back to page
            redirect($this->input->post('redirect'), 'refresh');
        }
    }

    // Send order message to admin
    public function order()
    {
        $items = $this->cart_content();

        if (!is_array($items) OR count($items) < 1)
        {
            $this->index();
            return FALSE;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Имя', 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email|xss_clean|max_length[100]');
        $this->form_validation->set_rules('contacts', 'Адрес доставки', 'required|xss_clean|max_length[500]');

        if ($this->form_validation->run() == FALSE)
		{
			$this->index();
            exit;
		}
		else
		{
            // Send mail to admin
            $this->send_mail();

            // Clear all items
            $this->clear();

            $this->template->assign('order_completed', TRUE);

            // Show cart
            $this->index();
		}
    }

    private function send_mail()
    {
        $this->load->library('email');

        $config['mailtype'] = 'html';
        $config['wordwrap'] = FALSE;
        $this->email->initialize($config);

        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to( $this->get_admin_mail() ); 

        $this->email->subject('Заказ');
        $this->email->message( $this->create_admin_message() );

        $this->email->send();
    }

    private function create_admin_message()
    {
        $html = '<html><body><p><b>Новый заказ:</b><br /><br />';
        $items = $this->cart_content();

        foreach($items as $item)
        {
            $html .= $item['name'].'<br />';
        }

        $html .= '
        <br />
            <b>Контакты:</b><br />
            Имя: '.$this->input->post('name').'<br />
            Почта: '.$this->input->post('email').'<br />
            Адрес доставки: '.$this->input->post('contacts').'<br />
        ';

        $html .= '</p></body></html>';

        return $html;
    }

    private function get_admin_mail()
    {
        $this->db->limit(1);
        $this->db->select('email');
        $query = $this->db->get_where('users', array('role_id' => 2))->row();

        return $query->email; 
    }

    // Add new item to cart
    private function insert_cart_item($data = array())
    {
        $current = $this->session->userdata('cart_items');

        if (!is_array($current))
        {
            $current = array();
        }

        $current[$data['id']] = $data;

        $this->session->set_userdata('cart_items', $current);

        return;
    }

    // Delete item from cart
    public function delete($id)
    {
        $items = $this->cart_content();

        if (isset($items[$id]))
        {
            unset($items[$id]);

            //$items = array_values($items);

            $this->session->set_userdata('cart_items', $items);
        }

        redirect('simple_cart');
    }

    // Get all items in cart
    private function cart_content()
    {
        return $this->session->userdata('cart_items');
    }

    // Clear cart data
    private function clear()
    {
        $this->session->set_userdata('cart_items', array());
    }

    public function total()
    {
        $items = $this->session->userdata('cart_items');

        if (!is_array($items))
        {
            return 0;
        }

        $total = 0;
        foreach($items as $k => $v)
        {
            $total = $total + $v['price'];
        }

        return $total;
    }

}

/* End of file simple_cart.php */
