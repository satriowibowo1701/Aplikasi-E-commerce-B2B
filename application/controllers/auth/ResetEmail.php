<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetEmail extends CI_Controller
{

    public function send($email, $token)
    {
        $html = '<!DOCTYPE html>
        <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
        
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css">
            <!--<![endif]-->
            <style>
                * {
                    box-sizing: border-box;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }
        
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }
        
                p {
                    line-height: inherit
                }
        
                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }
        
                @media (max-width:670px) {
        
                    .image_block img.big,
                    .row-content {
                        width: 100% !important;
                    }
        
                    .mobile_hide {
                        display: none;
                    }
        
                    .stack .column {
                        width: 100%;
                        display: block;
                    }
        
                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>
        </head>
        
        <body style="background-color: #85a4cd; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
            <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #85a4cd;">
                <tbody>
                    <tr>
                        <td>
                            <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="heading_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;text-align:center;width:100%;padding-top:60px;">
                                                                        <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: \'Roboto Slab\', Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 30px; font-weight: 400; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">Reset Password</span></h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="image_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                                                        <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/3856/GIF_password.gif" style="display: block; height: auto; border: 0; width: 500px; max-width: 100%;" width="500" alt="Wrong Password Animation" title="Wrong Password Animation"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-5" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:5px;padding-left:10px;padding-right:10px;padding-top:25px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #3f4d75; line-height: 1.2; font-family: Roboto Slab, Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:20px;">Jangan Khawatir</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-6" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:5px;padding-left:10px;padding-right:10px;padding-top:5px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #3f4d75; line-height: 1.2; font-family: Roboto Slab, Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:22px;">Segera Ganti Password Anda Ke Password Baru</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="button_block block-8" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center;">
                                                                        <div class="alignment" align="center">
                                                                            <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="www.example.com" style="height:60px;width:240px;v-text-anchor:middle;" arcsize="17%" strokeweight="1.5pt" strokecolor="#3F4D75" fillcolor="#ffffff"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#3f4d75; font-family:Arial, sans-serif; font-size:18px"><![endif]--><a href="' . base_url('auth/forgot/reset/' . $token) . '" target="_blank" style="text-decoration:none;display:inline-block;color:#3f4d75;background-color:#ffffff;border-radius:10px;width:auto;border-top:2px solid #3F4D75;font-weight:400;border-right:2px solid #3F4D75;border-bottom:2px solid #3F4D75;border-left:2px solid #3F4D75;padding-top:10px;padding-bottom:10px;font-family:Roboto Slab, Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:25px;padding-right:25px;font-size:18px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="word-break: break-word;"><span style="line-height: 36px;" dir="ltr" data-mce-style>Klik Disini Untuk Reset</span></span></span></a>
                                                                            <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-10" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:40px;padding-left:10px;padding-right:10px;padding-top:30px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #3f4d75; line-height: 1.2; font-family: Roboto Slab, Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; font-size: 14px; text-align: center;"><span style="font-size:14px;">Jika Kamu Tidak Melakukan Reset Password Maka Abaikan Email Ini!!.</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f3f6fe;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 650px;" width="650">
                                                <tbody>
                                                    <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                            <table class="social_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:50px;text-align:center;">
                                                                        <div class="alignment" style="text-align:center;"   >
                                                                            <table class="social-table" width="208px" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;">
                                                                                <tr>
                                                                                    <td style="padding:0 10px 0 10px;"><a href="https://www.facebook.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/facebook@2x.png" width="32" height="32" alt="Facebook" title="facebook" style="display: block; height: auto; border: 0;"></a></td>     
                                                                                    <td style="padding:0 10px 0 10px;"><a href="https://www.instagram.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/instagram@2x.png" width="32" height="32" alt="Instagram" title="instagram" style="display: block; height: auto; border: 0;"></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                <tr>
                                                                    <td class="pad" style="padding-bottom:40px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                                        <div style="font-family: sans-serif">
                                                                            <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #212323; line-height: 1.2; font-family: Roboto Slab, Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                                <p style="margin: 0; text-align: center; font-size: 16px;"><span style="font-size:16px;">' . get_settings('store_name') . '</span></p>
                                                                                <p style="margin: 0; text-align: center; font-size: 16px;"><span style="font-size:16px;">' . get_settings('store_address') . '</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table><!-- End -->
        </body>
        
        </html>';
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => get_settings('sender'),
            'smtp_pass'   => get_settings('pass_mail'),
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->from(get_settings('sender'), get_settings('store_name'));
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $this->email->message($html);
        $this->email->send();
        $this->email->print_debugger(array('headers'));
    }
}
