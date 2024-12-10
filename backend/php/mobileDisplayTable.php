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
                <th>Storage</th>
                <th>Other Specifications</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                                $Mcount = 1;
                                $getMobileData = "SELECT * FROM mobiles";
                                $fetchedMobileData = $conn->query($getMobileData);
                                if($fetchedMobileData->num_rows>0){
                                    while($mobilesDetails = $fetchedMobileData->fetch_assoc()){
                                        $mobileId = $mobilesDetails['Id']; ?>
            <tr>
                <td><?php echo $Mcount ?></td>
                <td><img src="<?php echo $mobilesDetails['photoPath'] ?>" alt="" class="img-fluid"
                        style="width: 8rem; height:7rem;"></td>
                <td><?php echo $mobilesDetails['brand'] ?></td>
                <td><?php echo $mobilesDetails['model'] ?></td>
                <td><?php echo $mobilesDetails['processor'] ?></td>
                <td><?php echo $mobilesDetails['RAM'] ?></td>
                <td><?php echo $mobilesDetails['storage'] ?></td>
                <td><?php echo $mobilesDetails['otherSpecs'] ?></td>
                <td><?php echo $mobilesDetails['quantity'] ?></td>
                <td><?php echo $mobilesDetails['price'] ?></td>
                <td><button class="btn text-danger" onclick="confirmDelete(<?php echo (int)$mobileId ?>, 'mobiles')"><i
                            class="fas fa-trash text-danger"></i></button></td>
            </tr>
            <?php $Mcount++; }    
                                }
                                else{
                                    echo "<tr>";
                                    echo "<td colspan = '10'>No mobiles available right now!!!</td>";
                                    echo "</tr>";
                                }
                            ?>
        </tbody>
    </table>
</div>