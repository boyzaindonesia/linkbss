<?php
include_once(APPPATH."libraries/FrontController.php");
class Site extends FrontController {
	var $cur_menu = '';

	function __construct()
	{
		parent::__construct();

		$this->load->library('Mobile_Detect');
	    // $detect = new Mobile_Detect();
	    // if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
	    //     header("Location: /mobile"); exit;
	    // } else {
	    //     header("Location: /desktop"); exit;
	    // }

	}

	function index(){
		$this->page     = '';
		$this->cur_menu = 'home';
		$this->header_type = '0';
		$this->footer_type = '0';
		$this->url_back    = '';

		/*
		$data['menu_id'] = $_GET['id'];
		$data['contact'] = $this->db->get("mt_contact")->row();
		$this->_v('contact',$data);
		*/
		$data = '';
		$data['menu'] = "home";
		$data['menu_id'] = "";

		$this->_v('home',$data);

		// $data['menu'] = "Coming Soon";
		// $data['menu_id'] = "";
		// $this->_v('coming_soon',$data);
	}

}
