<?php

$query = empty($argv[1]) ? '' : $argv[1];

function uuid_create(){
    $str = md5(uniqid(mt_rand(), true));   
    $uuid  = substr($str,0,8) . '-';   
    $uuid .= substr($str,8,4) . '-';   
    $uuid .= substr($str,12,4) . '-';   
    $uuid .= substr($str,16,4) . '-';   
    $uuid .= substr($str,20,12);   
    return $uuid;
}

switch ($query) {
	case '-':
		$uuid = uuid_create();
		break;
	case '-u':
	case 'u-':
		$uuid = strtoupper(uuid_create());
		break;
	case 'u':
		$uuid = strtoupper(str_replace('-', '', uuid_create()));
		break;
	default:
		$uuid = str_replace('-', '', uuid_create());
		
}

echo '<?xml version="1.0" encoding="utf-8"?>
<items>
    <item valid="yes" arg="'.$uuid.'">
        <title>'.$uuid.'</title>
        <subtitle></subtitle>
        <icon></icon>
    </item>
</items>';

?>