<?php

$publicHash = '3533d0b4bb15f9c660cd69653f6bce52b67936aa403b38b0ec854f72937dee12';
$privateHash = '8994b2e6fbcc4698ab8b91125d046b378b0216ab70e2edd9b7f0e7042dbca3eb';

$REQUEST_METHOD = 'get';
$REQUEST_URI = '/api/v1/contacts?name=Thuan';

$data = array("name" => "Thuan2", "phone" => "0123456789", "notes" => "CTU", "user_id" => "3");
$data = json_encode($data);
// $content = strtolower($REQUEST_METHOD . $REQUEST_URI . $data);
$content = strtolower($REQUEST_METHOD . $REQUEST_URI);

$hash = hash_hmac('sha256', $content, $privateHash);

echo $hash;
