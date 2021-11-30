<?php
include_once "session_start.php";
ob_start();
require_once "baglan.php";


$baglan = $db->prepare("SELECT * FROM urunler INNER JOIN  sirketler ON sirketler.id = urunler.sirket_id  ");
$baglan->execute();
$listele = $baglan->fetchAll(PDO::FETCH_ASSOC);

$baglan = $db->prepare("SELECT * FROM sirketler INNER JOIN  kategoriler ON sirketler.id = kategoriler.sirket_id  ");
$baglan->execute();
$listele2 = $baglan->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST["sil"])) {
    $ekle = $db->prepare("delete from urunler where id =? ");
    $ekle->execute(
        [
            $_POST["sil"]
        ]
    );
    header("Location:urun_ekle.php");
    exit;
}

if (isset($_POST["urunekle"])) {

    if (isset($_FILES['dosya'])) {
        $resim = $_FILES['dosya']['name'];
        $dosyadizin = "images";
        $yol = "urunimages/";
        $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["dosya"]["name"];

        $sonuc = move_uploaded_file($_FILES["dosya"]["tmp_name"], $yuklemeYeri);


        $ekle = $db->prepare("insert into urunler set  kategori_id= ?,sirket_id =?, urun_isim=?,resim_url=?,fiyat=? ");

        $ekle->execute(
            [
                $_POST["kategoriid"],
                $_POST["sirketid"],
                $_POST["urunisim"],
                $resim,
                $_POST["fiyat"]


            ]
        );
        header("Location:urun_ekle.php");
        exit;
    }
}
if (isset($_POST["guncelleme"])) {

    $resim = $_FILES['dosya']['name'];

    $dosyadizin = "images";



    if (strlen($resim) > 0) {
        $yol = "images/";
        $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["dosya"]["name"];
        $sonuc = move_uploaded_file($_FILES["dosya"]["tmp_name"], $yuklemeYeri);
        $ekle = $db->prepare("UPDATE  urunler set  kategori_id= ?,sirket_id =?, urun_isim=?,resim_url=?,fiyat=? WHERE id=?");
        $ekle->execute([
            $_POST["kategoriid"],
            $_POST["sirketid"],
            $_POST["urunisim"],
            strlen($resim) > 0 ? $resim : $goster[0]["resim"],
            $_POST["fiyat"],
            $_POST["id"]
        ]);
    }else{
        $ekle = $db->prepare("UPDATE  urunler set  kategori_id= ?,sirket_id =?, urun_isim=?,fiyat=? WHERE id=?");
        $ekle->execute([
            $_POST["kategoriid"],
            $_POST["sirketid"],
            $_POST["urunisim"],
            $_POST["fiyat"],
            $_POST["id"]
        ]);
    }

    header("Location:urun_ekle.php");
    exit();
}


?>


<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>KATEGORİ EKLE </title>
</head>

<body>
<?php include_once "src/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h6 class="display-6">ÜRÜN TABLOSU </h6>
            <table class="table table-hover  table-dark   table-bordered">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">KATEGORI ID</th>
                    <th scope="col">SIRKET ID</th>
                    <th scope="col">URUN ISIM</th>
                    <th scope="col">RESİM URL</th>
                    <th scope="col">FIYAT</th>
                    <th scope="col"></th>

                </tr>
                </thead>
                <form action="" method="post">
                <?php foreach ($listele as $item)  : ?>
                    <tbody>
                    <tr>
                        <th scope="row"><?= $item["id"] ?></th>
                        <td><?= $item["kategori_id"] ?></td>
                        <td><?= $item["sirket_id"] ."<br>"."(".$item["isim"].")" ?></td>
                        <td><?= $item["urun_isim"] ?></td>
                        <td><?= $item["resim_url"] ?></td>
                        <td><?= $item["fiyat"] ?></td>
                        <td>
                            <button name="sil" type="submit" class="btn btn-danger" value="<?= $item["id"] ?>">SİL
                            </button>
                        </td>
                    </tr>
                    </tbody>
                <?php endforeach; ?>
                </form>
            </table>
            <bold><hr class="container"></bold>
        </div>
        <div class="col-12">
            <h6 class="display-6">KATEGORİLER  </h6>
            <table class="table table-hover  table-dark   table-bordered">
                <thead>
                <tr>
                    <th scope="col">KATEGORI ID - KATEGORI İSİM</th>
                    <th scope="col">SİRKET ID - SİRKET İSMİ</th>



                </tr>
                </thead>

                    <?php foreach ($listele2 as $item)  : ?>
                        <tbody>
                        <tr>
                            <th scope="row"><?= $item["id"] ."<br>" . $item["kategori_isim"] ?></th>

                            <td><?= $item["sirket_id"] ."<br>"."(".$item["isim"].")" ?></td>


                        </tr>
                        </tbody>
                    <?php endforeach; ?>
                </form>
            </table>
        </div>

    </div>
