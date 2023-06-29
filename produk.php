<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css<?php echo time(); ?>">
<style>.home-allproducts .slide {
   position: relative;
   padding: 2rem;
   border-radius: .5rem;
   border: var(--border);
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   margin-bottom: 5rem;
   overflow: hidden;
   user-select: none;
   
}
.home-allproducts .slide .name {
   font-size: 2rem;
   color: var(--black);
}
.home-allproducts .slide .flex {
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap: 1rem;
}

.home-allproducts .slide .name {
   font-size: 2rem;
   color: var(--black);
}

.home-allproducts .slide .flex {
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap: 1rem;
}

.home-allproducts .slide .flex .qty {
   width: 7rem;
   padding: 1rem;
   border: var(--border);
   font-size: 1.8rem;
   color: var(--black);
   border-radius: .5rem;
}

.home-allproducts .slide .flex .price {
   margin: 1rem 0;
   font-size: 2rem;
   color: var(--red);
}

.home-allproducts .slide .fa-heart,
.home-allproducts .slide .fa-eye {
   position: absolute;
   top: 1rem;
   height: 4.5rem;
   width: 4.5rem;
   line-height: 4.2rem;
   font-size: 2rem;
   background-color: var(--white);
   border: var(--border);
   border-radius: .5rem;
   text-align: center;
   color: var(--black);
   cursor: pointer;
   transition: .2s linear;
}

.home-allproducts .slide .fa-heart {
   right: -6rem;
}

.home-allproducts .slide .fa-eye {
   left: -6rem;
}

.home-allproducts .slide .fa-heart:hover,
.home-allproducts .slide .fa-eye:hover {
   background-color: var(--black);
   color: var(--white);
}

.home-allproducts .slide:hover .fa-heart {
   right: 1rem;
}

.home-allproducts .slide:hover .fa-eye {
   left: 1rem;
}
</style>
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="home-allproducts">

<h1 class="heading">latest products</h1>

<div class="swiper products-slider">

<div class="swiper-wrapper">

<?php
  $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
  $select_products->execute();
  if($select_products->rowCount() > 0){
   while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
?>
<form action="" method="post" class="swiper-slide slide">
   <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
   <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
   <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
   <!-- <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button> -->
   <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
   <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
   <div class="name"><?= $fetch_product['name']; ?></div>
   <div class="flex">
      <div class="price"><span>Rp </span><?= $fetch_product['price']; ?></div>
      <!-- <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"> -->
   </div>
 
</form>
<?php
   }
}else{
   echo '<p class="empty">no products added yet!</p>';
}
?>

</div>

<div class="swiper-pagination"></div>

</div>

</section>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>