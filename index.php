<?php
include "./OneSignal_lib.php";
$os = new OneSignal();

$opt = array(
    "appId" => "3c43fcf7-e1a9-4540-a9b4-0f717a39d71a",
    "restApiKey" => "OTgxYmY4Y2MtMzI3Yy00ZDU0LWFkYjctZDk4MjI0YTRmNzg1",
);

$notifikasi = array(
    "title" => array(
        "en" => "title"
    ),
    "content" => array(
        "en" => "pesan langsung"
    ),
);

$os
->init($opt)
->send($notifikasi)
->log()
?>
