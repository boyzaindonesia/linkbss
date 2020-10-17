<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH."libraries/AdminController.php");
class Menus extends AdminController {  
	function __construct()    
	{
		parent::__construct();    
		$this->_set_action();
		$this->_set_action(array("view","edit","delete"),"ITEM");
		$this->_set_title( 'List Menu' );
		$this->DATA->table="mt_menus";
		$this->folder_view = "menus/";
		$this->prefix_view = strtolower($this->_getClass());

		$this->breadcrumb[] = array(
			"title"		=> "Menu",
			"url"		=> $this->own_link
		);
	}

	function index(){
		$this->breadcrumb[] = array(
			"title"		=> "List"
		);
		$data['data'] = $this->DATA->_getall(array(
			'menus_istrash !=' => 1
		),array(
			"by"	=> "position",
			"dir"	=> "asc"
		));
		$this->_v($this->folder_view.$this->prefix_view,$data);
	}
	
	function add(){	
		$this->breadcrumb[] = array(
			"title"		=> "Add"
		);		
		$this->_v($this->folder_view.$this->prefix_view."_form");
	}
		
	function view($id=''){
		$this->breadcrumb[] = array(
			"title"		=> "View"
		);

		$id = explode("-", $id);
		$id = dbClean(trim($id[0]));
		if(trim($id)!=''){
			$this->data_form = $this->DATA->data_id(array(
				'menus_id'	=> $id
			));
			if(empty($this->data_form->menus_id)){
				redirect($this->own_link."?msg=".urlencode('Data menu tidak ditemukan')."&type_msg=error");
			}
			$this->_v($this->folder_view.$this->prefix_view."_view");
		}else{
			redirect($this->own_link);
		}
	}

	function edit($id=''){
		$this->breadcrumb[] = array(
			"title"		=> "Edit"
		);

		$id = explode("-", $id);
		$id = dbClean(trim($id[0]));
		if(trim($id)!=''){
			$this->data_form = $this->DATA->data_id(array(
				'menus_id'	=> $id
			));
			if(empty($this->data_form->menus_id)){
				redirect($this->own_link."?msg=".urlencode('Data menu tidak ditemukan')."&type_msg=error");
			}
			$this->_v($this->folder_view.$this->prefix_view."_form");
		}else{
			redirect($this->own_link);
		}
	}
	
	function delete($id=''){
		$id = explode("-", $id);
		$id = dbClean(trim($id[0]));		
		if(trim($id) != ''){
			$this->db->update("mt_menus",array("menus_istrash"=>1),array("menus_id"=>$id));
		}
		redirect($this->own_link."?msg=".urlencode('Delete data menus success')."&type_msg=success");
	}

	function empty_trash(){
		$data = $this->db->get_where("mt_menus",array(
			"menus_istrash"	=> 1
		))->result();	
		foreach($data as $r){ 
			$id = $r->menus_id;
			$this->db->delete("mt_menus",array('menus_id' => $id));
		}
		redirect($this->own_link."?msg=".urlencode('Empty trash data success')."&type_msg=success");
	}

	function save(){

		if (dbClean($_POST['menus_id']) == ""){
			$data = $this->db->order_by('position','asc')->get_where("mt_menus",array(
				"menus_istrash !="	=> 1
			))->result();	
			$position = 1;
			foreach($data as $r){ 
				$id = $r->menus_id;
				$this->db->update("mt_menus",array("position"=>$position),array("menus_id"=>$id));
				$position +=1;
			} 
		}

		$articleId 			= explode(".",$_POST['menus_article_id']);
		$productId 			= explode(".",$_POST['menus_product_id']);
		$categoryproductId 	= explode(".",$_POST['menus_category_product_id']);
		$galleryId 			= explode(".",$_POST['menus_gallery_id']);
		$data = array(
			'menus_title'				=> dbClean(ucwords($_POST['menus_title'])),
			'menus_status'				=> dbClean($_POST['menus_status']),
			'menus_article_id'			=> $articleId[0],
			'menus_product_id'			=> $productId[0],
			'menus_category_product_id'	=> $categoryproductId[0],
			'menus_gallery_id'			=> $galleryId[0],
			'menus_category_article_id'	=> dbClean($_POST['menus_category_article_id']),
			'menus_link'				=> dbClean($_POST['menus_link']),
			'menus_type'				=> dbClean($_POST['menus_type']),
			'menus_parent_id'			=> dbClean($_POST['menus_parent_id'])
		);	

		if (dbClean($_POST['menus_id']) == "") {
			$data['menus_date'] = timestamp();
			$title = dbClean($_POST['menus_title']);
			if($title==''){ $title = 'menu'; }
			$data['url'] = generateUniqueURL($title,"mt_menus");
		}

		$a = $this->_save_master( 
			$data,
			array(
				'menus_id' => dbClean($_POST['menus_id'])
			),
			dbClean($_POST['menus_id'])			
		);

		$id = $a['id'];

		redirect($this->own_link."/view/".$id.'-'.changeEnUrl($_POST['menus_title'])."?msg=".urlencode('Save data category success')."&type_msg=success");
	}

