<?php
require_once("../../includes/main.php");
$data = [
	'info' => [
		'url' => $_SERVER['HTTP_HOST'],
		'type' => LoadSettingVar('server_type'),
		'main' => LoadSettingVar('server_main'),
		'server' => LoadSettingVar('server'),
		'mac_address' => LocalMacAddress(),
		'name' => LoadSettingVar('server_name')
		]
	];
OutputJson($data);
?>
