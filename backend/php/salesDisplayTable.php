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
                            while($salesInfo = $fetchedsalesData->fetch_assoc()){
                                ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $userInfo['itemType'] ?></td>
                                <td><?php echo $userInfo['itemBrand'] ?></td>
                                <td><?php echo $userInfo['itemModel'] ?></td>
                                <td><?php echo $userInfo['itemPrice'] ?></td>
                                <td><?php echo $salesInfo['saleDate'] ?></td>
                            </tr>
                            <?php
                            $count++;
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