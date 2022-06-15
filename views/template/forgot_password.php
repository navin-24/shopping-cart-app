<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Forgot Password</title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&display=swap' rel='stylesheet'>
    <style>
        * {
            -ms-text-size-adjust: 100%;
        }
        
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        
        img {
            -ms-interpolation-mode: bicubic;
        }
        
        a {
            text-decoration: none;
        }
        
        table {
            border-collapse: collapse;
        }
        
        table td {
            padding: 8px;
        }
        
        .table {
            margin: 0 auto;
            max-width: 600px;
            width: 100%;
            text-align: center;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
        
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p
        {
            margin: 0;
            padding: 0;
        }
        
        h2 {
            font-weight: 500;
        }
        
        h3 {
            font-weight: 400;
        }
        
        .para {
            color: #555;
            line-height: 22px;
            font-size: 14px;
        }
        
        .f14 {
            font-size: 14px !important;
        }
        
        .f16 {
            font-size: 16px !important;
        }
        
        .bg-light {
            background: #f3f3f3;
        }

        .logo {
            margin: 15px 0 15px 0;
        }
        
        .header .slogan {
            font-size: 16px;
        }
        
        .header {
            color: #fff;
            padding: 30px;
        }
        
        .header .image {
            margin: 20px 0 5px 0;
        }
        
        .header h1 {
            margin: 0 0 10px 0;
        }
        
        .content .para {
            max-width: 500px;
            margin: 0 auto 15px auto;
        }
        
        .content h2,
        .content h3 {
            color: #000;
        }
        
        .tabledata tr th,
        .tabledata tr td {
            padding: 6px 12px;
        }
        
        .tabledata tr th {
            border-top: 1px solid #ddd;
            color: #000;
        }
        
        .tabledata .para {
            margin: 0 0 0 0;
        }

        .link {
            margin: 0 15px 0 0;
            padding: 5px 5px 0 5px;
            border: 1px solid #ccc;
            background: #fff;
            display: inline-block;
            text-align: center;
            width: 26px;
            height: 26px;
        }
        
        .copy {
            color: #777;
            font-size: 14px;
            padding: 5px 0 8px 0;
            text-decoration: none;
            display: block;
        }
    </style>
</head>


<body width='100%' style='margin: 0 auto; max-width:600px; width:100%; padding: 0 !important; mso-line-height-rule: exactly; font-family: Ubuntu, arial, sans-serif;'>

    <table class='table header' cellspacing='0' cellpadding='0' border='0'>
         <tr>
                <td style='background: #000;'>
                    <a href='https://www.rawpressery.com/' target='_blank'>
                        <img class='logo' src='<?= ASSET_URL . 'imgs/white-logo.png'; ?>' width='60' alt='Raw Pressery'>
                    </a>
                </td>
            </tr>
        <tr>
            <td style='background: #000;'>
                <img class='image'  src='<?= ASSET_URL . 'imgs/emailer/forgot-password.png'; ?>' width='70'>
                <h1>Forgot Password!</h1>
                <p class='slogan' style='margin: 0 0 15px 0;'>Reset Password Request.</p>
            </td>
        </tr>
    </table>

    <table class='table content' cellspacing='0' cellpadding='0' border='0'>
        <tr>
            <td style='padding-top:30px;'>
                <h2>Hi!</h2>
            </td>
        </tr>
        <tr>
            <td>
                <h3>To reset your password click the link below.</h3>
            </td>
        </tr>
        <tr>
            <td>
                <p class='para'>
                    That’s okay, It Happens! Click on the button below to reset your password. If you are having trouble clicking the password button then right click on the button and click on “copy link address” and then paste it in the browser.
If you did not make this request, just ignore this email.
                </p>
            </td>
        </tr>
        <tr>
            <td style='padding:0;'>
                <table cellspacing='0' cellpadding='0' border='0' style='margin:0 auto 15px auto; max-width:290px;'>
                    <tr>
                        <td style='background: #009432; color: #fff; padding:10px 15px; text-decoration: none; font-size: 16px; font-weight: 600; text-align:center;'>
                            <a href='<?= base_url().'resetPassword/'.$token?>' style='color:#fff;margin:0;padding:0;display:block;'>Reset My Password</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class='table footer' cellspacing='0' cellpadding='0' border='0'>
            <tr>
                <td style='text-align: left;'>
                    <p class='para' style='margin-top:10px;'><b>Follow Us On</b></p>
                    <a class='link' href='https://www.facebook.com/Rawpressery/' target='_blank'><img src='<?= ASSET_URL . 'imgs/emailer/facebook.png' ?>' alt=''></a>
                    <a class='link' href='https://www.instagram.com/rawpressery/' target='_blank'><img src='<?= ASSET_URL . '/imgs/emailer/instagram.png' ?>' alt=''></a>
                    <a class='link' href='https://twitter.com/rawpressery?lang=en' target='_blank'><img src='<?= ASSET_URL . '/imgs/emailer/twitter.png' ?>' alt=''></a>
                </td>
                <td align='right'>
                    <p class='para' style='margin-top:18px;'><b>Customer Care</b></p>
                    <p class='para'>+91 9920-453-453</p>
                    <p class='para'>getmore@rawpressery.com</p>
                </td>
            </tr>
        </table>

    <table class='table copyright' cellspacing='0' cellpadding='0' border='0'>
        <tr>
            <td style='padding:5px; background: #000;'>
                <a class='copy' href='https://www.rawpressery.com/' target='_blank'>www.rawpressery.com</a>
            </td>
        </tr>
    </table>
</body>
</html>