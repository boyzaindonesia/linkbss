<?php
function checkIsRoute($title){
	$arr = array('default_controller','admin','cms','404_override','front','auth','chat','data','site','news','load_more_news','about','story','developer','project','contact','send_message','term-of-use','privacy-policy','gallery','load_more_gallery','gallery-images','cart-store','checkout','membership','confirmation','messages','search','products','p','fb-login','google-login','twitter-login','authorize','login','logout','register','account-verification','reset-password','create-new-password','account','profile','change-email','change-password','change-photo-profile','check-form-member','account-send-verification','address','shop','cart','checkout','store','report');
    if (in_array($title, $arr)) {
    	return TRUE;
    } else {
    	return FALSE;
    }
}

function check_isnot($val=''){
	return ($val!=''?(substr($val,0,2)!='!='?' = ':'').$val:'');
}

function cleanSpace($string=""){
	$str = trim(preg_replace('/[\s]+/',' ',$string));
	return $str;
}

function DOMinnerHTML(DOMNode $element){
    $innerHTML = "";
    $children  = $element->childNodes;
    foreach ($children as $child){
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }
    return $innerHTML;
}

function get_name_app($alias=""){
	$CI = getCI();
	$m = $CI->db->get("mt_configuration")->row();
	return $m->$alias;
}

