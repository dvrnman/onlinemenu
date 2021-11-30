<?php
include_once "session_start.php";
ob_start();
require_once "baglan.php";

$baglan = $db->prepare("select  * from kategoriler ");
$baglan->execute();
$goster = $baglan->fetchAll(PDO::FETCH_ASSOC);

$baglan = $db->prepare("SELECT * FROM sirketler INNER JOIN  kategoriler ON sirketler.id = kategoriler.sirket_id  ");
$baglan->execute();
$listele = $baglan->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["sil"])) {
    $ekle = $db->prepare("delete from kategoriler where id =? ");
    $ekle->execute(
        [
            $_POST["sil"]
        ]
    );
    header("Location:kategoriekle.php");
    exit;
}


if (isset($_POST["ekleme"])) {

    $resim = $_FILES['dosya']['name'];

    $dosyadizin = "images";

    if (isset($_FILES['dosya'])) {

        $yol = "images/";
        $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["dosya"]["name"];

        $sonuc = move_uploaded_file($_FILES["dosya"]["tmp_name"], $yuklemeYeri);


        $ekle = $db->prepare("insert into kategoriler set  sirket_id= ?,kategori_isim =?, resim_url=? ");

        $ekle->execute(
            [
                $_POST["sirketid"],
                $_POST["kategori_isim"],
                $resim
            ]
        );
        header("Location:kategoriekle.php");
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
        $ekle = $db->prepare("UPDATE  kategoriler set  kategori_isim =? , resim_url=?  WHERE id =?");
        $ekle->execute([
            $_POST["kategori_isim"],
            strlen($resim) > 0 ? $resim : $goster[0]["resim"],
            $_POST["id"]
        ]);
    } else {
        $ekle = $db->prepare("UPDATE  kategoriler set  kategori_isim =? WHERE id =?");
        $ekle->execute([
            $_POST["kategori_isim"],
            $_POST["id"]
        ]);
    }

    header("Location:kategoriekle.php");
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
        ´
        <div class="col-12 mb-5 col-md-12 col-sm-12">
            <table class="table  table-hover  table-dark   table-bordered">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ŞİRKET ID</th>
                    <th scope="col">KATEGORİ İSİM</th>
                    <th scope="col">RESİM URL</th>
                    <th scope="col">RESİM URL</th>
                </tr>
                </thead>
                <tbody>
                <form action="" method="post">
                    <?php foreach ($listele as $items) : ?>
                        <tr>
                            <th scope="row"><?= $items["id"] ?></th>
                            <td class="text-center"><?= $items["sirket_id"] . "<br>" . "(" . $items["isim"] . ")" ?></td>
                            <td class="text-center"><?= $items["kategori_isim"] ?></td>
                            <td class="text-center"><?= $items["resim_url"] ?></td>
                            <td class="text-center">
                                <button name="sil" type="submit" class="btn btn-danger" value="<?= $items["id"] ?>">SİL
                                </button>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </form>
                </tbody>
            </table>
        </div>
        <div class="col-6 col-sm-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-5 ">
                    <h6 class="display-6 mb-5">Restoranlara Kategori Ekle</h6>
                    <label for="floatingInputValue" class="mb-2">ŞİRKET ID</label>
                    <div class="input-group mb-3">
                        <input name="sirketid" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <label for="floatingInputValue" class="mb-2">KATEGORİ İSİM</label>
                    <div class="input-group mb-3">
                        <input name="kategori_isim" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div>
                        <label for="myfile">Resmi Seçiniz:</label>
                        <input type="file" id="myfile" name="dosya"><br><br>
                    </div>
                    <input type="hidden" name="ekleme">
                    <button type="submit" class="btn btn-primary">KATEGORİ EKLE</button>
                </div>
            </form>

        </div>
        <div class="col-6 col-sm-6">
            <form action="" method="post" enctype="multipart/form-data">

                <h6 class="display-6 mb-5 ">Restoranlara Kategori Güncelleme</h6>
                <label for="floatingInputValue" class="mb-2"> ID</label>
                <div class="input-group mb-3">
                    <input name="id" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <label for="floatingInputValue" class="mb-2">KATEGORİ İSİM</label>
                <div class="input-group mb-3">
                    <input name="kategori_isim" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div>
                    <label for="myfile">Resmi Seçiniz:</label>
                    <input type="file" id="myfile" name="dosya"><br><br>
                </div>
                <button name="guncelleme" type="submit" value="1" class="btn btn-primary">KATEGORİ GÜNCELLE</button>
            </form>


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