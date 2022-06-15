<!-- <div class="row">
    <div class="col-sm-12 text-center" style="background:#e7e6e6;">
        <img width='150' src="<?= ASSET_URL . 'imgs/'.$product_detail['fssai_image_name']; ?>" alt="">
    </div>
</div> -->
<?php
if($product_detail['faq_file_name'] !== '')
{
   
$this->load->view('faqs/'.$product_detail['faq_file_name']);
}
?>
<?php /*
<div id="dvFaqs" class="row">
    <div class="col-sm-12">
        <h3>Faqs</h3>
    </div>
    <div class="container">
        <div class="dvAccordion row">
            <?php
            foreach ($faqs as $faq_category => $faq) {
                ?>
                <div id="multiple" data-accordion-group class="col-lg-4">
                    <div data-accordion>
                        <h5 data-control><?= $faq_category; ?></h5>
                        <div data-content>
                            <?php
                            foreach ($faq as $v) {
                                ?>
                                <div data-accordion>
                                    <button data-control>
                                        <?= $v['question']; ?>
                                    </button>
                                    <div data-content>
                                        <p><?= $v['answer']; ?></p>
                                    </div>
                                </div>
                                <?php
                            } // inner foreach ending
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } // outer foreach ending
            ?>
        </div>
    </div>
</div>
 */?>