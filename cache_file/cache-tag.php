<?
// text file cache 
$file = '../cache_file/tag_cache.json'; 

if(filesize($file) > 15000000){
    $array_tong = [];
    $OUTPUT = json_encode($array_tong);  
    $fp = fopen($file,"w"); 
    fputs($fp, $OUTPUT); 
    fclose($fp);
    unset($array_tong);
}

$expire = 10800; // 24 hours 
$time = time();
$arraytong       = json_decode(file_get_contents($file),true);

$create_cache = false;
if(!array_key_exists($idTag,$arraytong)) {
    $create_cache = true;
}else if(!array_key_exists($page,$arraytong[$idTag])) {
    $create_cache = true;
}
// Nếu có cache file và còn trong thời gian chưa hết $expire 
if (file_exists($file) && filemtime($file) > (time() - $expire) && $create_cache == false ) 
{ 
    // Uunserialize data từ cache file 
    $arr_tags = $arraytong[$idTag];
    $count = $arraytong[$idTag]['count'];
} 
else // Cập nhật cache file 
{
    $db_qr = new db_query("SELECT new.new_id,user_company.usc_id,new.new_money,new.new_city,user_company.usc_create_time,user_company.usc_logo,user_company.usc_company,new.new_title,user_company.usc_alias,new_alias, new_mota, new_qh_id, usc_district,usc_city,new_cat_id,new_thuc,new_active,new_index FROM new STRAIGHT_JOIN user_company ON new.new_user_id = user_company.usc_id JOIN new_multi ON new.new_id = new_multi.new_id WHERE 1 ".$sql." ORDER BY new.new_update_time DESC LIMIT ".$start.",".$curentPage);

    $numrow = new db_query("SELECT count(1) FROM new STRAIGHT_JOIN user_company ON new_user_id = user_company.usc_id WHERE 1 ".$sql." "); 
    $count = mysql_fetch_assoc($numrow->result);
    $count = $count['count(1)'];

    $result_tags = $db_qr->result_array('new_id');
    
    $arraytong[$idTag][$page] = $result_tags;
    $arraytong[$idTag]['count'] = $count;
    $arr_tags = $arraytong[$idTag];

    $OUTPUT = json_encode($arraytong);  
    $fp = fopen($file,"w"); 
    fputs($fp, $OUTPUT); 
    fclose($fp);     
} // end else 
?>