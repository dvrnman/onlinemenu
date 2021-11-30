<div class="container">
    <div class="row row-cols-2">

        <?php foreach ($products as $product){ ?>
            <div class="col mb-3 ">
                <div class="card bg-dark shadow">
                    <img src="<?="admin/urunimages/".$product["resim_url"]?>" class="card-img-top border-none" alt="...">
                    <div class="card-body p-2">
                        <p class="cards-title text-white"><?php echo $product['urun_isim']; ?></p>
                        <h2 class="text-white"><?php echo $product['fiyat'] ." "."TL"; ?></h2>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>