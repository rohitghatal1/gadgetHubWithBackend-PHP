<?php 
                  $getLaptops = "SELECT * FROM laptops";
                  $fetchedLaptopData = $conn->query($getLaptops);
                  if($fetchedLaptopData->num_rows>0){
                    while($laptopInfo = $fetchedLaptopData->fetch_assoc()){
                      $laptopId = $laptopInfo['Id'];
                      ?>
                      <div class="swiper-slide">
                        <div class="card">
                          <figure class="productPhoto" style="height:25.2rem">
                            <img src="<?php echo $laptopInfo['photoPath']?>" class="card-img-top" alt="laptop image" style="height:100%">
                          </figure>
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $laptopInfo['brand']?></h5>
                            <p class="card-text">Rs<?php echo $laptopInfo['price']?></p>
                          </div>
                          <div class="watchDetails">
                            <h2><?php echo $laptopInfo['brand']?></h2>
                            <p><strong>Model:</strong> <span><?php echo $laptopInfo['model']?></span></p>
                            <p><strong>Processor:</strong> <span><?php echo $laptopInfo['processor']?></span></p>
                            <p><strong>RAM:</strong> <span><?php echo $laptopInfo['RAM']?></span></p>
                            <p><strong>Graphics:</strong> <span><?php echo $laptopInfo['graphics']?></span></p>
                            <p><strong>Price:</strong> <span><?php echo $laptopInfo['price']?></span></p>
                            <p><strong>Other Details:</strong> <span><?php echo $laptopInfo['otherSpecs']?></span></p>
                            <button class="addToCartBtn" onclick="handleAddToCart(<?php echo (int)$laptopId; ?>, 'laptops')"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      </div>
                    <?php }
                  }
                ?>