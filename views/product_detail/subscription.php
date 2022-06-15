<div class="row noofdays">
    <div class="days col-lg-9 col-xl-10">
        <div class="selectOptions d-flex flex-wrap justify-content-center justify-content-lg-start">
            <?php
            foreach (json_decode($product_option['option_txt'], true) as $k => $v) {
                if($v['option_type_id'] == $option_type_id)
                {
                    $checked = 'checked';
                    echo $special_price = $v['special_price'];
                    $base_price = $v['base_price'];
                }
                    
                
                ?>
                <div class="opt">
                    <input type="radio" id="control_<?= $k; ?>" name="select" value="<?= $v['option_type_id']; ?>" data-base_price="<?= number_format($v['base_price'], 2); ?>" data-special_price="<?= number_format($v['special_price'], 2); ?>" <?= $checked; ?> option_name = '<?= $v['option_name'] ?>'>
                    <label for="control_<?= $k; ?>">
                        <p><span><?= $v['option_name']; ?></span></p>
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>
</div>