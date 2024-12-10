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
            <button class="showMoreDetails" title="Show Details" data-id="<?php echo $watchId; ?>"
                data-category="watches" onclick="showItemDetails(this)">
                More Details
            </button>
        </div>
    </div>
</div>
<?php }
}
?>