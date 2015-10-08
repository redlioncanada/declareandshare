<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Declared extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('language');
		
		if ($this->uri->segment(5)) {
			$lang = $this->uri->segment(5);
			$this->session->set_userdata('site_lang', $lang);
        	$this->lang->load('guide', $lang);
		}
	}
	
	
	public function index($product_slug = NULL, $color_slug = NULL, $language = NULL) {
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('entry');
		
		if (!$product_slug || !$color_slug) redirect("/");
		
		// grab selected product data and color
		$data['product'] = $this->db->select('*')->from('ds_product')->where('slug', $product_slug)->get()->row_array();
		$data['color'] = $this->db->select('*')->from('ds_colors')->where('slug', $color_slug)->get()->row_array();
		$data['og'] = array(
			'title' => $data['product'][dblang('name')],
			'url' => 'http://declareandshare.ca/declared/index/'.$product_slug.'/'.$color_slug,
			'description' => str_replace(array('[[PROD]]','[[COLOR]]'), array($data['product'][dblang('name')],$data['color'][dblang('name')]), lang('fb_desc')),
			'image' => 'http://declareandshare.ca/img/product/'.$product_slug.'/share/'.stripdash($color_slug).'.jpg',
		);
		
		if ($language) {
			$data['og']['url'] .= '/'.$language;
		}
		
		$this->load->view('layout/header', $data);
		$this->load->view('declared', $data);
		$this->load->view('layout/footer');
	}
	
	public function insertdata() {
		
		
	}
	
	/*
public function mailshare() {			
		$this->load->config('mandrill');
		$this->load->library('mandrill');
		$mandrill_ready = NULL;
		
		try {
			$this->mandrill->init( $this->config->item('mandrill_api_key') );
			$mandrill_ready = TRUE;
			echo "Mandrill ready";
		} catch (Mandrill_Exception $e) {
			$mandrill_ready = FALSE;
			echo "Mandrill wasn't ready.";
		}
		
		if ($mandrill_ready) {		
			
		    $email_body = $this->load->view('eblast', NULL, true);
		    
		    $email = array(
		        'html' => $email_body,
		        'text' => strip_tags($email_body),
		        'subject' => "test eblast",
		        'from_email' => 'matt@mattgraham.ca',
		        'from_name' => 'Matt Graham',
		        'to' => array(array('name' => 'Matt', 'email' => 'matt@mattgraham.ca' ),array('name' => 'Nads', 'email' => 'beja.nad@gmail.com')),
		    );
			$result = $this->mandrill->messages_send($email);
			print_r($result);
		}
	}
*/
}