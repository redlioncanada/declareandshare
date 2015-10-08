<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Share extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('entry');
		$this->load->library('session');
		$this->load->database();
		//$this->output->enable_profiler(TRUE);
	}
	
	public function index($product_slug = NULL) {
		if (!$product_slug) redirect("/");
		
		$data['product'] = $this->db->select('*')->from('ds_product')->where('slug', $product_slug)->get()->row_array();
		if (!$product_slug || !isset($data['product']['id'])) redirect("/");
		$data['colors'] = $this->db->select('ds_colors.name, ds_colors.slug, ds_colors.shortcode, ds_colors.hex_value, ds_colors.name_fr')->from('ds_colors')->join('ds_product_colors', 'ds_product_colors.color_id = ds_colors.id')->where('ds_product_colors.product_id', $data['product']['id'])->get()->result_array();
		
		foreach ($data['colors'] as &$color) {
			$hsl = RGB_TO_HSV($color['hex_value']);
			$color['lightness'] = $hsl['V'];
		}
		usort($data['colors'], "_compare_lightness");
		
		$this->load->view('layout/header');
		$this->load->view('share_customized', $data);
		$this->load->view('layout/footer');
	}
	
	public function enter($selected_product = NULL, $selected_color = NULL) {
		//check if already entered via cookie - if entered, send to fuck you page
		//if (check_entry()) redirect('/share/thanks/again');
		
		//grab all products and cross referenced colors
		$data['products'] = $this->db->select('*')->from('ds_product')->get()->result_array();
		$data['colorsets'] = $this->db->select('ds_colors.id, ds_colors.name, ds_colors.name_fr, ds_product.slug')->from('ds_product_colors')
										->join('ds_product', 'ds_product.id = ds_product_colors.product_id')
										->join('ds_colors', 'ds_colors.id = ds_product_colors.color_id')
										->order_by('ds_product.slug asc')
										->get()->result_array();
		//grab shared product and color to pre-populate form
		$data['selected_product'] = $selected_product;
		$data['selected_color'] = $selected_color;
		$data['colors'] = array();
		
		if ($selected_product) {
			$product_data = $this->db->select('*')->from('ds_product')->where('slug', $selected_product)->get()->row_array();
			$data['colors'] = $this->db->select('ds_colors.name, ds_colors.slug, ds_colors.id, ds_colors.name_fr')->from('ds_colors')->join('ds_product_colors', 'ds_product_colors.color_id = ds_colors.id')->where('ds_product_colors.product_id', $product_data['id'])->get()->result_array();
		}
		
		//grab view
		$this->load->view('layout/header');
		$this->load->view('enter', $data);
		$this->load->view('layout/footer');
	}
	
	public function thanks($already = NULL) {
		//check if already entered via email crossref - if entered, send to already signed up page
		if ($already == 'again' || check_entry($this->input->post('email'))) {
			
			$this->load->view('layout/header');
			$this->load->view('nothanks');
			$this->load->view('layout/footer');
		} else {
			if (!$this->input->post('body', TRUE)) {
				save_entry($this->input->post(NULL, TRUE));
			}
			
			$this->load->view('layout/header');
			$this->load->view('thanks');
			$this->load->view('layout/footer');
		}
	}
	
	public function mailshare($selected_product = NULL, $selected_color = NULL) {
		$response = array('error' => 'none', 'response' => NULL);
		
		if (!$selected_product || !$selected_color) {
			$response['error'] = 'No product or color provided.';
		} else {
			$this->load->config('mandrill');
			$this->load->library('mandrill');
			$mandrill_ready = NULL;
			
			try {
				$this->mandrill->init( $this->config->item('mandrill_api_key') );
				$mandrill_ready = TRUE;
			} catch (Mandrill_Exception $e) {
				$mandrill_ready = FALSE;
				echo "Mandrill wasn't ready.";
			}
			
			if ($mandrill_ready) {		
			    $data['product'] = $this->db->select('*')->from('ds_product')->where('slug', $selected_product)->get()->row_array();
			    $data['color'] = $this->db->select('*')->from('ds_colors')->where('slug', $selected_color)->get()->row_array();
			    
			    if (!count($data['product']) || !count($data['color'])) {
					$response['error'] = 'No valid product or color provided.';   
			    } else {
				    $yourname = $this->input->post('yourname', true);
				    $youremail = $this->input->post('youremail', true);
				    $friendname = $this->input->post('friendname', true);
				    $friendemail = $this->input->post('friendemail', true);
				    $email_body = str_replace('[[FRIEND]]', $yourname, $this->load->view('email', $data, true));
				    
				    $email = array(
				        'html' => $email_body,
				        'text' => strip_tags($email_body),
				        'subject' => lang('email_subject'),
				        'from_email' => $youremail,
				        'from_name' => $yourname,
				        'to' => array(array('name' => $friendname, 'email' => $friendemail )),
				        'track_opens' => true,
				        'track_clicks' => true,
				        'tags' => array($selected_product, $selected_color)
				    );
					$result = $this->mandrill->messages_send($email);
				    $response['response'] = $result[0];
			    }
			}
		}
		
		echo json_encode($response);
	}
	
}
