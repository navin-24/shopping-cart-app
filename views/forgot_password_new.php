<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <form id="forgotPassword" action="<?= base_url('user/sendForgotEmail'); ?>" method="post" >
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2>Forgot Password</h2>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-10 offset-1 col-lg-12 offset-lg-0 text-center">
                                    <input name="email" type="text" class="form-control" placeholder="Enter Email address">
                                </div>
                                <input type="hidden" name='csrf_test_name' value="<?php echo $this->security->get_csrf_hash(); ?>">
                            </div>
                        </div>
                        <div class="submit col-sm-12 text-center">
                            <button class="btn btnSecondary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php if($this->session->flashdata('flsh_msg')!='') { ?>
<div class="dvModal">
    <div id="resetModal" class="modal" style="display: block;">
        <div class="modal-content modal-center modal-sm text-center">
            <div class="col-sm-12 text-center">
                <h4 class="mb10">SUCCESS</h4>
                <h5><?php echo $this->session->flashdata('flsh_msg'); ?></h5>

                <button class="signupBtn btnPrimary" id="signupBtn">OK</button>
            </div>
        </div>
    </div>
</div>
    <script>
        var resetModal = document.getElementById("resetModal");
        var signupBtn = document.getElementById("signupBtn");
        var span = document.getElementsByClassName("close")[0];

        signupBtn.onclick = function () {
            resetModal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == resetModal) {
                resetModal.style.display = "none";
            }
        }

    </script>

<?php } ?> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {

        $("#forgotPassword").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
