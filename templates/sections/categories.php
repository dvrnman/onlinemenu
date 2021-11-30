
<div class="container">
    <div class="row row-cols-2">

        <?php foreach ($categories as $category){ ?>
        <div class="col mb-3">
           <a href="/index.php?kategori_id=<?php echo $category['id']; ?>">
               <div class="card bg-dark shadow">
                   <img src="<?="admin/images/".$category["resim_url"]?>" class="card-img-top" alt="...">
                   <div class="card-body p-2">
                       <p class="card-title text-white "><?php echo $category['kategori_isim']; ?></p>
                   </div>
               </div>
           </a>
        </div>
        <?php } ?>

    </div>
</div>