</div>

<div class="container mt-5">
    <!--  Ürün ekleme-->
    <div class="row">
        <div class="col-5">
            <form action="" method="post" enctype="multipart/form-data">
                <h6 class="display-6 mb-5 ">Ürün Ekle</h6>
                <label for="floatingInputValue" class="mb-2">KATEGORİ ID</label>
                <div class="input-group mb-3">
                    <input name="kategoriid" type="text" class="form-control" placeholder="" aria-label="Username"
                           aria-describedby="basic-addon1">
                </div>
                <label for="floatingInputValue" class="mb-2">SİRKET ID</label>
                <div class="input-group mb-3">
                    <input name="sirketid" type="text" class="form-control" placeholder="" aria-label="Username"
                           aria-describedby="basic-addon1">
                </div>
                <label for="floatingInputValue" class="mb-2">ÜRÜN İSİM</label>
                <div class="input-group mb-3">
                    <input name="urunisim" type="text" class="form-control" placeholder="" aria-label="Username"
                           aria-describedby="basic-addon1">
                </div>
                <label for="floatingInputValue" class="mb-2">RESİM</label>
                <div>
                    <label for="myfile">Resmi Seçiniz:</label>
                    <input type="file" id="myfile" name="dosya"><br><br>
                </div>
                <label for="floatingInputValue" class="mb-2">FIYAT </label>
                <div class="input-group mb-3">
                    <input name="fiyat" type="text" class="form-control" placeholder="" aria-label="Username"
                           aria-describedby="basic-addon1">
                </div>
                <input type="hidden" class="" value="1" name="urunekle">
                <button name="urunkle" type="submit" value="1" class="btn btn-primary">ÜRÜN EKLE</button>
            </form>

        </div>
        <div class="col-2"></div>
        <div class="col-5">
            <!--  Ürün guncelleme-->
            <form action="" method="post" enctype="multipart/form-data">
            <h6 class="display-6 mb-5 ">Ürün Güncelleme</h6>
            <label for="floatingInputValue" class="mb-2">ÜRÜN ID</label>
            <div class="input-group mb-3">
                <input name="id" type="text" class="form-control" placeholder="" aria-label="Username"
                       aria-describedby="basic-addon1">
            </div>
            <label for="floatingInputValue" class="mb-2">KATEGORİ ID</label>
            <div class="input-group mb-3">
                <input name="kategoriid" type="text" class="form-control" placeholder="" aria-label="Username"
                       aria-describedby="basic-addon1">
            </div>
            <label for="floatingInputValue" class="mb-2">SİRKET ID</label>
            <div class="input-group mb-3">
                <input name="sirketid" type="text" class="form-control" placeholder="" aria-label="Username"
                       aria-describedby="basic-addon1">
            </div>
            <label for="floatingInputValue" class="mb-2">ÜRÜN İSİM</label>
            <div class="input-group mb-3">
                <input name="urunisim" type="text" class="form-control" placeholder="" aria-label="Username"
                       aria-describedby="basic-addon1">
            </div>
            <label for="floatingInputValue" class="mb-2">RESİM URL</label>

            <div>
                <label for="myfile">Resmi Seçiniz:</label>
                <input type="file" id="myfile" name="dosya"><br><br>
            </div>
            <label for="floatingInputValue" class="mb-2">FIYAT </label>
            <div class="input-group mb-3">
                <input name="fiyat" type="text" class="form-control" placeholder="" aria-label="Username"
                       aria-describedby="basic-addon1">
            </div>
            <button name="guncelleme" type="submit" value="1" class="btn btn-primary">ÜRÜN GÜNCELLE</button>
            </form>
        </div>
    </div>
</div>


</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>

</html>