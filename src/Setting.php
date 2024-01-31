<?php

class Setting
{
    public static PDO $database;

    public string $username;
    public string $password;
    public string $host;
    public string $dbName;

    public function __construct($host, $dbName, $username, $password)
    {  //baglantı cümlesi
        if (!isset($this->database))
            self::$database = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    }


}