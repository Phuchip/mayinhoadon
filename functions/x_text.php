<?
function resize_avatar($url)
{
  require_once("../functions/lib_image.php");
   if(file_exists($url))
   {
        $imageThumb = new Image($url);                         
        $fs_filepath_re = explode('/', $url);
        $name = array_pop($fs_filepath_re);
        $fs_filepath_re = implode('/', $fs_filepath_re);
        $temp=explode('.',str_replace('..', '', $url));
        if($imageThumb->getWidth() > 310){          
            $imageThumb->resize(310,'resize');
            $imageThumb->save(str_replace('/pictures', 'pictures', $temp[0]), $fs_filepath_re, $temp[1]);       
        }
   }
   else
   {
      $url = '/images/no-image.png';
   }
   return $url;
}


echo resize_avatar('../pictures/2019/08/06/gi-6070.jpg');

?>