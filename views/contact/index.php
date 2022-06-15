<?php
if (isset($_SESSION['querymsg'])) {
    $querymsg = $_SESSION['querymsg'];
    echo $querymsg;
    $_SESSION['querymsg'] = '';
}

$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>

<div class="dvContact">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 text-center mb15">
                <h4>LET'S HAVE A JUICY CONVERSATION.</h4>
            </div>

            <div class="col-lg-4 mb15 text-center">
                <img width="50" src="https://www.rawpressery.com//images/location_icon-01.svg" class="img-fluid" alt="">
                <h4>come say hi!</h4>
                <p class="paragraph">
                    2nd floor, DTC Building, Sitaram Mills, N M Joshi Marg, Lower Parel, Mumbai- 400013, Maharashtra.
                </p>
                <a class="btn btnSecondary mb15" href="https://goo.gl/maps/JHWZ4Rg8Ke42" target="_blank">Get Directions</a>
            </div>

            <div class="col-lg-4 mb15 text-center">
                <img width="50" src="https://www.rawpressery.com//images/call_icon-01.svg" class="img-fluid" alt="">
                <h4>call us maybe?</h4>
                <p class="paragraph">
                    2nd floor, DTC Building, Sitaram Mills, N M Joshi Marg, Lower Parel, Mumbai- 400013, Maharashtra.
                </p>
                <a class="btn btnSecondary mb15" href="tel:8657303303" target="_blank">+91 8657-303-303</a>
            </div>

            <div class="col-lg-4 mb15 text-center">
                <img width="50" src="https://www.rawpressery.com//images/email_icon-01.svg" class="img-fluid" alt="">
                <h4>start a mail trail</h4>
                <p class="paragraph">
                    2nd floor, DTC Building, Sitaram Mills, N M Joshi Marg, Lower Parel, Mumbai- 400013, Maharashtra.
                </p>
                <a class="btn btnSecondary mb15" href="mailto:getmore@rawpressery.com" target="_blank">getmore@rawpressery.com</a>
            </div>

            <div class="col-sm-12 text-center">
                <h4 id="clickme">Got a Query?</h4>
            </div>

            <div class="col-xl-8 offset-xl-2">
                <form action="<?= base_url('contact/index'); ?>" id="contactForm" method="post">
                    <div class="row">
                        <div class="col-sm-12 mb15">
                            <input name="name" id="name" title="Name" placeholder="Name*" class="required-entry form-control" type="text" value="<?php echo set_value('name');?>">
                            <?= form_error('name', '<div class="text-red">', '</div>') ?>

                        </div>
                        <div class="col-sm-12 mb15">
                            <input name="email" id="email" title="Email" placeholder="Email*" class="required-entry form-control" type="email" autocapitalize="off" autocorrect="off" spellcheck="false" value="<?php echo set_value('email');?>">
                            <?= form_error('email', '<div class="text-red">', '</div>') ?>

                        </div>
                        <div class="col-sm-12 mb15">
                            <input name="telephone" id="telephone" title="Telephone" placeholder="Telephone*" class="input-text  required-entry form-control" type="tel" value="<?php echo set_value('telephone');?>">
                            <?= form_error('telephone', '<div class="text-red">', '</div>') ?>

                        </div>
                        <div class="col-sm-12 mb15">
                            <textarea name="comment" id="comment" title="Comment" placeholder="Comment*" class="required-entry form-control" cols="5" rows="3"></textarea>
                            <?= form_error('comment', '<div class="text-red">', '</div>') ?>
                        </div>
                        <div class="col-sm-12 mb15 text-center">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />

                            <button class="btn btnSecondary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="dvModal">
    <div id="contactModal" class="modal">
        <div class="modal-content text-center modal-sm modal-center">          
            <i class="fas fa-times-circle btn close"></i>            
            <i class="fas fa-check-circle text-green"></i>
            <h5>Thank you. <br>We will get back to you soon.</h5>
        </div>
    </div>
</div>

<script>
    // Contact Modal
    var contactModal = document.getElementById("contactModal");
    var contactspan2 = contactModal.getElementsByClassName("close")[0];

    contactspan2.onclick = function () {
        contactModal.style.display = "none";
    }
<?php if ($querymsg) { ?>
        contactModal.style.display = "block";
<?php } ?>
</script>



