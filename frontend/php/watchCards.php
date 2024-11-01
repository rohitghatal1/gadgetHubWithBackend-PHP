<?php 
$getWatches = "SELECT * FROM watches";
$fetchedWatchData = $conn->query($getWatches);
if($fetchedWatchData->num_rows > 0){
  while($watchInfo = $fetchedWatchData->fetch_assoc()){
    $watchId = $watchInfo['Id'];
    ?>
    <div class="swiper-slide">
      <div class="card">
        <figure class="productPhoto" style="height:25.2rem">
          <img src="<?php echo $watchInfo['photoPath']?>" class="card-img-top" alt="Watch Image" style="height:100%;">
        </figure>
        <div class="card-body">
          <h5 class="card-title"><?php echo $watchInfo['brand']?></h5>
          <p class="card-text">Rs<?php echo $watchInfo['price']?></p>
          <button class="showMoreDetails" title="Show Details" onclick="showMoreDetails('<?php echo 'details-' . $watchId; ?>')">
            <i class="fa-solid fa-angle-up"></i>
          </button>
        </div>
        <div class="watchDetails" id="<?php echo 'details-' . $watchId; ?>">
          <button class="hideDetails" title="Hide Details" onclick="hideDetails('<?php echo 'details-' . $watchId; ?>')"><i class="fa-solid fa-angle-down"></i></button>
          <h2><?php echo $watchInfo['brand']?></h2>
          <p><strong>Model:</strong> <span><?php echo $watchInfo['model']?></span></p>
          <p><strong>Price:</strong> <span><?php echo $watchInfo['price']?></span></p>
          <p><strong>Other Details:</strong> <span><?php echo $watchInfo['otherSpecs']?></span></p>
          <button class="addToCartBtn" onclick="handleAddToCart(<?php echo (int)$watchId; ?>, 'watches')">
            <i class="fas fa-shopping-cart"></i> Add to Cart
          </button>
        </div>
      </div>
    </div>
  <?php }
}
?>
