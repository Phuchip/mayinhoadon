<?php
function pagination($current_page,$total_page){
    echo '<ul class="pagination">';
    if ($current_page > 1 && $total_page > 1){
        echo '<li class="page page_prev page-li active" value="'.($current_page-1).'"><p rel="prev"><i class="ic-pagination-prev"></i></p></li>';
    }else{
        echo '<li class="page page_prev"><p rel="prev"><i class="ic-pagination-prev"></i></p></li>';
    }
    for ($i = 1; $i <= $total_page; $i++){
        if ($i == $current_page){
            echo '<li class="active"><p>'.$i.'</p></li>';
        }
        else{
            echo '<li class="page-li" value='.$i.'><p>'.$i.'</p></li>';
        }
    }
    if ($current_page < $total_page && $total_page > 1){
        echo '<li class="page page_next page-li active" value='.($current_page+1).'><p rel="next"><i class="ic-pagination-next"></i></p></li>';
    }else{
        echo '<li class="page page_next"><p rel="next"><i class="ic-pagination-next"></i></p></li>';
    }
    echo '</ul>';
}
?>