function writeLog($par=array()){
	$CI = getCI();
	$data = array();
	$data['log_date'] 		= timestamp();
	$data['log_class'] 		= $par['log_class'];
	$data['log_function'] 	= $par['log_function'];
	$data['log_user_type']	= $par['log_user_type'];
	$data['log_user_name']	= $par['log_user_name'];
	$data['log_user_id'] 	= $par['log_user_id'];
	$data['log_role'] 		= $par['log_role'];
	$data['log_ip'] 		= $_SERVER['REMOTE_ADDR'];
	$data['log_user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$data['log_url'] 		= $par['log_url'];
	$data['log_var_get'] 	= $par['log_var_get'];
	$data['log_var_post']	= $par['log_var_post'];
	$data['log_type']		= $par['log_type'];
	$data['log_tmp_id']		= $par['log_tmp_id'];
	$data['log_title'] 		= $par['log_title'];
	$data['log_desc'] 		= $par['log_desc'];
	$data['app_id'] 		= $par['app_id'];
	$CI->DATA->table = "mt_app_log";
	$a = $CI->_save_master(
		$data,
		array(
			'log_id' => ''
		)
	);
}
function log_user_type($id=''){
	$result = '';
	$m   = '';
	$m[] = array('id' => '1', 'name' => 'Admin');
	$m[] = array('id' => '2', 'name' => 'Member');
	$result = $m;
	if($id != ''){
		foreach ($m as $key => $val) {
			if($val['id'] == $id){
				$result = array('id' => $val['id'], 'name' => $val['name']);
				// log_user_type('1')['name'];
			}
		}
	}
	return $result;
}
function log_type($id=''){
	$result = '';
	$m   = '';
	$m[] = array('id' => '1', 'name' => 'System');
	$m[] = array('id' => '2', 'name' => 'Product');
	$m[] = array('id' => '3', 'name' => 'Apps');
	$result = $m;
	if($id != ''){
		foreach ($m as $key => $val) {
			if($val['id'] == $id){
				$result = array('id' => $val['id'], 'name' => $val['name']);
				// log_type('1')['name'];
			}
		}
	}
	return $result;
}
function log_title($id=''){
	$result = '';
	$m   = '';
	$m[] = array('id' => '1', 'name' => 'Perubahan Produk');
	$m[] = array('id' => '2', 'name' => 'Perubahan Soldout');
	$result = $m;
	if($id != ''){
		foreach ($m as $key => $val) {
			if($val['id'] == $id){
				$result = array('id' => $val['id'], 'name' => $val['name']);
				// log_title('1')['name'];
			}
		}
	}
	return $result;
}

function getLang(){
	$CI = getCI();
	if(isset($_GET['lang'])){
		$lang_id 	 = '';
		$lang_status = false;
		switch ($_GET['lang']) {
			case 'en': $lang_id = 'en'; $lang_status = true; break;
			case 'ind': $lang_id = 'ind'; $lang_status = true; break;
			default: break;
		}
		if($lang_status){
			$CI->jCfg['lang'] = $lang_id;
			$CI->_releaseSession();
		}
	} else {
		if(!isset($CI->jCfg['lang'])){ $CI->jCfg['lang'] = 'en'; $CI->_releaseSession(); }
	}
}

function genOddEven($i=1,$a=2) {
	if ($i % $a == 0){
		return true; //odd
	} else {
		return false;
	}
}

function convDatetoString($vardate) {
		return strtotime($vardate);
	}
function convDateTable($vardate) {
	if($vardate!=''){
		$tahun = substr($vardate, 0, 4);
		$tahun2 = substr($vardate, 2, 2);
		$bulan = substr($vardate, 5, 2);
		$tgl   = substr($vardate, 8, 2);

		$jam   = substr($vardate, 11, 2);
		$menit   = substr($vardate, 14, 2);
		$detik   = substr($vardate, 17, 2);
		$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		return $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun ;
	} else {
		return '-';
	}
}
function convDateTimeTable($vardate) {
	if($vardate!=''){
		$tahun = substr($vardate, 0, 4);
		$tahun2 = substr($vardate, 2, 2);
		$bulan = substr($vardate, 5, 2);
		$tgl   = substr($vardate, 8, 2);

		$jam   = substr($vardate, 11, 2);
		$menit   = substr($vardate, 14, 2);
		$detik   = substr($vardate, 17, 2);
		$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		return $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun .", ". $jam .":". $menit ;
	} else {
		return '-';
	}
}
function convTime($vardate) {
	if($vardate!=''){
		$jam   = substr($vardate, 11, 2);
		$menit   = substr($vardate, 14, 2);
		$detik   = substr($vardate, 17, 2);
		return $jam .":". $menit ;
	} else {
		return '-';
	}
}
function convDateTimeEng($vardate) {
	if($vardate != ''){ return date("D M j, H:i", strtotime($vardate) ); } else { return '-'; }
}
function convDateTimeFullEng($vardate) {
	if($vardate != ''){ return date("l d F Y, H:i", strtotime($vardate) ); } else { return '-'; }
}
function convDateEng($vardate) {
	if($vardate != ''){ return date("l, F d, Y", strtotime($vardate) ); } else { return '-'; }
}
function convDateNewEng($vardate) {
	if($vardate != ''){ return date("d F Y", strtotime($vardate) ); } else { return '-'; }
}
function convDate($vardate) {
	$tahun = substr($vardate, 0, 4);
	$tahun2 = substr($vardate, 2, 2);
	$bulan = substr($vardate, 5, 2);
	$tgl   = substr($vardate, 8, 2);
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	return $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
}
function convDate2($vardate) {
	$tahun = substr($vardate, 0, 4);
	$tahun2 = substr($vardate, 2, 2);
	$bulan = substr($vardate, 5, 2);
	$tgl   = substr($vardate, 8, 2);
	$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	return $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
}
function convDateINtoEN($vardate="4/28/2018") {
	$date = str_replace('/', '-', $vardate);
	return date('Y-m-d', strtotime($date));
}

function convDay($vardate="") {
	$tgl   = substr($vardate, 8, 2);
	return $tgl;
}
function convMonth($vardate="") {
	$bulan = substr($vardate, 5, 2);
	$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	return $BulanIndo[(int)$bulan-1];
}
function convYears($vardate="") {
	$tahun = substr($vardate, 0, 4);
	return $tahun;
}
function convYearsMonth($vardate="") {
	$bulan = substr($vardate, 5, 2);
	$tahun = substr($vardate, 0, 4);
	$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	return $BulanIndo[(int)$bulan-1].' '.$tahun;
}
function convTwoDate($date_start="",$date_end="") {
	$date_start = date("Y-m-d", strtotime($date_start));
	$date_end   = date("Y-m-d", strtotime($date_end));
	$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	if($date_start == $date_end){
		return convDateTable($date_start);
	} else if( (getMonth($date_start) == getMonth($date_end)) && (getYear($date_start) == getYear($date_end)) ){
		return getDay($date_start).' - '.getDay($date_end).' '.$BulanIndo[(int)getMonth($date_start)-1].' '.getYear($date_start);
	} else if( (getMonth($date_start) != getMonth($date_end)) && (getYear($date_start) == getYear($date_end)) ) {
		return getDay($date_start).' '.$BulanIndo[(int)getMonth($date_start)-1].' - '.getDay($date_end).' '.$BulanIndo[(int)getMonth($date_end)-1].' '.getYear($date_start);
	} else if( (getYear($date_start) != getYear($date_end)) ) {
		return getDay($date_start).' '.$BulanIndo[(int)getMonth($date_start)-1].' '.getYear($date_start).' - '.getDay($date_end).' '.$BulanIndo[(int)getMonth($date_end)-1].' '.getYear($date_end);
	} else {
		return "";
	}
}
function convDateFilename($vardate="") {
	$tahun = substr($vardate, 0, 4);
	$bulan = substr($vardate, 5, 2);
	$tgl   = substr($vardate, 8, 2);
	$jam   = substr($vardate, 11, 2);
	$menit = substr($vardate, 14, 2);
	$detik = substr($vardate, 17, 2);
	return $tahun."_".$bulan."_".$tgl.'_'.$jam."_".$menit."_".$detik;
}

function timestamp(){
	return gmdate("Y-m-d H:i:s", time()+60*60*7); //GMT +7;
}

function xTimeAgo ($oldTime, $newTime, $timeType) { //Berfungsi untuk menghitung diff /selisih 2 datetime dan menjadikannya ke format menit,jam atau hari
    $timeCalc = strtotime($newTime) - strtotime($oldTime);
    if ($timeType == "s") {
        $timeCalc .= " seconds ago";
    }
    if ($timeType == "m") {
		if (round($timeCalc/60)==0){
			$timeCalc = "just now";
		} else {
			$timeCalc = round($timeCalc/60) . " minutes ago";
		}
    }
    if ($timeType == "h") {
        $timeCalc = round($timeCalc/60/60) . " hours ago";
    }
    if ($timeType == "d") {
        $timeCalc = round($timeCalc/60/60/24) . " days ago";
    }
    if ($timeType == "k") {
        $timeCalc = "yesterday";
    }
	if ($timeType == "t") {
		$tahun = substr($newTime, 0, 4);
		$tahun2 = substr($newTime, 2, 2);
		$bulan = substr($newTime, 5, 2);
		$tgl   = substr($newTime, 8, 2);

		$jam   = substr($newTime, 11, 2);
		$menit   = substr($newTime, 14, 2);
		$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$timeCalc = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun ." ". $jam .":". $menit;
    }
    return $timeCalc;
}
function timeAgo($vardate=""){ //Berfungsi untuk menimbang hasil xTimeAgo, jika jam menit lebih dari 60 maka dihitung jam, jika jam lebih dari 24 maka dihitung hari
	$go = '';
	if($vardate!=''){
		date_default_timezone_set('Asia/Jakarta');
		$skrg	= date("Y-m-d H:i:s");
		$isi	= str_replace("-","",xTimeAgo($skrg,$vardate,"m"));
		$isi2	= str_replace("-","",xTimeAgo($skrg,$vardate,"h"));
		$isi3	= str_replace("-","",xTimeAgo($skrg,$vardate,"k"));
		$isi4	= str_replace("-","",xTimeAgo($skrg,$vardate,"d"));
		$isi5	= xTimeAgo($skrg,$vardate,"t");
		$go = "";
		if($isi2 > 168) {
			$go = $isi5;
		} elseif($isi2 > 48) {
			$go = $isi4;
		} elseif($isi2 > 24) {
			$go = $isi3;
		} elseif($isi > 60) {
			$go = $isi2;
		} elseif($isi < 61) {
			$go = $isi;
		}
	}
	return $go;
}
function getDay($vardate) {
	$tgl = substr($vardate, 8, 2);
	return $tgl;
}
function getMonth($vardate) {
	$bulan = substr($vardate, 5, 2);
	return $bulan;
}
function getYear($vardate) {
	$tahun = substr($vardate, 0, 4);
	return $tahun;
}
function getNameMonth($id) {
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	return $BulanIndo[(int)$id-1];
}

function getMinDay($vardate, $length) {
	$jadi = date('Y-m-d H:i:s', strtotime('-'.$length.' days', strtotime( $vardate )));
	return $jadi;
}
function getMinWeekly($vardate, $length) {
	$jadi = date('Y-m-d H:i:s', strtotime('-'.$length.' week', strtotime( $vardate )));
	return $jadi;
}
function getMinMonth($vardate, $length) {
	$jadi = date('Y-m-d H:i:s', strtotime('-'.$length.' month', strtotime( $vardate )));
	return $jadi;
}
function getAddDay($vardate, $length) {
	$jadi = date('Y-m-d H:i:s', strtotime('+'.$length.' days', strtotime( $vardate )));
	return $jadi;
}
function getAddWeekly($vardate, $length) {
	$jadi = date('Y-m-d H:i:s', strtotime('+'.$length.' week', strtotime( $vardate )));
	return $jadi;
}
function getAddMonth($vardate, $length) {
	$jadi = date('Y-m-d H:i:s', strtotime('+'.$length.' month', strtotime( $vardate )));
	return $jadi;
}

function getYearMonthDate($vardate) {
	$tahun = substr($vardate, 0, 4);
	$bulan = substr($vardate, 5, 2);
	$tgl   = substr($vardate, 8, 2);
	return $tahun."-".$bulan."-".$tgl;
}
function getYearMonth($vardate) {
	$tahun = substr($vardate, 0, 4);
	$bulan = substr($vardate, 5, 2);
	return $tahun."-".$bulan;
}
function getMonthDate($vardate) {
	$tahun = substr($vardate, 0, 4);
	$bulan = substr($vardate, 5, 2);
	$tgl   = substr($vardate, 8, 2);
	return $bulan."-".$tgl;
}
function getMonthDate2($vardate) {
	$bulan = substr($vardate, 5, 2);
	$tgl   = substr($vardate, 8, 2);
	$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	return $tgl." ".$BulanIndo[(int)$bulan-1];
}
function getLastMonth() {
	$m  = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
	$jadi  = date("Y-m", $m);
	return $jadi;
}
function getDateGroup($tipe_date='',$date_start='',$order_by='asc'){
	$m  = array();
	if($tipe_date=='days'){ // get_date_group('days','2016-01-01');
		$date_end = getYearMonthDate(timestamp());
		$modify   = 'days';
		$format   = 'Y-m-d';
	}
	if($tipe_date=='monthly'){ // get_date_group('monthly','2016-01');
		$date_end = getYearMonth(timestamp());
		$modify   = 'months';
		$format   = 'Y-m';
	}
	if($tipe_date=='years'){ // get_date_group('years','2016');
		$date_end = getYear(timestamp());
		$modify   = 'years';
		$format   = 'Y';
	}

	$begin = new DateTime( $date_start );
	$end   = new DateTime( $date_end );
	if($order_by == 'desc'){
		for($i = $end; $end >= $begin; $i->modify('-1 '.$modify)){
		    $m[] = $i->format($format);
		}
	} else {
		for($i = $begin; $begin <= $end; $i->modify('+1 '.$modify)){
		    $m[] = $i->format($format);
		}
	}
	return $m;
}

function convRomawi($num){
    $n   = intval($num);
    $res = '';

    $roman_numerals = array(
                'M'  => 1000,
                'CM' => 900,
                'D'  => 500,
                'CD' => 400,
                'C'  => 100,
                'XC' => 90,
                'L'  => 50,
                'XL' => 40,
                'X'  => 10,
                'IX' => 9,
                'V'  => 5,
                'IV' => 4,
                'I'  => 1);

    foreach ($roman_numerals as $roman => $number){
        $matches = intval($n / $number);
        $res .= str_repeat($roman, $matches);
        $n = $n % $number;
    }
	return $res;
}

function convertPhone($angka) {
	$jadi = preg_replace('/[^0-9]/', '', $angka);
	$cek1 = substr($jadi,0,2);
	if($cek1 == '62'){
		$jadi = substr_replace($jadi,'0',0,2);
	}
	$cek2 = substr($jadi,0,1);
	if($cek2 != '0'){
		$jadi = '0'.$jadi;
	}
	return $jadi;
}
function convertRp($angka) {
	$jadi = $angka;
	if(is_numeric($angka)){
		$jadi = 'Rp '.number_format($angka,0,',','.');
	}
	return $jadi;
}
function convertRp2($angka) {
	$jadi = $angka;
	if(is_numeric($angka)){
		$jadi = number_format($angka,0,',','.');
	}
	return $jadi;
}
function convertRpToInt($angka) {
	$jadi = str_replace(".", "", $angka);
	return $jadi;
}
function convertRpToInt2($angka) {
	$jadi = preg_replace('/[^0-9]/', '', $angka);
	return $jadi;
}

function convertGrToKg($angka) {
	$jadi = $angka;
	if(is_numeric($angka)){
		$jadi = ($angka / 1000);
	}
	return $jadi;
}
function convertGrToKgCeil($angka) {
	$jadi = $angka;
	if(is_numeric($angka)){
		$jadi = ceil(($angka / 1000));
	}
	return $jadi;
}
function convertGrToKgStr($angka) {
	$jadi = $angka;
	if(is_numeric($angka)){
		$jadi = ($angka / 1000);
	}
	return $jadi;
}
function convertKgToGr($angka) {
	$jadi = $angka;
	// if(is_numeric($angka)){
	// 	$jadi = ceil(($angka / 1000));
	// }
	return $jadi;
}
function calcPercent($value, $total) {
	$jadi = '0';
	if(is_numeric($value) && is_numeric($total)){
		$jadi = ($value / $total) * 100;
		$jadi = number_format($jadi, 0, ',', '');
	}
	return $jadi;
}
function calcPercentDiscount($value, $total) {
	$jadi = '0';
	if(is_numeric($value) && is_numeric($total)){
		$jadi = ($value / $total) * 100;
		$jadi = 100 - number_format($jadi, 0, ',', '');
	}
	return $jadi;
}


function notifyMessage($class="",$alert="",$msg=""){
	$result = '';
	if($class!=""&&$alert!=""&&$msg!=""){
	$result = '<div class="alert '.$class.' square fade in alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>'.$alert.'</strong> '.$msg.'
            </div>';
	}
    return $result;
}

function ubah_huruf_awal($paragrap) {
	$pisahkalimat = explode(" ", $paragrap);
	$kalimatbaru = array();

	foreach ($pisahkalimat as $kalimat){
		$kalimatawalhurufbesar=ucfirst(strtolower($kalimat));
		$kalimatbaru[] = $kalimatawalhurufbesar;
	}

	$textgood = implode(" ", $kalimatbaru);
	return $textgood;
}
function getFirstStr($string){
    $string = explode(" ", $string);
    $string = $string[0];
    return $string;
}
function getFirstParaNumb($string,$numb="70"){
	$string = html_entity_decode(strip_tags(stripslashes($string)));
	if(strlen($string) > $numb){
		$string = substr( $string, 0,$numb).' ...';
	}
    return $string;
}
function getFirstParaNumbNoDot($string,$numb="70"){
	$string = html_entity_decode(strip_tags(stripslashes($string)));
	if(strlen($string) > $numb){
		$string = substr( $string, 0,$numb);
	}
    return $string;
}
function getFirstParaSm($string){
	$string = html_entity_decode(strip_tags(stripslashes($string)));
	if(strlen($string) > 70){
		$string = substr( $string, 0,70).' ...';
	}
    return $string;
}
function getFirstPara($string){
	$string = html_entity_decode(strip_tags(stripslashes($string)));
	if(strlen($string) > 140){
		$string = substr( $string, 0,140).' ...';
	}
    return $string;
}
function getFirstParaLg($string){
	$string = html_entity_decode(strip_tags(stripslashes($string)));
	if(strlen($string) > 140){
		$string = substr( $string, 0,240).' ...';
	}
    return $string;
}

function folder_views_lg(){
	$folder_views = "large/";
    $detect = new Mobile_Detect();
    if ($detect->isTablet()) {
    	$folder_views = "small/";
    } else if ($detect->isMobile() || $detect->isAndroidOS()) {
    	$folder_views = "thumb/";
    }
	return $folder_views;
}
function folder_views_sm(){
	$folder_views = "small/";
    $detect = new Mobile_Detect();
    if ($detect->isTablet()) {
    	$folder_views = "small/";
    } else if ($detect->isMobile() || $detect->isAndroidOS()) {
    	$folder_views = "thumb/";
    }
	return $folder_views;
}

function get_user_name($id=""){
	$CI = getCI();
	$CI->db->where("is_trash !=",1);
	$CI->db->where("user_id",$id);
	$m = $CI->db->get("mt_app_user")->row();
	$name = "";
	if( count($m) > 0){
		$name = $m->user_fullname;
	}
	return $name;
}

function get_menus_parent($id){
	$CI = getCI();
	$temp = "";
	$m1 = $CI->db->get_where("mt_menus",array(
		"menus_parent_id"	=> '0',
		"menus_istrash"		=> '0',
	))->result();
	if(!empty($m1)){
		foreach($m1 as $k => $m1){
			if($m1->menus_id == $id){
				$s1 = 'selected="selected" disabled="disabled"';
			}else{
				$s1 = '';
			}
			$temp .= '<option value="'.$m1->menus_id.'" '.$s1.'>'.$m1->menus_title.'</option>';
			$m2 = $CI->db->get_where("mt_menus",array(
				"menus_parent_id"	=> $m1->menus_id,
				"menus_istrash"		=> '0',
			))->result();
			if(!empty($m2)){
				foreach($m2 as $k => $m2){
					if($m2->menus_id == $id){
						$s2 = 'selected="selected" disabled="disabled"';
					}else{
						$s2 = '';
					}
					$temp .= '<option value="'.$m2->menus_id.'" '.$s2.'> &#10149; '.$m2->menus_title.'</option>';
					$m3 = $CI->db->get_where("mt_menus",array(
						"menus_parent_id"	=> $m2->menus_id,
						"menus_istrash"		=> '0',
					))->result();
					if(!empty($m3)){
						foreach($m3 as $k => $m3){
							if($m3->menus_id == $id){
								$s3 = 'selected="selected" disabled="disabled"';
							}else{
								$s3 = '';
							}
							$temp .= '<option value="'.$m3->menus_id.'" '.$s3.'> &nbsp;&nbsp;&nbsp;&nbsp;&#10149; '.$m3->menus_title.'</option>';
							$m4 = $CI->db->get_where("mt_menus",array(
								"menus_parent_id"	=> $m3->menus_id,
								"menus_istrash"		=> '0',
							))->result();
							if(!empty($m4)){
								foreach($m4 as $k => $m4){
									if($m4->menus_id == $id){
										$s4 = 'selected="selected" disabled="disabled"';
									}else{
										$s4 = '';
									}
									$temp .= '<option value="'.$m4->menus_id.'" '.$s4.'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#10149; '.$m4->menus_title.'</option>';
								}
							}
						}
					}
				}
			}
		}
	}

	echo $temp;
}

function getFormSearchMain(){
	$CI = getCI();
	$CI->load->view($CI->jCfg['theme'].'/form-search-main');
}

function get_menus_name($id=""){
	$CI = getCI();
	$m = $CI->db->get_where("mt_menus",array(
			"menus_id"	=> $id
		))->row();
	$cat_name = isset($m->menus_title)?$m->menus_title:'-';
	return $cat_name;
}

function themeDefaultUrl(){
	$CI =getCI();
	return base_url().APPPATH."views/front/";
}

function front_get_logo(){
	$CI = getCI();
	$m = $CI->db->get_where("mt_configuration")->row();
	$logo = isset($m->configuration_logo)?$m->configuration_logo:'no_image.jpg';
	return $logo;
}

function front_get_menus($id="0"){
	$CI = getCI();
	$CI->db->order_by("menus_order", "asc");
	$cat = $CI->db->get_where("mt_menus",array(
			"menus_parent_id"	=> $id,
			"menus_status"		=> 1,
			"menus_istrash"		=> 0
		))->result();
	return $cat;
}

function check_menus_parent($id){
	$CI = getCI();
	$CI->db->order_by("menus_order", "asc");
	$cat = $CI->db->get_where("mt_menus",array(
			"menus_parent_id"	=> $id,
			"menus_istrash"		=> '0',
			"menus_status"		=> '1'
		))->row();
	if(!empty($cat)){
		return "1";
	}else{
		return "0";
	}
}

function get_menus_link($id){
	$CI = getCI();
	$cat = $CI->db->get_where("mt_menus",array(
			"menus_id"	=> $id
		))->row();
	$type = isset($cat->menus_type)?$cat->menus_type:"";
	if($type == "0"){
		return base_url()."category/".$cat->menus_category_id."-".$cat->menus_id."-".url_title($cat->menus_title);
	}
	if($type == "1"){
		return base_url()."detail/".$cat->menus_article_id."-".$cat->menus_id."-".url_title(get_article_name($cat->menus_article_id));
	}
	if($type == "2"){
		return base_url()."contact-us?id=".$id;
	}
	if($type == "3"){
		return "";
	}
	if($type == "4"){
		return base_url()."product-category/".$cat->menus_product_category_id."-".$cat->menus_id."-".url_title($cat->menus_title);
	}
	if($type == "5"){
		return base_url()."shop";
	}
	if($type == "6"){
		return base_url()."galeri/".$id;
	}
}

function get_configuration(){
	$CI = getCI();
	$m = $CI->db->get("mt_configuration")->row();
	return $m;
}

function check_menus_id($menuId){
	$CI = getCI();
	$menus1 = $CI->db->get_where("mt_menus",array(
		"menus_id"			=> $menuId,
		"menus_istrash"		=> '0',
		"menus_status"		=> '1'
	))->row();
	$p = $menus1->menus_parent_id;
	$menusIdCheck= $menus1->menus_id;
	if($p > 0){

		$menus2 = $CI->db->get_where("mt_menus",array(
			"menus_id"			=> $menus1->menus_parent_id,
			"menus_istrash"		=> '0',
			"menus_status"		=> '1'
		))->row();
		$p = $menus2->menus_parent_id;
		$menusIdCheck= $menus2->menus_id;
	}
	if($p > 0){

		$menus3 = $CI->db->get_where("mt_menus",array(
			"menus_id"			=> $menus2->menus_parent_id,
			"menus_istrash"		=> '0',
			"menus_status"		=> '1'
		))->row();
		$p = $menus3->menus_parent_id;
		$menusIdCheck= $menus3->menus_id;
	}
	if($p > 0){

		$menus4 = $CI->db->get_where("mt_menus",array(
			"menus_id"			=> $menus3->menus_parent_id,
			"menus_istrash"		=> '0',
			"menus_status"		=> '1'
		))->row();
		$p = $menus4->menus_parent_id;
		$menusIdCheck= $menus4->menus_id;
	}
	$m = $CI->db->get_where("mt_menus",array(
		"menus_id"			=> $menusIdCheck,
		"menus_istrash"		=> '0',
		"menus_status"		=> '1'
	))->row();

	return $m->menus_id;
}

function getCharMail($string){
    $string = substr(trim($string),0,1);
	$result = strtoupper($string);
    return $result;
}
function getAvatarMail($string){
    $string = substr(trim($string),0,1);
	$string = strtoupper($string);

	$result = 'bg-dark';
    if (in_array($string, array('A','G','M','S','Y'))) { $result = 'bg-dark'; }
    if (in_array($string, array('B','H','N','T','Z'))) { $result = 'bg-primary'; }
    if (in_array($string, array('C','I','O','U'))) { $result = 'bg-success'; }
    if (in_array($string, array('D','J','P','V'))) { $result = 'bg-info'; }
    if (in_array($string, array('E','K','Q','W'))) { $result = 'bg-danger'; }
    if (in_array($string, array('F','L','R','X'))) { $result = 'bg-warning'; }

    return $result;
}

function isToken($token,$table,$field) {
    if (isset($token) && $token) {
        $CI = getCI();
		$m = $CI->db->get_where($table,array(
			$field	=> $token
		))->result();
		if(!empty($m)){
			return true;
		} else {
			return false;
		}
    } else {
        return false;
    }
}
function generateUniqueToken($number,$table,$field){
    $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, +$number);
    if (isToken($token,$table,$field)) {
        return generateUniqueToken($number,$table,$field);
    } else {
        return $token;
    }
}

function isUniqueUsername($username) {
    if (isset($username) && $username) {
        //verification values in BD
        if(checkIsRoute($username)){
        	return true;
        } else {
        	$CI = getCI();
	        $v = $CI->db->get_where('mt_member',array(
					'member_username' => $username
				))->row();
			if(count($v)>0){
	            return true;
	        } else {
	            return false;
	        }
        }

    } else {
        return false;
    }
}
function generateUniqueUsername($title){
    $int = substr(str_shuffle("0123456789"), 0, +3);
    $username = changecharnum($title);
    if (isUniqueUsername($username)) {
    	$title = $title.$int;
        return generateUniqueUsername($title);
    } else {
        return $username;
    }
}
