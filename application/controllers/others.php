<?php
include_once(APPPATH."libraries/FrontController.php");
class others extends FrontController {

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
		$this->cur_menu = '';
		$this->header_type = '0';
		$this->footer_type = '0';
		$this->url_back    = '';
		$this->backtotop   = true;
		$this->scroll_anchor = true;

		$data = array();
		$load_function = 'not_found';

		$CI 		= getCI();
		$name 		= $CI->uri->segment(1);
		$action 	= $CI->uri->segment(2);
		$action_id 	= $CI->uri->segment(3);

		$own_links = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(empty($name)){
        	$this->not_found();
        } else {
	        $r = $this->db->get_where("mt_menus",array(
				'url'		=> $name
			),1,0)->row();
			if(count($r)>0){
				$class = $r->menus_class;
				$functions = $r->menus_function;
				if($functions == ''){
			    	debugCode($functions);
				} else {
					$data['menus'] = $r;
					$data['menus_action'] = $action;
					$data['menus_action_id'] = $action_id;

					if($class == 'load_function'){
						$this->load->library('../controllers/front/site');
						$this->site->$functions();
					} else {
						$this->page     = $r->menus_title;
						$this->cur_menu = $r->url;
						$this->header_type = '1';
						$this->footer_type = '1';
						$this->url_back    = '';
						$this->backtotop   = true;
						$this->scroll_anchor = true;

						$data['menu']    = $r->menus_title;
						$data['menu_id'] = $r->menus_id;

						$data['section'] = $this->db->order_by('position','asc')->get_where("mt_menus",array(
							"menus_parent_id"	=> $data['menu_id']
						))->result();

						// 	$id = '7';
						// 	$cat = $this->db->get_where("mt_article_category",array(
						// 		"category_id"	=> $id
						// 	))->row();
						// 	$data['category_title']	= $cat->category_title;
						// 	$data['category_desc']	= $cat->category_desc;
						// 	$data['category_image']	= $cat->category_image;

						$this->_v($functions,$data);
					}
				}
			} else {
		        $m = $this->db->get_where("mt_short_link",array(
					'short_link_code' => $name
				),1,0)->row();
				if(count($m) > 0){
					$short_link_id   = $m->short_link_id;
					$short_link_url  = $m->short_link_url;
					$short_link_view = $m->short_link_view;

					$dataInsert = array(
                        'short_link_id'          => $short_link_id,
                        'short_link_detail_date' => timestamp(),
                        'ip_address'             => $_SERVER['REMOTE_ADDR'],
                        'user_agent'             => $_SERVER['HTTP_USER_AGENT']
                    );
					$this->DATA->table = "mt_short_link_detail";
					$saveInsert = $this->_save_master(
                                $dataInsert,
                                array(
                                    'short_link_detail_id' => ""
                                ),
                                ""
                            );

                    $this->db->update("mt_short_link",array("short_link_view"=>($short_link_view + 1)),array("short_link_id"=>$short_link_id));

					redirect($short_link_url);
				} else {
					$data['menu']   = $name;
					$data['url']    = $own_links;
					$this->_v("link_not_found",$data);
				}
			}
		}
	}

	function not_found(){
		$this->page     = 'ERROR 404 - PAGE NOT FOUND';
		$this->cur_menu = '404';
		$this->header_type = '1';
		$this->footer_type = '1';
		$this->url_back    = '';

		$data = '';
		$data['menu'] = "404";
		$data['menu_id'] = "";

		$this->_v('404',$data);
	}

}
