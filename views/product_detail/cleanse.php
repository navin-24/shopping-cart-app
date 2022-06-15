<div class="row selectOptions">
    <div class="col-lg-12">
        <div class="optionBox d-flex flex-wrap justify-content-center justify-content-md-start">
            <?php
            $i = 0;
            foreach (json_decode($product_option['option_txt'], true) as $k => $v) {
                $checked = ($k == 0) ? 'checked' : '';
                
                $base_price = number_format(intval($v['base_price']), 2);
                $special_price = number_format(intval($v['special_price']), 2);
                ?>
                <div class="opt" id="buy_option">
                    <input type="radio" id="control_<?= $k; ?>" name="select" value="<?= $i; ?>" option_value="<?= $v['option_type_id'];?>" data-base_price="<?= $base_price; ?>" data-special_price="<?= $special_price; ?>" <?= $checked; ?> option_name ="<?= $v['option_name']; ?>">
                    <label for="control_<?= $k; ?>">
                        <h2><?= strtoupper($v['option_name']); ?></h2>
                        <p><span><?= $v['sub_text']; ?></span></p>
                        <p><?= $v['ideal_txt']; ?></p>
                    </label>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
</div>