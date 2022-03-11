<?php
include '../home/config.php';
$query_array_tag = new db_query("SELECT * FROM `tbl_tags`");
while ($value = mysql_fetch_array($query_array_tag->result)) {
    $data[$value['id']] = array(
    	'name'	=> $value['name'],
    	'link'	=> '/'.$value['alias'].'-ID-'.$value['id'].'.html',
    );
}
echo json_encode($data)

?>