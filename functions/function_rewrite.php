<?
function generate_cate_url($row){
   $url	=	"/blog/".replaceTitle($row['cat_name'])."-c" . $row["cat_id"] . "/";
	return $url;
}
function rewrite_news($title,$id){
	$url	=	"/" . replaceTitle($title)  . "-c" . $id . ".html";
	return $url;
}
function rewriteNews_amp($id,$title,$alias){

  $alas = replaceTitle($title);
  $alas = substr($alas,0,55);
  if ($alas == '') {
   $alas = 'tuyen-dung-viec-lam-quoc-te';
  }
  if($alias != ''){
    $url = "/amp-".$alias."-".$id.".html";
  }else{
    $url = "/amp-".$alas. "-" . $id . ".html";
  }
  return  $url;
}
function rewriteNews($id,$title,$alias){

  $alas = replaceTitle($title);
  $alas = substr($alas,0,55);
  if ($alas == '') {
   $alas = 'tuyen-dung-viec-lam-quoc-te';
  }
  if($alias != '' && strlen($alias) < 100){
    $url = "/".$alias."-".$id.".html";
  }else{
    $url = "/".$alas. "-" . $id . ".html";
  }
  return  $url;
}

function rewriteUV($id,$title){
  $alas = replaceTitle($title);
  $alas = substr($alas,0,55);
  if ($alas == '') {
   $alas = 'nuoc-ngoai';
 }
 return  "/ung-vien/".$alas. "-uv" . $id.".html";
}

function list_cate_par($catid,$catname){
  return  "/c".$catid."/".replaceTitle($catname);
}

function rewriteCate($city,$cityname,$nganhnghe,$catname){
  $linkrt = "";
  $arr_ck = ['79','44','83'];
  if(in_array($nganhnghe,$arr_ck)){
    $arr_l = array('Tìm','tìm','tim','Việc','việc','làm','Làm','viec','làm','lam');
    $arr_r = array('','','','','','','','','','');
    $catname = str_replace($arr_l, $arr_r, $catname);
  }
  if($city != 0 && $nganhnghe == 0)
  {
   $linkrt = "/viec-lam-tai-".replaceTitle($cityname)."-c".$city.".html";
  }elseif($city == 0 && $nganhnghe  != 0)
  {
    if($nganhnghe == 87){
      $linkrt = "/tim-viec-lam-them.html";
    }else {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-l".$nganhnghe.".html";
    }
   
  }elseif($city != 0 && $nganhnghe  != 0){
    if($nganhnghe == 87){
      $linkrt = "/tim-viec-lam-them-tai-".replaceTitle($cityname)."-c".$city."l87.html";
    }else{
      $linkrt = "/viec-lam-".replaceTitle($catname)."-tai-".replaceTitle($cityname)."-c".$city."l".$nganhnghe.".html";
    }
 }
 return  $linkrt;
}

function rewriteCateUV($city,$cityname,$nganhnghe,$catname){
  $linkrt = "";
  if($city == 0 && $nganhnghe == 0)
  {
    $linkrt = "/ung-vien-tim-viec.html";
  }elseif($city != 0 && $nganhnghe == 0){
   $linkrt = "/ung-vien-tai-".replaceTitle($cityname)."-c".$city;
 }elseif($city == 0 && $nganhnghe  != 0){
   $linkrt = "/ung-vien-".replaceTitle($catname)."-l".$nganhnghe;
 }elseif($city != 0 && $nganhnghe  != 0){
   $linkrt = "/ung-vien-".replaceTitle($catname)."-tai-".replaceTitle($cityname)."-c".$city."l".$nganhnghe;
 }
 return  $linkrt;
}

function rewriteSuaTin($id){
  return "/nha-tuyen-dung/".$id."/sua-tin.html";
}
function rewriteCTUV($id,$name){
  return "/ung-vien/".replaceTitle($name)."-uv".$id.".html";
}
function rewriteTacgia($id,$name){
  return "/blog/tac-gia/".replaceTitle($name)."/tg".$id.".html";
}
 function rewritemoney($catid,$catname,$city,$cityname){
   $linkrt = "";
   if($catid == 0 && $city == 0)
   {
      $linkrt = "/viec-lam-luong-cao.html";
   }
   else if($catid != 0 && $city == 0)
   {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-luong-cao-i".$catid."v".$city.".html";
   }
   else if($catid == 0 && $city != 0)
   {
      $linkrt = "/viec-lam-luong-cao-tai-".replaceTitle($cityname)."-i".$catid."v".$city.".html";
   }
   else if($catid != 0 && $city != 0)
   {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-luong-cao-tai-".replaceTitle($cityname)."-i".$catid."v".$city.".html";
   }
	return  $linkrt;
 }
