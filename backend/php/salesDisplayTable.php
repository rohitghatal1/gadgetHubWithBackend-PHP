<div class="salesTable container">
                <h3 class="text-light hFont py-1">Total Sales</h3>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-font">
                            <th rowspan = "3">SN</th>
                            <th rowspan = "3">Date</th>
                            <th colspan = "6">Products</th>
                            <th rowspan = "3">Total</th>
                        </tr>
                        <tr>
                            <th colspan = "2">Laptop</th>
                            <th colspan = "2">Mobile</th>
                            <th colspan = "2">Smart Watch</th>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
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
                                <td><?php echo $salesInfo['Date'] ?></td>
                                <td><?php echo $userInfo['laptopQty'] ?></td>
                                <td><?php echo $userInfo['price'] ?></td>
                                <td><?php echo $userInfo['mobileQty'] ?></td>
                                <td><?php echo $userInfo['Mprice'] ?></td>
                                <td><?php echo $userInfo['watchQty'] ?></td>
                                <td><?php echo $userInfo['Wprice'] ?></td>
                                <td><?php echo $userInfo['totalPrice'] ?></td>
                            </tr>
                            <?php
                            $count++;
                            }
                        }
                        else{
                            echo "<tr>";
                            echo "<td colspan = '9'>No sales at the moment🥲!!!</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>