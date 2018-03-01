<?php
$searched = false;
$sfile='';
$filename='';
$found=FALSE;
if (@$_GET && $_GET['filename'] != '') {
	$searched = true;
    $sfile = filter_input(INPUT_GET, 'filename');
    $it = new RecursiveDirectoryIterator("./");
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (strpos(strtolower($file), strtolower($sfile)) !== FALSE && (substr($file,-1) != '.')) {
            $found = true;
            $filename[] .= $file;
        }
    }
}
?>
<html>
    <head>
        <title>Search</title>
    </head>
    <body>
        <form action="/fileswap/search.php" method="GET">
            Filename: <input type="text" name="filename"><input type="submit" value="Search">
        </form>
        <br><br>
        <?php
        if ($searched) {
			if($found){
				foreach ($filename as $fil){
					echo '<br>File Location:<a href="/fileswap/' . str_ireplace('./', '', $fil) . '">' . $fil . '</a>';
				}
			}
			else{
				echo 'Searched file not found.';
			}
        }
        ?>

    </body>
</html>