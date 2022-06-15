
<div id="main">
    <div id="login">
        <h2>Registration Form</h2>
        <hr/>
        <?php
        echo "<div class='error_msg'>";
        echo validation_errors();
        echo "</div>";

        $attributes = array('class' => '', 'id' => 'myform', 'name' => 'signup');
        echo form_open('user/signup', $attributes);

        echo form_label('Name : ');
        echo"<br/>";
        echo form_input('name');
        echo "<div class='error_msg'>";
        if (isset($message_display)) {
            echo $message_display;
        }
        echo "</div>";
        echo"<br/>";
        echo form_label('Mobile : ');
        echo"<br/>";
        $data = array(
            'type' => 'text',
            'name' => 'mobile_number',
            'maxlength' => '10',
        );

        echo form_input($data);
        echo"<br/>";
        echo"<br/>";
        echo form_label('Password : ');
        echo"<br/>";
        echo form_password('password');
        echo"<br/>";
        echo"<br/>";
        echo form_label('Confirm Password : ');
        echo"<br/>";
        echo form_password('confirm_password');
        echo form_submit('submit1', 'Sign Up');
        echo form_close();
        ?>
        <a href="<?php echo base_url() ?> ">For Login Click Here</a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(function () {
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='signup']").validate({
            //console.log(form.submit);
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                name: "required",
                mobile_number: "required",
                /*email: {
                 required: true,
                 // Specify that email should be validated
                 // by the built-in "email" rule
                 email: true
                 },*/
                password: {
                    required: true,
                    minlength: 5
                }
            },
            // Specify validation error messages
            messages: {
                name: "Please enter your name",
                mobile_number: "Please enter your mobile number",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                //email: "Please enter a valid email address"
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>