<?php
require_once 'security.php';
if ($_POST) {
	echo 'sdf';
    $keys = array_keys($_FILES);
    foreach ($_FILES as $file) {
        if ($file['error'] > 0) {
            die('An error ocurred when uploading.');
        }

        if (!getimagesize($file['tmp_name'])) {
            die('Please ensure you are uploading an image.');
        }

        if ($file['type'] != 'image/png' && $file['type'] != 'image/jpeg') {
            die('Unsupported filetype uploaded.');
        }

        if ($file['size'] > 50000000) {
            die('File uploaded exceeds maximum upload size.');
        }
        $name = $file['name'];
		
		$it = new RecursiveDirectoryIterator("./");
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (strpos(strtolower($file), strtolower($name)) !== FALSE && (substr($file,-1) != '.')) {
            die('File with that name already exists.');
        }
    }
	
        $newdir = mt_rand(1, 10);
		$fileloc = './' . $newdir.'/'.$name;
        if (!move_uploaded_file($file['tmp_name'], $fileloc)) {
            die('Error uploading file - check destination is writeable.');
        }
		else{
			encrypt_file($fileloc,$fileloc,"&F%&B8ytyy6vtr6RV%RC[(ce65RE");
			die('File uploaded successfully.');
		}
    }
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>File upload</title>
    <style>
    .container {
        width: 500px;
        margin: 0 auto;
    }
    .progress_outer {
        border: 1px solid #000;
    }
    .progress {
        width: 0%;
        background: #DEDEDE;
        height: 20px;  
    }
    </style>
</head>
<body>
    <div class='container'>
        <p>
            Select File: <input type='file' name="fil" id='_file' multiple> 
            <input type='button' id='_submit' value='Upload!'>
        </p>
        <div class='progress_outer'>
            <div id='_progress' class='progress'></div>
        </div>
    </div>
    <script src='upload.js'></script>
</body>
</html>