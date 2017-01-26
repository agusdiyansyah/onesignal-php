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
    // "include_player_ids" => array("57b4e40c-b5da-4468-a960-b7b06eebba3c"),
    "included_segments" => array("All"),
    "url" => "http://indobit.com",
    "android_led_color" => "#f44336"
);

$os->init($opt);
$os->notification($notifikasi)
->option($opsi)
->send()
->log()
?>

<!--
included_segments
    kirim ke semua player dengan segment yang sama
include_player_ids
    kirim ke semu aplayer yang terdaftar di player ids
-->
