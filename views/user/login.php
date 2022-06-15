<div class="row justify-content-center">
    <div class="col-6">
        <h1><?= $title ?></h1>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('message') ?>
            </div>
        <?php } ?>
        <?= form_open('user/login', array('id' => 'loginForm')) ?>
        <div class="form-group">
            <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" maxlength="10"/>
            <?= form_error('mobile_number', '<div class="error">', '</div>') ?>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
            <?= form_error('password', '<div class="error">', '</div>') ?>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
        </div>
        <?= form_close(); ?>
    </div>
</div>