<?php
require __DIR__ . '/src/Setting.php';
require __DIR__ . '/src/Actions.php';
$setting = new Setting("localhost","u8281480_onlinemenu","u8281480_root","ksYCTX&It-{t");
$actions = new Actions($setting::$database);

$companyID = $_GET['sirket_id'] ?? $_COOKIE['sirket_id'] ?? null;
$categoryID = $_GET['kategori_id'] ?? null;

include __DIR__ . '/templates/header.php';
if (isset($companyID) && !isset($categoryID)){
    setcookie('sirket_id',$companyID);
    $categories = $actions->getCategories($companyID);
    include __DIR__ . '/templates/sections/categories.php';
}
if (isset($categoryID)){
    $products = $actions->getProducts($categoryID);
    include __DIR__ . '/templates/sections/products.php';
}


include __DIR__.'/templates/footer.php';