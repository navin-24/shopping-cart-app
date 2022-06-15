<section class="dvProductListing">
    <div class="container">
        <div class="dvCategories d-flex flex-nowrap flex-sm-wrap justify-content-sm-center">
            <?php
            $categoryMenu = $this->config->item('categoryMenu');
            foreach ($categoryMenu as $row) {
                $activeCls = '';
                if (strpos($row['link_url'], $categoryArr['category_url']) !== FALSE) {
                    $activeCls = 'active';
                }
                ?>
                <a href="<?= base_url($row['link_url']); ?>" class="btn">
                    <img src="<?= IMG_BASE_PATH . $row['image_url']; ?>" alt="">
                    <?php if (strtolower($row['name']) == 'cleanses') { ?>
                        <span class="tabDisabled">Out Of Stock</span>
                    <?php } ?>
                    <span class="<?= $activeCls; ?>"><?= $row['name']; ?></span>
                </a>
            <?php } ?>
        </div>
    </div>
    <?= generateBreadcrumb(); ?>
    <div class="container-fluid">
        <div class="row bg-color">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="dvHeading row">
                            <div class="col-sm-12 text-center">
                                <h1 class="bebas"><?= $categoryArr['category_name']; ?></h1>
                            </div>
                        </div>
                        <div class="dvSave row">
                            <div class="col-sm-12 text-center">
                                <h2>It pays to live healthy. <span class="bold">Save 20%</span> on all <span class="uppercase"><?= $categoryArr['category_name']; ?>.</span></h2>
                            </div>
                        </div>
                        <?php
                        $category_name_banner = preg_replace('#[ -]+#', '', $categoryArr['category_name']);
                        $banner_view = 'product/' . strtolower($category_name_banner . '_banner');
                        if (is_file(APPPATH . 'views/' . $banner_view . '.php')) {
                            $this->load->view($banner_view);
                        }
                        ?>
                        <div class="dvProducts row text-center">
                            <?php
                            if ($category == 'cleanses') {
                                $this->load->view('product/cleanses');
                            } else {
                                $this->load->view('product/juices');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

