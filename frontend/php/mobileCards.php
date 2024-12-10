<?php 
$getMobiles = "SELECT * FROM mobiles";
$fetchedMobileData = $conn->query($getMobiles);
if($fetchedMobileData->num_rows > 0){
  while($mobileInfo = $fetchedMobileData->fetch_assoc()){
    $mobileId = $mobileInfo['Id'];
    ?>
<div class="swiper-slide">
    <div class="card">
        <figure class="productPhoto" style="height:25.2rem">
            <img src="<?php echo $mobileInfo['photoPath']?>" class="card-img-top" alt="Testimonial 1"
                style="height:100%">
        </figure>
        <div class="card-body">
            <h5 class="card-title"><?php echo $mobileInfo['brand']?></h5>
            <p class="card-text">Rs<?php echo $mobileInfo['price']?></p>
            <button class="showMoreDetails" title="Show Details" data-id="<?php echo $mobileId; ?>"
                data-category="mobiles" onclick="showItemDetails(this)">
                More Details
            </button>
        </div>
    </div>
</div>
<?php }
}
?>