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

                            <tr>
                                <th colspan = "2">Laptop</th>
                                <th colspan = "2">Mobile</th>
                                <th colspan = "2">Smart Watch</th>
                            </tr>

                            <tr>
                                <th>Quantity</th>
                                <th>Price</th>

                                <th>Quantity</th>
                                <th>Price</th>

                                <th>Quantity</th>
                                <th>Price</th>
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
                                    <td><?php echo $salesInfo['Cname'] ?></td>
                                    <td><?php echo $userInfo['laptopQty'] ?></td>
                                    <td><?php echo $userInfo['Lprice'] ?></td>
                                    <td><?php echo $userInfo['mobileQty'] ?></td>
                                    <td><?php echo $userInfo['Mprice'] ?></td>
                                    <td><?php echo $userInfo['watchQty'] ?></td>
                                    <td><?php echo $userInfo['price'] ?></td>
                                    <td><?php echo $userInfo['orderedDate'] ?></td>
                                    <td><?php echo $userInfo['totalPrice'] ?></td>
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