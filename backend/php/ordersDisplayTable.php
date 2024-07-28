<div class = "p-3 text-light">
                    <h3 class ="text-center text-light">Current Orders</h3>
                    <table class = "table table-bordered text-center">
                        <thead class="">
                            <tr>
                                <th rowspan = "3">SN</th>
                                <th rowspan = "3">Name</th>
                                <th colspan = "6">Products</th>
                                <th rowspan = "3">Ordered Date</th>
                                <th rowspan = "3">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $ordersData = "SELECT * FROM orders";
                            $fetchedOrderData = $conn->query($ordersData);
                            $Ocount = 1;
                            if($fetchedOrderData->num_rows>0){
                                while($orderInfo = $fetchedOrderData->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $salesInfo['itemType'] ?></td>
                                    <td><?php echo $userInfo['itemBrand'] ?></td>
                                    <td><?php echo $userInfo['itemModel'] ?></td>
                                    <td><?php echo $userInfo['itemPrice'] ?></td>
                                    <td><?php echo $userInfo['cAddress'] ?></td>
                                    <td><?php echo $userInfo['orderDate'] ?></td>
                                </tr>
                                <?php
                                $count++;
                                }
                            }
                            else{
                                echo "<tr>";
                                echo "<td colspan = '10'>No orders at the moment🥲!!!</td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                 </div>