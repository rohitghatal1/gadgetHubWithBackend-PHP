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
        <div class="watchDetails" id="<?php echo 'mobile-' . $mobileId; ?>">
            <button class="hideDetails" title="Hide Details"
                onclick="hideDetails('<?php echo 'mobile-' . $mobileId; ?>')"><i
                    class="fa-solid fa-angle-down"></i></button>
            <h2><?php echo $mobileInfo['brand']?></h2>
            <p><strong>Model:</strong> <span><?php echo $mobileInfo['model']?></span></p>
            <p><strong>Processor:</strong> <span><?php echo $mobileInfo['processor']?></span></p>
            <p><strong>RAM:</strong> <span><?php echo $mobileInfo['RAM']?></span></p>
            <p><strong>Storage:</strong> <span><?php echo $mobileInfo['storage']?></span></p>
            <p><strong>Quantity:</strong> <span><?php echo $mobileInfo['mquantity']?></span></p>
            <p><strong>Price:</strong> <span><?php echo $mobileInfo['price']?></span></p>
            <p><strong>Other Details:</strong> <span><?php echo $mobileInfo['otherSpecs']?></span></p>
            <button class="addToCartBtn" onclick="handleAddToCart(<?php echo (int)$mobileId; ?>, 'mobiles')">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
        </div>
    </div>
</div>
<?php }
}
?>