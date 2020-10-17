<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH."libraries/FrontController.php");
class ajax_function extends FrontController {
	function __construct()
	{
		parent::__construct();

	}

	function index(){
		// debugCode('a');

	}

	function subscribe(){
		$data = array();
		$data['err'] = true;
		$data['msg'] = '';

		if( isset($_POST['thisAction']) && $_POST['thisAction'] == 'add' ){
			$email = dbClean(trim($_POST['email']));
			if(trim($email)!=''){
				$v = $this->db->get_where("mt_subscribe",array(
					'subscribe_email' => $email
				),1,0)->row();
				if(count($v)>0){
					if($v->subscribe_istrash == '0'){
						$data['err'] = true;
						$data['msg'] = 'Email anda sudah terdaftar...';
					} else {
						$this->db->update("mt_subscribe",array("subscribe_istrash"=>0),array("subscribe_id"=>$v->subscribe_id));
						$data['err'] = false;
						$data['msg'] = 'Terima kasih sudah berlangganan, nantikan penawaran terbaik dari kami...';
					}
				} else {
					$data1 = array(
						'subscribe_email'		=> $email,
						'subscribe_istrash' 	=> 0,
						'subscribe_date'		=> timestamp()
					);

					$this->DATA->table="mt_subscribe";
					$a = $this->_save_master(
						$data1,
						array(
							'subscribe_id' => ''
						)
					);

					$data['err'] = false;
					$data['msg'] = 'Terima kasih sudah berlangganan, nantikan penawaran terbaik dari kami...';
				}

			}
		}

		die(json_encode($data));
		exit();
	}

	function get_ajax_link($id=''){
		$msg     = '';
		$content = '';
		$id  = dbClean(trim($id));
		if(trim($id) != ''){
			switch (trim($id)) {
				case '1':
					$dataArticle = get_data_article();
				    if(count($dataArticle) > 0){
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$r->article_id.'.</td>
						    <td>'.$r->article_title.'</td>
						    <td class="nobr">'.get_category_name($r->article_category_id).'</td>
						    <td class="nobr text-center">'.($r->article_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle('."'".$r->article_id.'. '.$r->article_title."'".','."'1'".','."'form-article'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						}
				    }
					break;
				case '3':
					$dataArticle = get_data_product();
				    if(count($dataArticle) > 0){
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$r->product_id.'.</td>
						    <td>'.$r->product_name.'</td>
						    <td class="nobr">'.get_product_category_name($r->product_category_id).'</td>
						    <td class="nobr text-center">'.($r->product_show=='1'?'<span class="label label-success">Tampil</span>':'<span class="label label-danger">Tidak Tampil</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle('."'".$r->product_id.'. '.$r->product_name."'".','."'3'".','."'form-produk'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						}
				    }
					break;
				case '4':
					$dataArticle = front_get_category_menu();
				    if(count($dataArticle) > 0){
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$r->product_category_id.'.</td>
						    <td>'.$r->product_category_title.'</td>
						    <td class="nobr text-center">'.($r->product_category_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle('."'".$r->product_category_id.'. '.$r->product_category_title."'".','."'4'".','."'form-category-produk'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
						}
				    }
					break;
				case '5':
					$dataArticle = front_load_count_gallery();
				    if(count($dataArticle) > 0){
						foreach($dataArticle as $r){
						$content .= '<tr>
						    <td class="nobr text-center">'.$r->gallery_id.'.</td>
							<td class="">
							    <img src="'.get_image(base_url()."assets/collections/gallery/thumb/".$r->gallery_images).'" class="avatar mfp-fade">
							</td>
						    <td>'.$r->gallery_name.'</td>
						    <td class="nobr text-center">'.($r->gallery_status=='1'?'<span class="label label-success">Active</span>':'<span class="label label-danger">Non Active</span>').'</td>
						    <td class="nobr text-center">
								<a href="javascript:void(0)" onclick="setArticle('."'".$r->gallery_id.'. '.$r->gallery_name."'".','."'5'".','."'form-gallery'".');" class="btn btn-danger btn-xs">Select</a>
						    </td>
						</tr>';
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
