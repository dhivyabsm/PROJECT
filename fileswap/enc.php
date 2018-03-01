<?php

require_once 'security.php';
$file = "./4/Desert.jpg";
if(encrypt_file($file,$file.'.enc','qwerty'))
	echo 'Done';