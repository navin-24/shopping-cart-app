
<div id="main">
    <div id="login">
        <h2>Enter One Time Password (OTP)</h2>
        <hr/>
        <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";

        $attributes = array('class' => '', 'id' => 'otp_verify', 'name' => 'otp_verify');
        echo form_open('user/login', $attributes);


        echo"<br/>";
        echo form_label('Otp : ');
        echo"<br/>";
        $data = array(
            'type' => 'text',
            'name' => 'mobileOtp',
            'id' => 'mobileOtp'
        );

        echo form_input($data);
        echo"<br/>";

        echo form_submit('submit1', 'Verify');
        echo form_close();
        ?>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(function () {
        $("form[name='otp_verify']").validate({
            rules: {
                mobileOtp: {
                    required: true,
                    minlength: 4
                }
            },
            messages: {
                mobileOtp: {
                    required: "Please enter the otp",
                    minlength: "Invalid Otp"
                },
            },
            submitHandler: function (form) {
                var otp = $("#mobileOtp").val();
                if (otp.length == 4 && otp != null) {
                    $.ajax({
                        url: '<?= base_url() ?>/User/verifyOtp',
                        type: 'POST',
                        dataType: "json",
                        data: {otp: otp},
                        success: function (response) {
                            $(".error_msg").html(response.message);
                            $(".error_msg").show();
                        },
                        error: function (response) {
                            $(".error_msg").html(response.message);
                            $(".error_msg").show();
                        }
                    });
                } else {
                    $(".error_msg").html('You have entered wrong OTP.')
                    $(".error_msg").show();
                }

            }
        });
    });
    
    
    
    
</script>