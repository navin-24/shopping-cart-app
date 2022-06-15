<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLoginSignupTab col-sm-12">
                <div id="dvTab" class="row">
                    <div class="col-sm-12 text-center">
                        <h4>Login / Signup</h4>
                    </div>
                    <div class="col-sm-12 col-lg-4 offset-lg-4">
                        <div class="bg">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="tabs d-flex justify-content-center">
                                        <li id="defaultOpen" class="tablinks active" onclick="myTabs(event, 'login')">Login</li>
                                        <li class="tablinks" onclick="myTabs(event, 'signup')"><span class=" d-lg-inline-block">Sign Up</li>
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div id="login" class="tabcontent">
                                        <div class="row">
                                            <div class="col-sm-12 mt10">
                                                <input type="text" name = 'email' class="form-control" placeholder="Email Id" autocomplete="off">
                                            </div>

                                            <div class="col-sm-12 mt10">
                                                <input type="password"  name = 'password' class="form-control" placeholder="Password">
                                            </div>
                                            <div class="col-12">
                                                <p id="errMsg" class='text-red'></p>
                                            </div>                                            

                                            <div class="col-sm-12 text-lg-center mt10">
                                                <button class="btn btnSecondary" id="loginUser">Login</button>
                                                <span class="fp d-lg-block"><a href="<?= base_url('forgotPassword'); ?>" id="forgotPassword">Forgot your password?</a></span>
                                            </div>
                                            <div class="col-sm-12 text-center or or2 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <h6>Or</h6>
                                            </div>
                                            <div class="col-sm-12 text-center or d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <h6>Login with your social account.</h6>
                                            </div>
                                            <div class="col-6 col-lg-12 mt10">
                                                <a href="<?php echo $this->facebook->loginUrl(); ?>"><button class="btn btnFacebook" id="facebook_login">
                                                    <i class="fab fa-facebook-f"></i> Facebook</button></a>
                                            </div>
                                            <div class="col-6 col-lg-12 mt10">
                                                <a href="<?php echo $this->google->loginUrl(); ?>"><button class="btn btnGmail" id="google_login">
                                                        <img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> Gmail</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="signup" class="tabcontent">
                                        <form id="signupform" action="" method="post">
                                            <div class="row">
                                                <div class="col-sm-12 mt10">
                                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                                </div>
                                                <div class="col-sm-12 mt10">
                                                    <input type="text" class="form-control" name="email" placeholder="Email Id" required>
                                                </div>
                                                <div class="col-sm-12 mt10">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="col-sm-12 mt10">
                                                    <input type="hidden" name='csrf_test_name' value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                                                </div>
                                                <div class="col-12">
                                                    <p id="signerrMsg" class='text-red'></p>
                                                </div>
                                                <div class="col-sm-12 text-lg-center mt10">
                                                    <button class="btn btnSecondary">Sign Up</button>
                                                </div>
                                                <div class="col-sm-12 text-center or or2 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                    <h6>Or</h6>
                                                </div>
                                                <div class="col-sm-12 text-center or d-lg-flex justify-content-lg-center align-items-lg-center">
                                                    <h6>Signup with your social account.</h6>
                                                </div>
                                                <div class="col-6 col-lg-12 mt10">
                                                    <a href="<?php echo $this->facebook->loginUrl(); ?>"><button class="btn btnFacebook" id="facebook_login">
                                                            <i class="fab fa-facebook-f"></i> Facebook</button></a>
                                                </div>
                                                <div class="col-6 col-lg-12 mt10">
                                                    <a href="<?php echo $this->google->loginUrl(); ?>"><button class="btn btnGmail" id="google_login">
                                                            <img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> Gmail</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($this->session->flashdata('resetflshMsg') != '') { ?>
<div class="dvModal">
    <div id="signupModal" class="modal" style="display:block;">
        <div class="modal-content modal-center text-center">
            <div class="col-sm-12 text-center">
                <h4 class="mb10"><?php echo $this->session->flashdata('resetStatus'); ?></h4>
                <h5><?php echo $this->session->flashdata('resetflshMsg'); ?></h5>
                <button class="btn btnPrimary" id="myBtn">OK</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
    var signupModal = document.getElementById("signupModal");
    var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
    btn.onclick = function () {
        signupModal.style.display = "none";
    }

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        signupModal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == signupModal) {
            signupModal.style.display = "none";
        }
    }

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {

        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        var url = '<?= base_url(); ?>';
        $("#loginUser").on('click', function () { // For Login with password
            $("p#errMsg").html('');
            var email = $('input[name="email"]').val();
            var password = $('input[name="password"]').val();
            if (email == '') {
                $("p#errMsg").html('Please enter email address');
                return false;
            }

            if (password == '') {
                $("p#errMsg").html('Please enter password');
                return false;
            }

            var emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

            if (!emailReg.test(email) || email === '')
            {
                $("p#errMsg").html('Please enter valid email');
                return false;
            }

            var dataJson = {email: email, password: password, 'csrf_test_name': csrf_value};
            $.ajax({
                url: url + 'user/loginUser',
                type: 'POST',
                data: dataJson,
                dataType: "JSON",
                success: function (response) {
                    if (response.status == 'failed') {
                        $("p#errMsg").html(response.message).show();
                    } else if (response.message == "Welcome") {
                        window.location.href = "<?= BASE_URL; ?>";
                        return;
                    }
                }
            });
        });

        $("#signupform").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    minlength: "Name should be at least 3 characters"
                },
                confirm_password: {
                    equalTo: "Enter Confirm Password Same as Password"
                }

            },
            submitHandler: function (form) {
               $("p#signerrMsg").text('');
                $.ajax({
                    url: url + 'user/registerUser',
                    type: 'POST',
                    dataType: "JSON",
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status == 'failed') {
                            $("p#signerrMsg").html(response.message).show();
                        } else if (response.message == "Welcome") {
                            window.location.href = "<?= BASE_URL; ?>";
                            return;
                        }


                    }
                });
            }
        });
    });

    function myTabs(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();


    // Modal

</script>