<?php
function GetImageButtonValue($Button)
{
  $cles = array_keys($Button);
  return $cles[0]; 
}
function ConvertDateToFr($DateUS)
{
   $array=explode("-",$DateUS);
   $NewDate=$array[2].'/'.$array[1].'/'.$array[0];
    return $NewDate;
}

/* Suppression d'un repertoire */
function deltree($dossier)
{
        if(($dir=opendir($dossier))===false)
            return;
 
        while($name=readdir($dir)){
            if($name==='.' or $name==='..')
                continue;
            $full_name=$dossier.'/'.$name;
 
            if(is_dir($full_name))
                @deltree($full_name);
            else @unlink($full_name);
            }
 
        closedir($dir);
 
        @rmdir($dossier);
        }

?>