	function change_position(){
		if ($_POST) {
			$temp_position = $_SERVER['REMOTE_ADDR'];
			$ids    = $_POST["ids"];
			for ($idx = 0; $idx < count($ids); $idx+=1) {
				$id = $ids[$idx];
				$ordinal = $idx;
				//...
				$data = array(
					'position'		=> dbClean($idx),		
					'temp_position'	=> dbClean($temp_position),		
				);		

				$a = $this->_save_master( 
					$data,
					array(
						'menus_id' => dbClean((int)$id)
					),
					dbClean((int)$id)			
				);
			}
			return;
		}

	}
	
	function change_status($id='',$val=''){
		$msg = '';
		$id  = dbClean(trim($id));
		$val = dbClean(trim($val));
		if(trim($id) != ''){
			if($val == 'true'){ $val = '1'; } else { $val = '0'; }
			$this->db->update("mt_menus",array("menus_status"=>$val),array("menus_id"=>$id));
			$msg = 'success';
		}

		$return = array('msg' => $msg);
		die(json_encode($return));
		exit();
	}

	function ajax_link($id=''){
		$msg     = '';
		$content = '';
		$id  = dbClean(trim($id));
		if(trim($id) != ''){
			switch (trim($id)) {
				case '1':
					$dataArticle = get_data_article();
				    if(count($dataArticle) > 0){
						$i = 1;
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$i.'.</td>
						    <td>'.$r->article_title.'</td>
						    <td class="nobr">'.get_category_name($r->article_category_id).'</td>
						    <td class="nobr text-center">'.($r->article_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle1('."'".$r->article_id.'. '.$r->article_title."'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						    $i += 1;
						} 
				    }
					break;
				case '3':
					$dataArticle = get_data_product();
				    if(count($dataArticle) > 0){
						$i = 1;
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$i.'.</td>
						    <td>'.$r->product_name.'</td>
						    <td class="nobr">'.get_product_category_name($r->product_category_id).'</td>
						    <td class="nobr text-center">'.($r->product_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle3('."'".$r->product_id.'. '.$r->product_name."'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						    $i += 1;
						} 
				    }
					break;
				case '4':
					$dataArticle = front_get_category_menu();
				    if(count($dataArticle) > 0){
						$i = 1;
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$i.'.</td>
						    <td>'.$r->product_category_title.'</td>
						    <td class="nobr text-center">'.($r->product_category_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle4('."'".$r->product_category_id.'. '.$r->product_category_title."'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						    $i += 1;
						} 
				    }
					break;
				case '5':
					$dataArticle = front_load_count_gallery();
				    if(count($dataArticle) > 0){
						$i = 1;
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$i.'.</td>
							<td class="">
							    <img src="'.get_image(base_url()."assets/collections/gallery/thumb/".$r->gallery_images).'" class="avatar mfp-fade">
							</td>
						    <td>'.$r->gallery_name.'</td>
						    <td class="nobr text-center">'.($r->gallery_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle5('."'".$r->gallery_id.'. '.$r->gallery_name."'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						    $i += 1;
						} 
				    }
					break;
				default:
					# code...
					break;
			}
			$msg = 'success';
		}

		$return = array('msg' => $msg,'content' => $content);
		die(json_encode($return));
		exit();
	}

}
