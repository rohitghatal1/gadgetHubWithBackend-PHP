<div class="usersTable container">
                <h3 class="text-light hFont py-1">Current Users</h3>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-font">
                            <th>SN</th>
                            <th>UId</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $userData = "SELECT * FROM users";
                        $fetchedUserData = $conn->query($userData);
                        $count = 1;
                        if($fetchedUserData->num_rows>0){
                            while($userInfo = $fetchedUserData->fetch_assoc()){
                                $userId = $userInfo['Id'];
                                ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $userInfo['Id'] ?></td>
                                <td><?php echo $userInfo['uName'] ?></td>
                                <td><?php echo $userInfo['uAddress'] ?></td>
                                <td><?php echo $userInfo['uContact'] ?></td>
                                <td><?php echo $userInfo['uEmail'] ?></td>
                                <td><?php echo $userInfo['username'] ?></td>
                                <td><button class="btn text-danger" onclick="confirmDelete(<?php echo (int)$userId ?>, 'users')"><i class="fas fa-trash text-danger"></i></button></td>
                            </tr>
                            <?php
                            $count++;
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>