<?php
function LocalAPIs(){
    global $root_path;
    return APIFolder($root_path,"api/");
}

function APIFolder($root,$path,$apis = []){
    //echo "<br><b>$root$path</b><br>";
    $shared_models_dir = opendir($root.$path);
    // LOOP OVER ALL OF THE  FILES    
    while ($file = readdir($shared_models_dir)) { 
        //echo "<br><i>$file</i> ".is_dir($root.$path.$file)."<br>";
        // IF IT IS NOT A FOLDER, AND ONLY IF IT IS A .php WE ACCESS IT
        if(is_dir($root.$path.$file) && $file != ".." && $file != "."){
            $apis[$file] = [];
            $apis[$file][$file] = "http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/";
            $apis = APIChildFolder($root,$path.$file."/",$file,$apis);
        }
    }
    // CLOSE THE DIRECTORY
    closedir($shared_models_dir);
    return $apis;
}
function APIChildFolder($root,$path,$api,$apis){
    //echo "<br><b>$root$path</b><br>";
    $shared_models_dir = opendir($root.$path);
    // LOOP OVER ALL OF THE  FILES    
    while ($file = readdir($shared_models_dir)) { 
        //echo "<br><i>$file</i> ".is_dir($root.$path.$file)."<br>";
        // IF IT IS NOT A FOLDER, AND ONLY IF IT IS A .php WE ACCESS IT
        if(is_dir($root.$path.$file) && $file != ".." && $file != "."){
            if($apis[$api][$file])
            $apis[$api][$file] = "http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/";
            $apis = APIChildFolder($root,$path.$file."/",$api."/".$file,$apis);
        }
    }
    // CLOSE THE DIRECTORY
    closedir($shared_models_dir);
    return $apis;
}


function LocalExtensions(){
    global $root_path;
    return ExtensionsFolder($root_path,"extensions/");
}

function ExtensionsFolder($root,$path){
    $extensions = [];
    //echo "<br><b>$root$path</b><br>";
    $shared_models_dir = opendir($root.$path);
    // LOOP OVER ALL OF THE  FILES    
    while ($file = readdir($shared_models_dir)) { 
        //echo "<br><i>$file</i> ".is_dir($root.$path.$file)."<br>";
        // IF IT IS NOT A FOLDER, AND ONLY IF IT IS A .php WE ACCESS IT
        if(is_dir($root.$path.$file) && is_dir($root.$path.$file."/api/info") && $file != ".." && $file != "."){
            $info = file_get_contents("http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/api/info");
            $data = json_decode($info,true);
            $extensions[$file] = $data['info'];
            if(is_file("$root$path$file/site.webmanifest")){
                $info = file_get_contents("$root$path$file/site.webmanifest");
                $data = json_decode($info);
                $extensions[$file]['name'] = $data->name;
            } else if(is_file("$root$path$file/manifest.json")){
                $info = file_get_contents("$root$path$file/manifest.json");
                $data = json_decode($info);
                $extensions[$file]['name'] = $data->name;
            } else {
                $extensions[$file]['error'] = "manifest missing";
            }
        
            $extensions[$file]['path'] = "http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/";
            $extensions[$file]['app_path'] = "http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/app";
            $extensions[$file]['api_path'] = "http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/api";
            if(is_dir($root.$path.$file."/api/info/details")){
                $info = file_get_contents("http://".$_SERVER['HTTP_HOST'].LoadSettingVar('extension_path').$path.$file."/api/info/details");
                $details = json_decode($info,true);
                $extensions[$file]['apis'] = $details['apis'];
            }
        }
    }
    // CLOSE THE DIRECTORY
    closedir($shared_models_dir);
    return $extensions;
}
?>