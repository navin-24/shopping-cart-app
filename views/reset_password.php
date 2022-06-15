<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <form  id="resetPassword" method="post" action="<?= base_url('user/savePassword');?>">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2>Reset Password</h2>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" name='csrf_test_name' value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input id="token" name="token" type="hidden" value="<?= $token ?>">
                                </div>
                                <div class="col-10 offset-1 col-lg-12 offset-lg-0 text-center">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Enter new password" value="" maxlength="15" required>
                                </div>
                                <div class="otp col-10 offset-1 col-lg-12 offset-lg-0 text-center">
                                    <input id="confirmPassword" name="confirm_password" type="password" class="form-control" placeholder="Enter confirm password" maxlength="15" required>
                                </div>
                                    <p id="errMsg" class='text-red'></p>
                                    <p id="msg" class='text-green'></p>
                            </div>
                        </div>
                        <div class="submit col-sm-12 text-center">
                            <button class="btn btnSecondary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {

        $("#resetPassword").validate({
            rules: {
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    minlength: "Password should be at least 5 characters"
                },
                confirm_password: {
                    equalTo: "Enter Confirm Password Same as Password"
                }

            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>