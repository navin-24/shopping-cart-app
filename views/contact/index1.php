<html>
    <head>

        <style type="">

            div.form-wrap{ float:left; width:100%; margin:0px; padding:0px; position:relative;}
            .form-list{float:left; width:100%; margin:0px; padding:0px; text-align:center;}
            .form-list li{ float:left; width:100%; margin:0px 0px 10px 0px; padding:0px; text-align:center; position:relative;}
            .form-list li .field{ float:left; width:100%; margin:0px 0px 10px 0px; padding:0px; text-align:center;}
            .form-list li .field:last-child{margin:0;}
            .form-list li div.input-box{ display:inline-block; max-width:400px; width:100%; margin:0px; padding:0px; position:relative;}
            .form-list li label, div.order-detail label, div.saved-address label{float:left; margin:0px; width:100%; display:inline-block; max-width:400px;text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:1px; font-weight:normal; display:none; font-family: 'Work Sans'; line-height:19px;}
            .form-list li label.tnc{display:block}
            .form-list li div.input-box .text, .form-list li div.input-box .input-text{float:left; width:100%; margin:0px; padding:10px 0px; border:0; border-bottom:1px solid #e5e5e5; border-radius:0; -webkit-border-radius:0; font-size:14px;}
            .form-list li div.input-box.show-text .text{ padding-right:85px;}
            .form-list li div.input-box.show-text .show-btn, section.checkout .btn-open{ position:absolute; right:0px; top:11px; text-transform:uppercase; text-decoration:underline; color:#000; font-size:12px; letter-spacing:1px; font-family: 'Work Sans';}
            .form-list li .frgt-pswrd{display:inline-block; color:#000; margin:15px 0px 0px; font-size:12px; letter-spacing:1px; text-transform:uppercase; font-family: 'Work Sans'; text-decoration:underline;}
            .form-list li label.lbl-checkbox, .form-list li label.lbl-radio{ text-transform:none; font-family: 'Work Sans'; font-size:14px; line-height:18px; color:#555; }
            .form-list li ul.instruction-list label.lbl-checkbox, .form-list li ul.instruction-list label.lbl-radio{ min-height:50px; letter-spacing:0;}

            .contact-form-new div.form-wrap{ background:#fff; padding:60px 0; text-align:center;}
            .contact-form-new .form-list { float:none; display:inline-block; max-width:560px;}
            .contact-form-new .form-list li label{display:block;max-width:100%;opacity:0.5;letter-spacing:2px;}
            .contact-form-new .form-list li .field{ margin:0 0 25px 0;}
            .contact-form-new .form-list li div.input-box{ max-width:100%;}
            .contact-form-new .form-list li div.input-box .text, .contact-form-new .form-list li div.input-box .input-text{ padding:5px 0 5px 5px;}

            .contact-form-new div.form-wrap .button{ background:transparent; padding:13px 50px; margin-top:30px; font-size:13px; border:1px solid #000; color:#000; transition:all ease-in-out 0.2s;}
            .contact-form-new div.form-wrap .button:hover, .contact-form-new div.form-wrap .button.active{ background:#000; color:#fff;}
            .disable-btn{
                background-color: #cccccc;
                color: #000;
            }

        </style>
    </head>




    <div class="row justify-content-center">
        <div class="col-6">
            <?php /*
              <h1><?= $title ?></h1>
              <?php if ($this->session->flashdata('message')) { ?>
              <div class="alert alert-danger">
              <?= $this->session->flashdata('message') ?>
              </div>
              <?php } /* ?>
              <?= form_open('contact/index', array('id' => 'contactForm')) ?>
              <div class="form-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Name" maxlength="15"/>
              <?= form_error('name', '<div class="error">', '</div>') ?>
              </div>

              <div class="form-group">
              <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>
              <?= form_error('email', '<div class="error">', '</div>') ?>
              </div>

              <div class="form-group">
              <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" maxlength="10"/>
              <?= form_error('mobile_number', '<div class="error">', '</div>') ?>
              </div>

              <div class="form-group">
              <input type="textarea" name="comment" id="comment" class="form-control" placeholder="Comment" />
              <?= form_error('comment', '<div class="error">', '</div>') ?>
              </div>

              <div class="form-group">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
              </div>
              <?= form_close(); */ ?>
            
            <?php 
            if(isset($_SESSION['querymsg']))
            {
                $querymsg = $_SESSION['querymsg'];
                echo $querymsg;
                $_SESSION['querymsg'] = '';
            }
            
            $csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
    );

     
            
            ?>
            <form action="<?= base_url('contact/index'); ?>" id="contactForm" method="post" class="contact-form-new">
                <div class="fieldset">
                    <h2 class="legend">Got a query? </h2>
                    <p class="required">* Required Fields</p>
                    <ul class="form-list">
                        <li class="fields">
                            <div class="field">
                                <label for="name" class="required">Name<em>*</em></label>
                                <div class="input-box">
                                    <input name="name" id="name" title="Name" value="" class="input-text required-entry form-control" type="text">
                                    <?= form_error('name', '<div class="error">', '</div>') ?>
                                </div>
                            </div>
                            
                            <div class="field">
                                <label for="email" class="required">Email<em>*</em></label>
                                <div class="input-box">
                                    <input name="email" id="email" title="Email" value="" class="input-text required-entry form-control" type="email" autocapitalize="off" autocorrect="off" spellcheck="false">
                                    <?= form_error('email', '<div class="error">', '</div>') ?>
                                </div>
                            </div>
                            
                            <div class="field">
                                <label for="telephone" class="required">Telephone<em>*</em></label>
                                <div class="input-box">
                                    <input name="telephone" id="telephone" title="Telephone" value="" class="input-text  required-entry form-control" type="tel">
                                    <?= form_error('telephone', '<div class="error">', '</div>') ?>
                                </div>
                            </div>
                            
                        </li>
                        <li class="wide">
                            <label for="comment" class="required">Comment<em>*</em></label>
                            <div class="input-box">
                                <textarea name="comment" id="comment" title="Comment" class="required-entry input-text form-control" cols="5" rows="3"></textarea>
                                <?= form_error('comment', '<div class="error">', '</div>') ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="buttons-set">
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <input type="text" name="hideit" id="hideit" value="" style="display:none !important;">
                    <button type="submit" title="Submit" data-text="Submit" class="button"><span><span>Submit</span></span></button>
                </div>
            </form>
        </div>
    </div>
</html>