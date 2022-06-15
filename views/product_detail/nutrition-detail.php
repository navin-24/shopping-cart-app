<div id="dvTable" class="row">
    <div class="col-sm-12">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $viewData['nutrition_facts'] = $product_detail['nutrition_facts'];
                    $viewData['serving_size'] = $product_detail['serving_size'];
                    if ($product_detail['ingredient']) {
                        $ingredients = implode(', ', array_keys(json_decode($product_detail['ingredient'],true)));
                    }
                    $this->load->view('product_detail/nutirition_chart', $viewData);
                ?>
                </div>
                <div class="smallImages col-md-6 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Ingredients</h3>
                        </div>
                        <div class="col-md-12 responsive">
                            <table style="margin-top: 0px;">
                                <thead>
                                    <tr>
                                        <th width="50%" class="text-left">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <p>
                                                <?php echo ($ingredients)?$ingredients:'Content coming soon'; ?>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>