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

$opsi = array(
    // "segment" => array("All"),
    "playerId" => array(
        "7157462d-4375-47e5-ad54-d84b3a03a3f3", 
        "57b4e40c-b5da-4468-a960-b7b06eebba3c"
    )
);

$os
->init($opt)
->notification($notifikasi)
->option($opsi)
->send()
->log()
?>
