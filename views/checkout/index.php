<table cellpadding="6" cellspacing="1" style="width:100%" border="1" >

    <tr style="text-align:left">
        <th>Product</th>
        <th>Size</th>
        <th>QTY</th>
        <th style="text-align:right">Item Price</th>
    </tr>

    <?php
    $i = 1;
    foreach ($cartItems as $items):
        ?>

        <tr style="text-align:left">
            <td>
                <?= $items['product_name']; ?>

                <?php /*if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                    <p>
                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                            <strong><?= $option_name; ?>:</strong> <?= $option_value; ?><br />

                        <?php endforeach; ?>
                    </p>

                <?php endif; */?>

            </td>
            <td><?= $items['varient']; ?></td>
            <td><?= form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
            
            <td>₹<?= $this->cart->format_number($items['price_incl_tax']); ?></td>
            
        </tr>

        <?php
        $i++;
    endforeach;
    ?>

    <tr style="text-align:left">
        <td> <strong>Total</strong></td>
        <td class="right"></td>
        <td> <strong><?= $this->cart->total_items(); ?></strong></td>
        <td class="right">₹<?= $this->cart->format_number($this->cart->total()); ?></td>
    </tr>

</table>

<p><?= form_submit('', 'Update your Cart'); ?></p>
<a href="<?= base_url('checkout');?>">Proceed to checkout</a>