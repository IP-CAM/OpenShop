<?php echo $header; ?>
<?php
    $tickets = array(
        '0' => array(
                'name'  =>  'VIP1',
                'price' =>  '$1000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
       '1' => array(
                'name'  =>  'VIP2',
                'price' =>  '$2000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '2' => array(
                'name'  =>  'VIP3',
                'price' =>  '$3000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '3' => array(
                'name'  =>  'VIP4',
                'price' =>  '$4000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '4' => array(
                'name'  =>  'VIP5',
                'price' =>  '$5000',
                'zone'  =>  array(
                    '101'   =>  '100',
                    '102'   =>  '200',
                    '103'   =>  '300',
                    '104'   =>  '400'
                )
        ),
        '5' => array(
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
          <table class="table table-striped">
            <thead>
              <tr>
                    <!--
                <th class="text-center"><?php echo $column_name; ?></th>
                <th class="text-center"><?php echo $column_price; ?></th>
                <th class="text-center"><?php echo $column_zone; ?></th>
                <th class="text-center"><?php echo $column_quantity; ?></th>
                <th class="text-center"><?php echo $column_total; ?></th>
                    -->
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Zone</th>
                <th class="text-center">Quantity</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket) { ?>
              <tr>
                <td class="text-center col-xs-3"><?php echo $ticket['name'] ?></td>
                <td class="text-center col-xs-3"><?php echo $ticket['price'] ?></td>
                <td class="text-center col-xs-3">
                    <select name="zone" id="per1"  class="form-control">
                        <option selected="selected">Choose Zone</option>
                        <?php foreach ($ticket['zone'] as $k=>$v) { ?>
                        <option value="<?php echo $k ?>" remain="<?php echo $v ?>"><?php echo $k ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="text-center col-xs-3">
                    <div>
                        <input type="text" name="quantity" class='form-control' min="0" max="20">
                    </div>
                </td>
              </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br />
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $checkout; ?>" class="btn btn-primary"><?php echo $button_checkout; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript" src="./js/checkout.js"></script>
<?php echo $footer; ?>