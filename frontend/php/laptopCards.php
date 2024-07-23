<?php 
                  $getLaptops = "SELECT * FROM laptops";
                  $fetchedLaptopData = $conn->query($getLaptops);
                  if($fetchedLaptopData->num_rows>0){
                    while($laptopInfo = $fetchedLaptopData->fetch_assoc()){
                      $laptopId = $laptopInfo['LId'];
                      ?>
                      <div class="swiper-slide">
                        <div class="card">
                          <img src="<?php echo $laptopInfo['photoPath']?>" class="card-img-top" alt="laptop image">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $laptopInfo['brand']?></h5>
                            <p class="card-text">Rs<?php echo $laptopInfo['Lprice']?></p>
                          </div>
                          <div class="watchDetails">
                            <h2><?php echo $laptopInfo['brand']?></h2>
                            <p><strong>Model:</strong> <span><?php echo $laptopInfo['model']?></span></p>
                            <p><strong>Processor:</strong> <span><?php echo $laptopInfo['processor']?></span></p>
                            <p><strong>RAM:</strong> <span><?php echo $laptopInfo['RAM']?></span></p>
                            <p><strong>Graphics:</strong> <span><?php echo $laptopInfo['graphics']?></span></p>
                            <p><strong>Price:</strong> <span><?php echo $laptopInfo['Lprice']?></span></p>
                            <p><strong>Other Details:</strong> <span><?php echo $laptopInfo['otherSpecs']?></span></p>
                            <button class="addToCartBtn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      </div>
                    <?php }
                  }
                ?>