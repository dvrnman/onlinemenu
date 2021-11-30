<?php

class Actions
{
    public PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function getCompanies(){
       return $this->excuteCommand("select * from sirketler");
    }

    public function getCategories(int $companyID){
        return $this->excuteCommand("select * from kategoriler where sirket_id=?",[$companyID]);
    }

    public function getProducts(int $categoryID){
        return $this->excuteCommand("select * from urunler where kategori_id=?",[$categoryID]);
    }

    public function excuteCommand(string $command,array $params=[]){
        $data = $this->database->prepare($command);
        $data->execute($params);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

}