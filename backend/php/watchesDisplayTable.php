<div class="p-2 mt-3">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>SN</th>
                <th>Photo</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Other Specifications</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                                $Wcount = 1;
                                $getWatchData = "SELECT * FROM watches";
                                $fetcheWatchData = $conn->query($getWatchData);
                                if($fetcheWatchData->num_rows>0){
                                    while($watchDetails = $fetcheWatchData->fetch_assoc()){
                                        $watchId = $watchDetails['Id'] ?>

            <tr>
                <td><?php echo $Wcount ?></td>
                <td><img src="<?php echo $watchDetails['photoPath'] ?>" alt="" class="img-fluid"
                        style="width: 8rem; height:6rem;"></td>
                <td><?php echo $watchDetails['brand'] ?></td>
                <td><?php echo $watchDetails['model'] ?></td>
                <td><?php echo $watchDetails['otherSpecs'] ?></td>
                <td><?php echo $watchDetails['wquantity'] ?></td>
                <td><?php echo $watchDetails['price'] ?></td>
                <td><button class="btn text-danger" onclick="confirmDelete(<?php echo (int)$watchId ?>, 'watches')"><i
                            class="fas fa-trash text-danger"></i></button></td>
            </tr>
            <?php $Wcount++; }
                                }
                                else{
                                    echo "<tr>";
                                    echo "<td colspan = '7'>No mobiles available right now!!!</td>";
                                    echo "</tr>";
                                }
                            ?>
        </tbody>
    </table>
</div>