<?php

$query = empty($argv[1]) ? '' : $argv[1];

function uuid_create(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    $str = vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));   
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
