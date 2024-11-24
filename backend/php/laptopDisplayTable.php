<div class="p-2 mt-3">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>SN</th>
                <th>Photo</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Processor</th>
                <th>RAM</th>
                <th>Graphics</th>
                <th>Other Specifications</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                            $lQuantity = 1;
                                $getLaptopData = "SELECT * FROM laptops";
                                $fetchedLaptopData = $conn->query($getLaptopData);
                                if($fetchedLaptopData->num_rows>0){
                                    while($laptopDetails = $fetchedLaptopData->fetch_assoc()){ 
                                        $laptopId = $laptopDetails['Id']?>
            <tr>
                <td><?php echo $sn ?></td>
                <td><img src="<?php echo $laptopDetails['photoPath']?>" alt="" class="img-fluid"
                        style="width: 8rem; height:7rem;"></td>
                <td><?php echo $laptopDetails['brand'] ?></td>
                <td><?php echo $laptopDetails['model'] ?></td>
                <td><?php echo $laptopDetails['processor'] ?></td>
                <td><?php echo $laptopDetails['RAM'] ?></td>
                <td><?php echo $laptopDetails['graphics'] ?></td>
                <td><?php echo $laptopDetails['otherSpecs'] ?></td>
                <td><?php echo $laptopDetails['lquantity'] ?></td>
                <td><?php echo $laptopDetails['price'] ?></td>
                <td><button class="btn text-danger" onclick="confirmDelete(<?php echo (int)$laptopId ?>, 'laptops')"><i
                            class="fas fa-trash text-danger"></i></button></td>
            </tr>
            <?php $lQuantity++} 
                                } 
                                else{
                                    echo "<tr>";
                                    echo "<td colspan = '10'>No laptops available right now!!!</td>";
                                    echo "</tr>";
                                }
                            ?>
        </tbody>
    </table>
</div>