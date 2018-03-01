<?php
require_once 'mime.php';
require_once 'security.php';
$file = str_ireplace('/fileswap', '', $_SERVER['REQUEST_URI']);
$file = '.' . $file;
$file = str_ireplace([$_SERVER['QUERY_STRING'], '?'], ['', ''], $file);
if ($file != './' && $file != './index.php' && $file != './search.php' && $file != './upload.php' && $file != './upload.js') {
    if (file_exists($file)) {
        $olddir = dirname($file);
		header('Content-type:'.mime_content_type($file));
		echo stream_get_contents(decrypt_file($file,'&F%&B8ytyy6vtr6RV%RC[(ce65RE'));
        while (1) {
            $newdir = mt_rand(1, 10);
            if (str_ireplace('./', '', $olddir) != $newdir)
                break;
        }
		$newfile = str_ireplace($olddir, './' . $newdir, $file);
        rename($file, $newfile);
    }else {
        require_once './search.php';
        die("File not found!!");
    }
}
else if(strpos($file,'upload')){
    require_once $file;
}	
else {
    require_once './search.php';
}
?>