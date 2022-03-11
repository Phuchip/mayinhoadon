<?
    include('../home/config.php');

    if(!isset($_COOKIE['cookie'])){
        $cookie = 130;
        setcookie('cookie',$cookie,time() + 3600,'/');
    }else{
        $cookie = $_COOKIE['cookie'];
    }
    
    $curentPage = 10;
    $pageab = abs($cookie - 1);
    $start = $pageab * $curentPage;
    $start = intval(@$start);
    $start = abs($start);
    $db_qrs = new db_query("SELECT cit_id, cit_name,cit_parent FROM city2 WHERE cit_parent != 0 LIMIT $start,$curentPage");
    $db_qr = new db_query("SELECT * FROM `tbl_tags` WHERE `tag_parent` = 3 AND `tag_phase` = 3 ORDER BY `tag_id` ASC");
    if(mysql_num_rows($db_qrs->result) > 0){
        While($rows = mysql_fetch_assoc($db_qrs->result)){
            While($row = mysql_fetch_assoc($db_qr->result)){
                $diadiem = $rows['cit_parent'];
                $qh = $rows['cit_id'];
                $tag_key_id = $row['tag_id'];
                $sql = '';
                $keysearch = trim(str_replace(' ','%',$row['tag_name']));
                $sql .= " AND (FIND_IN_SET('".$tag_key_id."',new_tag) OR (new_title LIKE '%".$keysearch."%'))" ;
                $sql .= " AND ((usc_address LIKE '%".str_replace("'", '', $rows['cit_name'])."%' AND usc_city = '".$diadiem."') OR FIND_IN_SET('$qh',usc_district) OR FIND_IN_SET('$qh',new_qh_id))";
                $sql_qr = "SELECT count(*) FROM new JOIN user_company ON new.new_user_id = user_company.usc_id WHERE 1 ".$sql;
                
                $db_count = new db_query($sql_qr);
                $r = mysql_fetch_assoc($db_count->result);
                $count = $r['count(*)'];
                if($count >= 4) {
                    $tag_name = "Tìm việc làm ".$row['tag_name']." tại ".$rows['cit_name']." ".$arrcity[$diadiem]['cit_name'];
                    $alias = replaceTitle($tag_name);
                    $db_qrs = new db_query("SELECT tag_id FROM tbl_tags WHERE tag_alias = '$alias'");
                    
                    $c = mysql_num_rows($db_qrs->result);
                    if($c == 0){
                        $data = [
                            'tag_name' => $tag_name,
                            'tag_alias' => $alias,
                            'tag_parent' => 5,
                            'tag_key_id' => $row['tag_id'],
                            'tag_city' => $diadiem,
                            'tag_district_id' => $qh,
                            'tag_create_date' => time(),
                            'tag_edit_date' => time(),
                            'tag_phase' => 3
                        ];
                        add('tbl_tags',$data);
                    }
                }
            }
        }
        echo "Quét xong lần ".$cookie;
        setcookie('cookie',$cookie+1,time() + 3600,'/');
        echo '<meta http-equiv="refresh" content="10"/>';
    }else{
        echo 'xong';
    }
    
?>