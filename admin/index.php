<?php
session_start();
if (!isset($_SESSION)) {
    header("Location:index.php");
    exit();
}



if ($_POST) {
    $kullanici_adi = isset($_POST["kullanici_adi"]) ? $_POST["kullanici_adi"] : null;
    $sifre = isset($_POST["sifre"]) ? $_POST["sifre"] : null;

   if($kullanici_adi == "admin" && $sifre == "451236") {

       $_SESSION["kullanici_adi"] = 1;
       if (isset($_SESSION["kullanici_adi"])) {

       }
       header("Location:restoran_ekle.php");
       exit();
   }

   }
       else
       {
           $hata = "Hatalı şifre  Girdiniz !";
       }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="giris.css">
    <link rel="stylesheet" href="style.css">
    <title>Destek Talep</title>
</head>
<body class="text-center">
<form class="form-signin" method="post">

    <br><br>
    <h2 class="h3 mb-3 font-weight-normal girisyap"> Giriş Yapınız</h2>

    <label for="inputEmail" class="sr-only"></label>
    <input name="kullanici_adi" type="text" id="inputEmail" class="form-control" placeholder="E-Mail" required autofocus>
    <label for="inputPassword" class="sr-only"></label>
    <input name="sifre" type="password" id="inputPassword" class="form-control" placeholder="Şifre" required>
    <div class=" mb-3">
        <label>
        </label>
    </div>



    <input type="hidden" name="submit" value="1" >

    <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
    <br><br>


    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
</form>
</body>
</html>