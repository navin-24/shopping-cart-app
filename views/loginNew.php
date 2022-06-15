<section class="dvLS">
    <div class="container">
        <div class="row">
            <div class="dvLogin col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Login</h2>
                    </div>
                    <div class="col-sm-12">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input id="" type="text" class="form-control" placeholder="Enter Phone Number Or Email">
                                    <p class="text-red">Valid Email or Phone</p>
                                </div>
                                <div class="col-sm-12">
                                    <input id="" type="password" class="form-control" placeholder="Enter Password">
                                    <p class="text-red">Atleast 6 characters</p>
                                </div>
                                <div class="otp col-sm-12">
                                    <input id="" type="text" class="form-control" placeholder="Enter OTP">
                                    <p class="resend">Didn't receive the OTP? <span>Resend OTP</span></p>
                                    <p class="text-green">OTP sent successfully. <span id="some_div"></span></p>
                                    <p class="text-red">Invalid OTP</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="submit col-sm-12">
                        <button class="btn btnSecondary">Submit</button>
                    </div>
                    <div class="getOtp col-sm-12">
                        <button class="btn btnSecondary">Get Otp</button>
                    </div>
                    <div class="or col-sm-12">
                        <p>OR</p>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button class="btn btnFacebook"><i class="fab fa-facebook-f"></i> FACEBOOK</button>
                        <button class="btn btnGmail"><!--<i class="fas fa-envelope"></i>--> <img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> GMAIL</button>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-2">
                <div class="separator"></div>
            </div> -->
            <!-- <div class="col-md-5">
                <div class="dvSignUp">
                    <h2>Sign Up</h2>
                    <form action="">
                        <input id="" type="text" class="form-control" placeholder="Enter Your Name">
                        <input id="" type="text" class="form-control" placeholder="Enter Your Email">
                        <input id="" type="text" class="form-control" placeholder="Enter Your Mobile Number">
                        <input id="" type="password" class="form-control" placeholder="Enter Password">
                        <input id="" type="password" class="form-control" placeholder="Confirm Password">
                    </form>
                    <button class="btn btnBlack">Submit</button>
                        <p>OR</p>
                    <div class="text-center">
                        <button class="btn btnFacebook"><i class="fab fa-facebook-f"></i> FACEBOOK</button>
                        <button class="btn btnGmail"><i class="fas fa-envelope"></i> <img width="20" src="<?= ASSET_URL ?>imgs/gmail.png"> GMAIL</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>

<script>
var timeLeft = 120;
var elem = document.getElementById('some_div');
var timerId = setInterval(countdown, 1000);

function countdown() {
    if (timeLeft == -1) {
        clearTimeout(timerId);
        doSomething();
    } else {
        elem.innerHTML = timeLeft + ' seconds left';
        timeLeft--;
    }
}

function doSomething() {
    // alert("Hi");
}
</script>