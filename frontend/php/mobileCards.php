<?php 
                  $getMobles = "SELECT * FROM mobiles";
                  $fetchedMobileData = $conn->query($getMobles);
                  if($fetchedMobileData->num_rows>0){
                    while($mobileInfo = $fetchedMobileData->fetch_assoc()){
                      $mobileId = $mobileInfo['MId'];
                      ?>
                      <div class="swiper-slide">
                        <div class="card">
                          <img src="<?php echo $mobileInfo['photoPath']?>" class="card-img-top" alt="Testimonial 1">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $mobileInfo['brand']?></h5>
                            <p class="card-text">Rs<?php echo $mobileInfo['Mprice']?></p>
                          </div>
                          <div class="watchDetails">
                            <h2><?php echo $mobileInfo['brand']?></h2>
                            <p><strong>Model:</strong> <span><?php echo $mobileInfo['model']?></span></p>
                            <p><strong>Processor:</strong> <span><?php echo $mobileInfo['processor']?></span></p>
                            <p><strong>RAM:</strong> <span><?php echo $mobileInfo['RAM']?></span></p>
                            <p><strong>Storage:</strong> <span><?php echo $mobileInfo['storage']?></span></p>
                            <p><strong>Price:</strong> <span><?php echo $mobileInfo['Mprice']?></span></p>
                            <p><strong>Other Details:</strong> <span><?php echo $mobileInfo['otherSpecs']?></span></p>
                            <button class="addToCartBtn" onclick='handleAddToCart(<?php echo json_encode($mobileId); ?>)'><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      </div>
                    <?php }
                  }
                ?>