function rewriteSearch($keyword,$nganhnghe,$catname,$diadiem,$namediadiem)
{
   $titrw = '';
   if($keyword != ''&&$nganhnghe == 0 &&$diadiem == 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+toan-quoc"."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != ''&& $nganhnghe != 0 && $diadiem == 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+"."nganh-".replaceTitle($catname)."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != '' && $nganhnghe == 0 && $diadiem != 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+"."tai-".replaceTitle($namediadiem)."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != '' && $nganhnghe != 0 && $diadiem != 0)
   {
   $titrw =  str_replace(" ","-",$keyword)."+"."tai-".replaceTitle($namediadiem)."-c".$nganhnghe."p".$diadiem.".html";
   }
   return "/tim-kiem/".$titrw;
}

function rewrite_company_amp($idcp,$namecp,$alias)
{
  if($alias!='') $compn = "/amp-".$alias."-n".$idcp.".html";
  else {
    $alas = replaceTitle($namecp);
    $alas = substr($alas,0,55);
    if ($alas == '') {
      $alas = 'cong-ty-nuoc-ngoai';
    }
    $compn = "/amp-".replaceTitle($alas)."-n".$idcp.".html";
  }
  return $compn;
}

function rewrite_company($idcp,$namecp,$alias)
{

  if($alias!='') $compn = "/".$alias."-n".$idcp.".html";
  else {
      $alas = replaceTitle($namecp);
      $alas = substr($alas,0,55);
      if ($alas == '') {
       $alas = 'cong-ty-nuoc-ngoai';
     }
    $compn = "/".$alas."-n".$idcp.".html";

  }
  return $compn;
}
function rewrite_rate($id){
  $url = '/danh-gia-cong-ty-r'.$id.'.html';
  return $url;
}
function rewrite_interview($id){
  $url = '/danh-gia-phong-van-i'.$id.'.html';
  return $url;
}

function name_company($name)
{
    $name = trim($name);
   $name = mb_convert_case($name,MB_CASE_TITLE,'UTF-8');
   $name = str_replace("tnhh","TNHH",$name);
   $name = str_replace("Tnhh","TNHH",$name);
   $name = str_replace("cp","CP",$name);
   $name = str_replace("Cp","CP",$name);
   $name = str_replace("Mtv","MTV",$name);
   $name = str_replace("MTv","MTV",$name);
   $name = str_replace("mtv","MTV",$name);
   $name = str_replace("Tmdv","TMDV",$name);
   $name = str_replace("tmdv","TMDV",$name);
   $name = str_replace("'","",$name);

   return $name;
}
function replaceTitle($title){
  $title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
  $title  = remove_accent($title);
  $title = str_replace('/', '',$title);
  $title = preg_replace('/[^\00-\255]+/u', '', $title);

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

function rewriteCreateCV($alias){
  return "/tao-cv-online/".$alias.".html";
}

function rewriteCreateCV_NN($alias,$id,$nn){
  return "/tao-cv-online/".$alias."-".$id."-".$nn.".html";
}

function rewriteNNCV($alias){
  return "/mau-cv/".$alias.".html";
}
function rewriteLangCV($alias){
  return "/mau-cv/tieng".str_replace("tieng","", $alias).".html";
}
function rewriteBlog($id,$title){
  $url = "/blog/".$title."-new".$id.".html";
  return $url;
}
function rewriteCHPV($id,$title){
  $url = "/cau-hoi-phong-van/".$title."-pv".$id.".html";
  return $url;
}
function rewriteCateBM($alias){
  $url = "/blog/c3/bieu-mau/".$alias;
  return $url;
}
function rewriteLangLetter($id,$title){
  $url = "/mau-thu-xin-viec/thu-xin-viec-".replaceTitle($title)."-s".$id.".html";
  return $url;
}
function rewriteCateLetter($alias){
  $url = "/mau-thu-xin-viec/".$alias.".html";
  return $url;
}
function rewriteUrlTag($alias,$tagId){
  $url = "/".$alias."-k".$tagId.".html";
  
  return $url;
}
function rewriteCreateLetter($alias,$id){
  $url = "/tao-thu-xin-viec/".$alias."-n".$id.".html";
  return $url;
}
function rewriteNNAppli($alias){
  $url = "/don-xin-viec/".$alias.".html";
  return $url;
}
function rewriteCreateAppli($alias,$id){
  $url = "/tao-don-xin-viec/".$alias."-m".$id.".html";
  return $url;
}
function rewriteTagCompany($id,$name){
  $url = "/cong-ty-".replaceTitle($name)."-tvt".$id.".html";
  return $url;
}
function rewriteCateCompany($id,$name){
  $url = "/danh-sach-cong-ty-".replaceTitle($name)."-tvb".$id.".html";
  return $url;
}
function rewriteCityCompany($id,$name){
  $url = "/danh-sach-cong-ty-tai-".replaceTitle($name)."-tvc".$id.".html";
  return $url;
}
function rewriteKeyCityCompany($idkey,$keyname,$idcity,$cityname){
  $url = "/cong-ty-".replaceTitle($keyname)."-tai-".replaceTitle($cityname)."-s".$idkey."u".$idcity.".html";
  return $url;
}
function rewriteTagSll($id, $tag_alias){
  return "/luong-".$tag_alias."-m".$id.".html";
}
?>
