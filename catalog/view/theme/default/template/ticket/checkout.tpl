<?php echo $header; ?>

<?php
    $purchase_items = array(
        '1' => array(
            'zone' => '101',
            'quantity' => '1',
            'name' => 'VVIP',
            'price' => '328.00',
            'subtotal' => '328.00'
        ),
        '2' => array(
            'zone' => '201',
            'quantity' => '2',
            'name' => 'VIP',
            'price' => '268.00',
            'subtotal' => '536.00'
        )
    );

    $total = '864.00';

    $addresses = array(
        '0' =>  array(
            'address_id'    =>      '36',
            'full_address'  =>      '11 McDonald Street, Auckland, New Zealand',
            'street_number' =>      '11',
            'route'         =>      'McDonald St',
            'suburb'        =>      'Sandringham',
            'city'          =>      'Auckland',
            'postcode'      =>      '1025',
            'state'         =>      'Auckland',
            'country'       =>      'New Zealand'
        ),
        '1' =>  array(
            'address_id'    =>      '56',
            'full_address'  =>      '22 Customs Street East, Auckland, New Zealand',
            'street_number' =>      '22',
            'route'         =>      'Customs St E',
            'suburb'        =>      'Auckland',
            'city'          =>      'Auckland',
            'postcode'      =>      '1010',
            'state'         =>      'Auckland',
            'country'       =>      'New Zealand'
        )
    );
?>

<div class="container">
    <form id="checkout-form" enctype="multipart/form-data" method="post" action="http://localhost/openshop/index.php?route=ticket/finish" data-toggle="validator" role="form">
        <div class="col-xs-12" id="order-summary">
            <h2>Order Summary</h2>
            <table class="table table-striped col-xs-12">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Zone</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach($purchase_items as $row => $item) { ?>
                <tr>
                    <td><?php echo $item['name'] ?></td>
                    <td>$<?php echo $item['price'] ?></td>
                    <td><?php echo $item['zone'] ?></td>
                    <td><?php echo $item['quantity'] ?></td>
                    <td>$<?php echo $item['subtotal'] ?></td>
                    <input type="hidden" name="<?php echo $row ?>[name]" value="<?php echo $item['name'] ?>">
                    <input type="hidden" name="<?php echo $row ?>[price]" value="<?php echo $item['price'] ?>">
                    <input type="hidden" name="<?php echo $row ?>[zone]" value="<?php echo $item['zone'] ?>">
                    <input type="hidden" name="<?php echo $row ?>[quantity]" value="<?php echo $item['quantity'] ?>">
                    <input type="hidden" name="<?php echo $row ?>[subtotal]" value="<?php echo $item['subtotal'] ?>">
                </tr>
                <?php } ?>
            </table>
            <table class="table-total table-striped col-sm-8 col-sm-offset-4 pull-right col-md-6 col-md-offset-6 ">
                <td>Total (incl. GST)</td>
                <td id="total">$<?php echo $total ?></td>
                <input type="hidden" value="" name="total">
                </tr>
            </table>
        </div>
        <div class="col-xs-12" id="shipping-methods">
            <h2>Shipping Method</h2>
            <div class="radio">
                <label for="shipping-pickup">
                    <input type="radio" name="shipping-method" id="shipping-pickup" value="pickup" checked>
                    Pickup
                </label>
            </div>
            <div class="radio">
                <label for="shipping-mail">
                    <input type="radio" name="shipping-method" id="shipping-mail" value="mail">
                    Mail
                </label>
            </div>
        </div>
        <div class="col-xs-12" id="shipping-details">
            <h2>Shipping Detail</h2>
            <div id="shipping-detail-pickup">
                Please go to 40 Eden Crescent to pickup the ticket, thank you.
            </div>
            <div id="shipping-detail-mail" class="col-md-6 col-sm-8">
                <div class="form-group">
                    <?php foreach ($addresses as $k => $address) {  ?>
                    <div class="radio">
                        <label for="address-<?php echo $address['address_id'] ?>">
                            <input type="radio" name="shipping-detail" id="address-<?php echo $address['address_id'] ?>" value="<?php echo $address['address_id'] ?>" <?php if($k==0) echo 'checked'; ?> >
                            <?php echo $address['full_address'] ?>
                        </label>
                    </div>
                    <?php } ?>
                    <div class="radio">
                        <label for="address-0">
                            <input type="radio" name="shipping-detail" id="address-0" value="0" >
                            New Address
                        </label>
                    </div>
                    <div id="new-address">
                        <label class="control-label" for="new-address-detail">New Address</label>
                        <input class="form-control" type="text" id="new-address-detail" name="newaddress" >
                        <input>
                    </div>
                </div>
                    <!--
                <div class="form-group required">
                    <label class="control-label" for="input-firstname">Fisrt Name</label>
                    <input required class="form-control" type="text" id="input-firstname" name="firstname" value="<?php echo $address['firstname']; ?>" >
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-lastname">Last Name</label>
                    <input required class="form-control" type="text" id="input-lastname" name="lastname" value="<?php echo $address['lastname']; ?>" >
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-company">Company</label>
                    <input class="form-control" type="text" id="input-company" name="company" value="<?php echo $address['company']; ?>" >
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-line1">Line 1</label>
                    <input required class="form-control" type="text" id="input-line1" name="line1" value="<?php echo $address['line1']; ?>" >
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-line2">Line 2</label>
                    <input required class="form-control" type="text" id="input-line2" name="line2" value="<?php echo $address['line2']; ?>" >
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-city">City</label>
                    <input required class="form-control" type="text" id="input-city" name="city" value="<?php echo $address['city']; ?>" >
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-postcode">Postcode</label>
                    <input required class="form-control" type="text" id="input-postcode" name="postcode" value="<?php echo $address['postcode']; ?>" >
                </div>
                <div class="form-group required">
                    <label class="control-label" for="input-postcode">Country</label>
                    <input required class="form-control" type="text" id="input-country" name="country" value="<?php echo $address['country']; ?>" >
                </div>
                    -->
            </div>
        </div>
        <div class="col-xs-12" id="payment-methods">
            <h2>Payment Methods</h2>
            <div class="radio">
                <label for="payment-online">
                    <input type="radio" name="payment-method" id="payment-online" value="online" checked>
                    Online banking
                </label>
            </div>
            <div class="radio">
                <label for="payment-offline">
                    <input type="radio" name="payment-method" id="payment-offline" value="offline">
                    On site (EFPOS or Cash)
                </label>
            </div>
        </div>

        <div>
            <input type="submit" name="" class="pull-right btn btn-primary btn-lg" value="Submit">
        </div>
    </form>
</div>
<script type="text/javascript" src="。/js/validator.min.js"></script>
<script type="text/javascript" src="./js/checkout.js"></script>
<?php echo $footer; ?>