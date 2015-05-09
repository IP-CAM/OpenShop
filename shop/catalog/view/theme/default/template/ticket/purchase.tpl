<?php echo $header; ?>
<?php
    $tickets = array(
        '1' => array(
                'name'  =>  'VIP1',
                'price' =>  '$1000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
       '2' => array(
                'name'  =>  'VIP2',
                'price' =>  '$2000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '3' => array(
                'name'  =>  'VIP3',
                'price' =>  '$3000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '4' => array(
                'name'  =>  'VIP4',
                'price' =>  '$4000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '5' => array(
                'name'  =>  'VIP5',
                'price' =>  '$5000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '6' => array(
                'name'  =>  'VIP6',
                'price' =>  '$6000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        )
    );
?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <h1><?php echo $heading_title; ?></h1>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="table-responsive">
          <table class="table table-striped" id="choose-table">
            <thead>
              <tr>
                <th class="text-center"><?php echo $column_name; ?></th>
                <th class="text-center"><?php echo $column_price; ?></th>
                <th class="text-center"><?php echo $column_zone; ?></th>
                <th class="text-center"><?php echo $column_quantity; ?></th>
                  <th class="text-center">Subtotal</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $row => $ticket) { ?>
              <tr id="<?php echo $row ?>">
                <td class="text-center col-xs-2 input-name"><?php echo $ticket['name'] ?></td>
                <td class="text-center col-xs-2 input-price"><?php echo $ticket['price'] ?></td>
                <td class="text-center col-xs-3">
                    <div class=" col-md-8 col-md-offset-2">
                        <select name="zone" class="form-control zone-input tickets-input" >
                            <option selected="selected">Choose Zone</option>
                            <?php foreach ($ticket['zone'] as $k=>$v) { ?>
                            <option value="<?php echo $k ?>" remain="<?php echo $v ?>"><?php echo $k ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>
                <td class="text-center col-xs-2">
                    <div class="col-md-8 col-md-offset-2">
                        <input type="number" name="quantity[<?php echo $row ?>]" class='form-control quantity-input tickets-input' min="0" value="0" step="1" >
                        <input type="hidden" name="name[<?php echo $row ?>]" value="<?php echo $ticket['name'] ?>">
                        <input type="hidden" name="price[<?php echo $row ?>]" value="<?php echo $ticket['price'] ?>">
                    </div>
                </td>
                <td class="text-center col-xs-2 input-subtotal">
                    $0.00
                </td>
              </tr>
                <?php } ?>
            </tbody>
          </table>

          <table class="table-striped col-sm-4 col-sm-offset-8">
              <td>Total (incl. GST)</td>
              <td id="total">$0.00</td>
              <input type="hidden" value="" name="total">
            </tr>
          </table>
        </div>
        <div class="buttons">
          <input type="submit" class="pull-right btn btn-primary" value="<?php echo $button_checkout; ?>">
        </div>
      </form>


    <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript" src="./js/checkout.js"></script>
<?php echo $footer; ?>