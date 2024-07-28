<div class="salesTable container">
                <h3 class="text-light hFont py-1">Total Sales</h3>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-font">
                            <th>SN</th>
                            <th>Item Type</th>
                            <th>Item Brand</th>
                            <th>Item Model</th>
                            <th>Item Price</th>
                            <th>Sold Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $salesData = "SELECT * FROM sales";
                        $fetchedSalesData = $conn->query($salesData);
                        $Scount = 1;
                        if($fetchedSalesData->num_rows>0){
                            while($salesInfo = $fetchedSalesData->fetch_assoc()){
                                ?>
                            <tr>
                                <td><?php echo $Scount ?></td>
                                <td><?php echo $salesInfo['itemType'] ?></td>
                                <td><?php echo $salesInfo['itemBrand'] ?></td>
                                <td><?php echo $salesInfo['itemModel'] ?></td>
                                <td><?php echo $salesInfo['itemPrice'] ?></td>
                                <td><?php echo $salesInfo['saleDate'] ?></td>
                            </tr>
                            <?php
                            $Scount++;
                            }
                        }
                        else{
                            echo "<tr>";
                            echo "<td colspan = '6'>No sales at the moment🥲!!!</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>