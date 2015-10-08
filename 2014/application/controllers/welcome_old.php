<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->helper('entry');
		//$this->output->enable_profiler(TRUE);
	}
	
	public function lang($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        if ($url = $this->input->get('redirect', TRUE)) redirect($url);
        else redirect(base_url());
    }
	
	public function index() {
		$data['products'] = $this->db->select('*')->from('ds_product')->get()->result_array();
		$data['scrollanal'] = TRUE;
		$this->load->view('layout/header');
		$this->load->view('landing_closed', $data);
		$this->load->view('layout/footer');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */