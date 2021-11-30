<?php
require __DIR__ . '/src/Setting.php';
require __DIR__ . '/src/Actions.php';
$setting = new Setting("localhost","onlınemenu2","root","ksYCTX&It-{t");
$actions = new Actions($setting::$database);
$sirket_id = $_GET['sirket_id'];

include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/sections/categories.php';
include __DIR__.'/templates/footer.php';