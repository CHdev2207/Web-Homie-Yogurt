<?php

// เชื่อมต่อไปหน้า footer.php ให้มาแสดงผล
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- ทำหน้าสไล์รูปภาพ ด้วยโค้ดWeb CDN -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- เชื่อมต่อไปหน้า user_header.php ให้มาแสดงผล -->
<?php include 'components/user_header.php'; ?>



<section class="hero">

<!-- ทำหน้าสไล์รูปภาพ ด้วยโค้ดWeb CDN -->
   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

      <!-- กำหนดเนื้อหารุปภาพเมนูเเนะนำ 1 -->
         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>fresh yogurt</h3>
               <a href="menu.html" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-1.jpeg" alt="">
            </div>
         </div>

         <!-- กำหนดเนื้อหารุปภาพเมนูเเนะนำ 2 -->
         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>Smoothie Yogurt</h3>
               <a href="menu.html" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-2.JPG" alt="">
            </div>
         </div>

         <!-- กำหนดเนื้อหารุปภาพเมนูเเนะนำ 3 -->
         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>Yogurt ice cream</h3>
               <a href="menu.html" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-3.jpeg" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- ทำเมนู MENU CATEGORY -->
<section class="category">

   <h1 class="title">Menu category</h1>

   <div class="box-container">

      <a href="category.php?category=Fresh Yogurt" class="box">
         <img src="images/cat-1.png" alt="">
         <h3>Fresh Yogurt</h3>
      </a>

      <a href="category.php?category=Smoothie Yogurt" class="box">
         <img src="images/cat-2.png" alt="">
         <h3>Smoothie Yogurt</h3>
      </a>

      <a href="category.php?category=Yogurt ice cream" class="box">
         <img src="images/cat-3.png" alt="">
         <h3>Yogurt ice cream</h3>
      </a>

      <a href="category.php?category=New menu" class="box">
         <img src="images/cat-4.png" alt="">
         <h3>New menu</h3>
      </a>

   </div>

</section>




<section class="products">
   
<!-- ฟังชั่น Popular menu -->
   <h1 class="title">Popular menu</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

      <!-- ส่วนเพิ่ม add menu ลงเว็บ -->
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>"
         class="image" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>฿</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">There are no additional menus yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.html" class="btn">veiw all</a>
   </div>

</section>
















<!-- ดึงข้อมูลเนื้อหาหน้า Foodter มาแสดงผล -->
<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<!-- ทำหน้าสไล์รูปภาพ ด้วยโค้ดWeb CDN -->
<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>