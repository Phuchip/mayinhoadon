<?
include '../home/config.php';

$key = getValue('key','str','POST','');
$error = 1;
if($key != ''){
    foreach($array_all_tag as $value){
        if($key == mb_convert_case($value['name'], MB_CASE_LOWER, "UTF-8")){
            $link = '/'.$value['alias'].'-ID-'.$value['id'].'.html';
            $error = 0;
        }
    }
}
if($error == 1){
    $data = array('result' => false,'link' =>'/tim-kiem?keyword='.$key );
}else{
    $data = array('result' => true,'link'=>$link );
}
echo json_encode($data);

?>