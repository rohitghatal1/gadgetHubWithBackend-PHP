<?php 
$getLaptops = "SELECT * FROM laptops";
$fetchedLaptopData = $conn->query($getLaptops);
if($fetchedLaptopData->num_rows > 0){
  while($laptopInfo = $fetchedLaptopData->fetch_assoc()){
    $laptopId = $laptopInfo['Id'];
    ?>
<div class="swiper-slide">
    <div class="card">
        <figure class="productPhoto" style="height:22.2rem">
            <img src="<?php echo $laptopInfo['photoPath']?>" class="card-img-top" alt="laptop image"
                style="height:100%">
        </figure>
        <div class="card-body" style="height:8.7rem">
            <h5 class="card-title mt-3"><?php echo $laptopInfo['brand']?></h5>
            <p class="card-text mt-3">Rs<?php echo $laptopInfo['price']?></p>
            <button class="showMoreDetails" title="Show Details" data-id="<?php echo $laptopId; ?>"
                data-category="laptops" onclick="showItemDetails(this)">
                More Details
            </button>
        </div>
    </div>
</div>
<?php }
}
?>