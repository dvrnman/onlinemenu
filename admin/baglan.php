<?php
ob_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=u8281480_onlinemenu;", "u8281480_root", "ksYCTX&It-{t");
    $db->exec("SET NAMES 'utf8'");
    $db->exec("SET CHARACTER SET 'utf8'");
    /*
                    $db = new PDO("mysql:host=localhost;dbname=u8102804_renaultcu;", "u8102804_shop", "2Xc3DREZi1me");
                    $db->exec("SET NAMES 'utf8'");
                    $db->exec("SET CHARACTER SET 'utf8'");

/*
     $db = new PDO("mysql:host=localhost;dbname=u8102804_renaultcu;", "root", "");
     $db->exec("SET NAMES 'utf8'");
     $db->exec("SET CHARACTER SET 'utf8'");
     */
} catch (PDOException $e) {
    print $e->getMessage();
}
