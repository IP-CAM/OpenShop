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
                <td class="text-center"><?php echo $column_name; ?></td>
                  <td class="text-center"><?php echo $column_price; ?></td>
                  <td class="text-center"><?php echo $column_zone; ?></td>
                  <td class="text-center"><?php echo $column_quantity; ?></td>
                <td class="text-center"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) { ?>
              <tr>
                <td class="text-center"><?php echo $product['name']; ?></td>
                  <td class="text-center"><?php echo $product['price']; ?></td>
                  <td class="text-center">
                      <select name="per1" id="per1">
                          <option selected="selected">Choose one</option>
                          <?php foreach($product['stock'] as $v) { ?>
                          <option value="<?= $v[0] ?>"><?= $v[0] ?></option>
                          <?php } ?>
                      </select>
                      <?php foreach($product['stock'] as $v) { ?>
                      <input type="hidden" name="<?= $v[0] ?>" value="<?= $v[1] ?>"/>
                      <?php } ?>
                  </td>
                <td class="text-center"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="quantity[<?php echo $product['id']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                <td class="text-center"><?php echo $product['total']; ?></td>
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
<?php echo $footer; ?>