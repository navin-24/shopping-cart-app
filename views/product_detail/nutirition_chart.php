<?php
$nutrition_facts_arr = json_decode($nutrition_facts, true);
if($nutrition_facts_arr != null){
?>
<!-- <div class="col-md-6 text-center"> -->
    <div class="row">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Nutrition Facts</h3>
                    <p><?php echo $serving_size;?> Serving per container.</p>
                </div>
                <div class="col-md-12 responsive">
                    <table>
                        <thead>
                            <tr>
                                <th width="50%">Serving Size</th>
                                <th width="25%"></th>
                                <th width="25%"><?php echo $nutrition_facts_arr['serving_size']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Amount per serving</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="border">
                                <td><b>Calories</b></td>
                                <td></td>
                                <td><b><?php echo $nutrition_facts_arr['calories']; ?></b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><b><?php echo $nutrition_facts_arr['bottle_size']; ?></b></td>
                                <td><b><?php echo $nutrition_facts_arr['percent_title']; ?></b></td>
                            </tr>
                            <?php
                            $total = (count($nutrition_facts_arr['details']) - 1);
                            foreach ($nutrition_facts_arr['details'] as $key => $row) {
                                $cls = ($key == 0 || ($key == $total)) ? 'class="border-b"' : '';
                                ?>
                                <tr <?php echo $cls; ?>>
                                    <?php if ($cls != '') { ?>
                                        <td><?php echo $row[0]; ?></td>
                                    <?php } else { ?>
                                        <td><?php echo $row[0]; ?></td>
                                        <?php
                                    }
                                    ?>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">*AS PER NUTRITIVE VALUE OF INDIAN FOODS, ICMR (2010)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
<?php } ?>