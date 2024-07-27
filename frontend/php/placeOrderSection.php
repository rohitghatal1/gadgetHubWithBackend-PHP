<div class="palceOrderModal p-2 col-4 bg-light text-dark rounded" id ="placeOrder" style="display:none; position:fixed; top:0; right:6rem; z-index:13">
        <div class="headingAndCloseBtn d-flex justify-content-between align-items-center p-2">
            <h3>Place Order:</h3>
            <span style="font-size:20px; cursor:pointer;" onclick = "closeOrderModal()">&times;</span>
        </div>
        <div class="userInfoSection">
            <form action="php/placeOrder.php" method="post">
                <input type="hidden" id="userId" name="userId">
                
                <label class="form-label text-font">Address</label>
                <input class="form-control" type="text" id="cAddress" name="address" placeholder="Enter address to where the order to be delivered">

                <h5 class="text-center text-font mt-3 fw-bold">Select a payment Method:</h5>
                <div class="d-flex align-items-center justify-content-around">
                    <span class="esewa mt-4" style="width:8rem; height:4rem; cursor:pointer;" onclick="openQR()"><img src="logos/esewa.png" class="img-fluid"></span>
                    <input class="p-2 rounded bg-info-subtle text-dark-subtle fw-bold border-0" type="submit" value="Cash On Delivery">
                </div>
            </form>
            <div class="QR p-2 bg-body-tertiary" id="QRCode" style="display:none; position:absolute; top:0; right:0; z-index:14">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="text-center hFont">Scan QR for Payment:</h3>
                    <span style="font-size:20px; cursor:pointer" onclick="closeQR()">&times;</span>
                </div>
                <figure style="width:32rem; height:25rem"><img src="logos/QR.jpg" style="width:100%; height:100%"></figure>
            </div>
        </div>
    </div>