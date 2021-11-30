<?php
include_once "session_start.php";
require_once  "baglan.php";


$baglan = $db->prepare("select * from sirketler");
$baglan->execute();
$goster = $baglan->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["ekle"])) {


    $ekle = $db->prepare("insert into sirketler set isim = ? ");
    $ekle->execute(
        [
            $_POST["ekle"]
        ]
    );
    header("Location:restoran_ekle.php");
    exit;
}

if (isset($_POST["sil"])) {


    $ekle = $db->prepare("delete from sirketler where id =? ");
    $ekle->execute(
        [
            $_POST["sil"]
        ]
    );
    header("Location:restoran_ekle.php");
    exit;
}
if (isset($_POST["duzenle"])) {
    print_r($_POST);

    $ekle = $db->prepare("UPDATE  sirketler   set  isim = ?   WHERE id = ? ");
    $ekle->execute(
        [

            $_POST["isim"],
            $_POST["id"]
        ]
    );
    header("Location:restoran_ekle.php");
    exit;
}




?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php include "src/header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <form action="" method="post">
                    <div class="mb-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input name="ekle" type="text" class="form-control w-50" placeholder="Restoran İsmi" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <button type="submit" class="btn btn-primary ">Restoran Ekle</button>
                    </div>


                </form>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">

                            <select name="id" class="form-select" id="inputGroupSelect01">

                                <?php foreach ($goster as $item) : ?>
                                    <option value="<?= $item["id"] ?>"><?= $item["id"] ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <span class="input-group-text">@</span>
                        <input name="isim" type="text" class="form-control" placeholder="RESTORAN İSMİ" aria-label="Server">

                    </div>
                    <button name="duzenle" type="submit" class="btn btn-info" value="1">DÜZENLE</button>
                </form>


            </div>




            <div class="col-2"></div>
            <div class="col-6">
                <table class="table table-hover  table-dark   table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">RESTORANLAR </th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($goster  as $item) :  ?>
                            <form action="" method="post">
                                <tr>
                                    <th scope="row"><?= $item["id"] ?></th>
                                    <td><?= $item["isim"] ?></td>
                                    <td>
                                        <button name="sil" type="submit" class="btn btn-danger" value="<?= $item["id"] ?>">SİL</button>
                                    </td>

                                </tr>
                            </form>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>