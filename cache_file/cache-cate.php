<?
    $type = 1;
    if($diadiem != 0 && $nganhnghe == 0) {
        $name_cache = 'city';
        $index_cache = $diadiem;
    }
    if($diadiem == 0 && $nganhnghe != 0){
        $name_cache = 'cate';
        $index_cache = $nganhnghe;
    }
    if($diadiem != 0 && $nganhnghe != 0) {
        $type = 2;
        $name_cache = 'catecity';
    }
    $expire = 86400;
    //Khởi tạo file cache json
    $file = "../cache_file/".$name_cache."-cache.json";
    $refesh = (isset($_POST['refesh']))?$_POST['refesh']:"";
    
    if(filesize($file) > 7000000 || $refesh != ''){      
        $array_tong = [];
        if($refesh != '') {
            $create_now = true;
            $array_refesh = [
                "../cache_file/cate-cache.json",
                "../cache_file/city-cache.json",
                "../cache_file/catecity-cache.json"
            ];
            foreach($array_refesh as $a => $b){
                $OUTPUT = json_encode($array_tong);  
                $fp = fopen($b,"w"); 
                fputs($fp, $OUTPUT); 
                fclose($fp);
            }
            $expire = 1;
            die;
        }else{
            $OUTPUT = json_encode($array_tong);  
            $fp = fopen($file,"w"); 
            fputs($fp, $OUTPUT); 
            fclose($fp);
        }
        unset($array_tong,$refesh,$array_refesh);
    }
    
    $array       = json_decode(file_get_contents($file),true);
    
    $create_now = false;

    if($type == 1){ // Nhánh ngành nghề hoặc tỉnh thành
        
        if(!array_key_exists($index_cache, $array)){
            $create_now = true;
        }
        else if(!array_key_exists($page,$array[$index_cache])){
            $create_now = true;
        }
        $array_cache = $array[$index_cache];
    }else{ // Nhánh ngành nghề tại tỉnh thành
        if(!array_key_exists($nganhnghe, $array)){
            $create_now = true;
        }else if(!array_key_exists($diadiem,$array[$nganhnghe])){
            $create_now = true;
        }
        if($create_now == false){
            $array_cache =  $array[$nganhnghe][$diadiem];
        }
    }
    
    
    if (file_exists($file) && filemtime($file) > (time() - $expire) && $create_now == false) {
        $count = $array_cache['total'];
    }else{
        $numrow = new db_query("SELECT count(1) FROM new INNER JOIN user_company ON new_user_id = user_company.usc_id WHERE new_active = 1 AND new_thuc = 1 AND new_hot = 0 ".$sql." ");
        $count = mysql_fetch_assoc($numrow->result);
        $count = $count['count(1)'];
        $sql_db_qr = "SELECT new.new_id,usc_id,new_money,new_city,new_cap_bac,new_create_time,usc_create_time,usc_logo,usc_company,new_title,new_nganh,usc_alias,new.new_han_nop,new_alias FROM new INNER JOIN user_company ON new_user_id = user_company.usc_id WHERE new_active = 1 AND new_thuc = 1 AND new_hot = 0 ".$sql." ORDER BY new.new_nganh DESC, new.new_id DESC,new.new_han_nop DESC LIMIT ".$start.",".$curentPage;

        $db_qr = new db_query($sql_db_qr);
        
        $get_array_cache = $db_qr->result_array('new_id');
        
        $array_tong       = json_decode(file_get_contents($file),true);
        
        if($type == 1){
            $array_tong[$index_cache][$page] = $get_array_cache;
            $array_tong[$index_cache]['total'] = $count;
            $array_cache = $array_tong[$index_cache];
        }else{
            $array_tong[$nganhnghe][$diadiem][$page] = $get_array_cache;
            $array_tong[$nganhnghe][$diadiem]['total'] = $count;
            $array_cache = $array_tong[$nganhnghe][$diadiem];
        }

        $OUTPUT = json_encode($array_tong);  
        $fp = fopen($file,"w"); 
        fputs($fp, $OUTPUT); 
        fclose($fp);       
    }

?>