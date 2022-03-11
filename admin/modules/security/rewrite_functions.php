<?
function replaceTitle($title){
  $title  = remove_accent($title);
  $title = str_replace('/', '',$title);
  $title = preg_replace('/[^\00-\255]+/u', '', $title);

  $title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
  if (preg_match("/[\p{Han}]/simu", $title)) {
      $title = str_replace(' ', '-', $title);
  }else{
    $arr_str  = array( "&lt;","&gt;","/"," / ","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");

    $title  = str_replace($arr_str, " ", $title);
    $title  = preg_replace('/\p{P}|\p{S}/u', ' ', $title);
    $title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);

    //Remove double space
    $array = array(
      '    ' => ' ',
      '   ' => ' ',
      '  ' => ' ',
    );
    $title = trim(strtr($title, $array));
    $title  = str_replace(" ", "-", $title);
    $title  = urlencode($title);
    // remove cac ky tu dac biet sau khi urlencode
    $array_apter = array("%0D%0A","%","&");
    $title  = str_replace($array_apter,"-",$title);
    $title  = strtolower($title);
  }
  return $title;
}
function rewrite_url_f($catRoot,$keyword){
	global $lang_path;
	$array_bad_word = array("?","^",",",";","*","/","~","@","-","!","[","]","(",")","=","|",",",".",":");
	$keyword	= mb_strtolower($keyword, 'UTF-8');
	$keyword = str_replace($array_bad_word,"", $keyword);
	$keyword	= explode(' ',$keyword);
	foreach($keyword as $key => $val){
		if(mb_strlen($val,'UTF-8') < 2) unset($keyword[$key]);
	}
	$keyword	= implode(' ', $keyword);
	$url 		= "/f" . $catRoot . "/" . urlencode($keyword) . ".html" ;
	return $url;
}
function rewrite_url_keyword($keyword){
	global $lang_path;
	$url 		= "/s/" . urlencode($keyword) . ".html" ;
	return $url;
}
function rewriteCity($row){
	return '/' . $row['cit_id'] . '/' . replaceTitle($row['cit_name']) . '/';
}
function rewriteCat($row, $iCit=0,$page = 1){
	if($page<1) $page = 1;
   
   if($row['cat_parent_id'] != 0){
	  return '/categories/' . $row['cat_parent_id'] . '/' . $row['cat_id'] . '/' . replaceTitle($row['cat_name']) . '.html';
   }
   else{
	  return '/categories/' . $row['cat_id'] . '/' . replaceTitle($row['cat_name']) . '.html';
   }
}
function rewriteDetail($row){
	return '/' . $row['pro_cat_id'] . '/' . $row['pro_id'] . '/' . replaceTitle($row['pro_name']) . '.html';
}
function rewriteCareer_Detail($row){
	return '/tuyen-dung/' . $row['tes_career_type'] . '/' . $row['tes_id'] . '/' . replaceTitle($row['tes_name']) . '.html';
}
function rewriteUser($row,$page = 1){
	return '/u/' . $row['use_id'] . '/' . replaceTitle($row['use_fullname']) . '-P' . $page . '.html';
}
function rewriteNews_Detail($row){
	return '/tin-tuc/4/' . $row['new_id'] . '/' . replaceTitle($row['new_title']) . '.html';
}
function rewritePeople_Detail($row){
	return '/categories/42/44/' . $row['new_id'] . '/' . replaceTitle($row['new_title']) . '.html';
}
function rewriteAlbum_Detail($row){
	return '/categories/42/45/' . $row['pea_id'] . '/' . replaceTitle($row['pea_title']) . '.html';
}
function rewriteNews_Child($row){
	return '/categories/' . $row['cat_parent_id'] . '-' . $row['cat_id'] . '/' . replaceTitle($row['cat_name']) . '.html';
}
function rewriteNewsTD_Detail($row){
	return '/leadership-bootcamp/50/' . $row['new_id'] . '/' . replaceTitle($row['new_title']) . '.html';
}
function rewriteNewsKN_Detail($row){
	return '/kinh-nghiem/51/' . $row['new_id'] . '/' . replaceTitle($row['new_title']) . '.html';
}
function rewriteOffline($id){
	$add 		=	"offlines";
	$code 	=	md5($id.$add);

	return "/offline/khong-tham-gia-chuong-trinh/". $code ."/";
}
//Loại bỏ dấu
function remove_accent($mystring){
	$marTViet=array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ",
	"'");
	
	$marKoDau=array(
	"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D",
	"");
	
	return str_replace($marTViet,$marKoDau,$mystring);

}
?>
