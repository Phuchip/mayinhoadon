<?php 
require_once("../../functions/translate.php");
require_once("../../functions/functions.php");
require_once("../../classes/config.php");
require_once("../../classes/database.php");
require_once("../modules/security/functions.php");

$id = getValue('id','int','POST',0);
$action = getValue('action','str','POST','');
if($action == 'show'){
    $data = array('status' => 1);
}else{
    $data = array('status' => 0);
}
$condition = array('id' => $id );
update('tbl_comments',$data,$condition);

?>