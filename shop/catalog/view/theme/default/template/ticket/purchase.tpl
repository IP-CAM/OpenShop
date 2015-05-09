<?php echo $header; ?>

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
          <table class="table table-bordered">
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
              <tr>
                <td class="text-center">VIP</td>
                <td class="text-center">$1200.00</td>
                <td class="text-center">
                      <select name="per1" id="per1">
                          <option selected="selected">Choose Zone</option>
                          <option value="101" remain="100">101</option>
                          <option value="102" remain="200">102</option>
                          <option value="103" remain="300">103</option>
                          <option value="104" remain="400">104</option>
                      </select>
                  </td>
                <td class="text-center">
                    <div>
                        <input type="text" name="quantity">
                    </div>
                </td>
              </tr>
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
<?php echo $footer; ?>