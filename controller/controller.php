<?php
ini_set('display_errors',1);

function GetDir($dir_path) {
  $files = array_slice(scandir($dir_path), 2);

    foreach($files as $file)
    {
      if(is_dir($dir_path."/".$file))
      {
        $dir[] = $file;
      }
      else
      { 
        $file1[] = "-".$file;
      }
    }
   $dir = array_merge($dir,$file1);
   return $dir;
}

function getDifference()
{
ini_set('display_errors',1);

$url = explode('/', getcwd());
array_pop($url);
$url = implode('/', $url);//die;

$dir1 = GetDir($url.'/v1');    
$dir2 = GetDir($url.'/v2');
$modified = get_File_difference($dir1,$dir2);
$resp['root'] = $dir2;
$resp['removed'] = array_diff($dir1,$dir2);
$resp['added'] = array_diff($dir2,$dir1);
$resp['modified'] = $modified;
echo json_encode($resp);
}
function get_File_difference($dir1,$dir2)
{
$url = explode('/', getcwd());
array_pop($url);
$url = implode('/', $url);//die;

foreach($dir1 as $file1)
    {
      if(!is_dir($url.'/v1'."/".$file1))
      {
        $st1[] = $file1;
      }
      
    }

foreach($dir2 as $file2)
    {
      if(!is_dir($url.'/v2'."/".$file2))
      {
        $st2[] = $file2;
      }
      
    }

$common_files = array_intersect($st1,$st2);
foreach($common_files as $diff)
{

if(md5(file_get_contents($url.'/v2'."/".ltrim($diff,'-')))!=md5(file_get_contents($url.'/v1'."/".ltrim($diff,'-'))))
$mod[] = $diff;
}

return $mod;

}

getDifference();

?>