<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Services\CurlService;
use App\Http\Controllers\Api\V1\BaseController;

use Barryvdh\DomPDF\Facade\Pdf;

use Exception;
use Log;

class EmailTemplateService {

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';

        $this->curlService                  = new CurlService();
       

    }

    


    public function emailVerificationTemplate($param) {

        $base_url   = config('constants.internal.EMAIL_VERIFY_URL');;
        $name       = $param['name'];
        $phone      = $param['mobile'];
        $emailid    = $param['email_id'];
        $email_key  = $param['email_key'];
        $user_id    = $param['user_id'];

        return 
         '<html>
            <body>
            <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
                            <table style="width: 100%;">
                                <tr>
                                    <td bgcolor="#FFFFFF ">
                                        <div style="padding: 15px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid #4D901A;">
                                            <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td rowspan="2" style="text-align:center;padding:10px;">
                                                                        <img style="float:left;" width="200" src="https://hmdindia.in/assets/logo192.png" alt="HMD INDIA"/> 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <table style="padding: 10px;font-size:14px; width:100%; background-color: #000;">
                                                <tr>
                                                    <td style="padding:10px;font-size:14px; width:100%;">
                                                        <p style="color: #fff;">
                                                            Hi '.$name.',
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Welcome to HMD INDIA, Your account has been created
                                                        </p>
                                                        <p style="color: #fff;">
                                                            <span>
                                                                Email:-
                                                            </span>
                                                            <span>'.$emailid.'</span>
                                                        </p>
                                                        <p style="color: #fff;">
                                                            <span>
                                                                Mobile:-
                                                            </span>
                                                            <span>'.$phone.'</span>
                                                        </p>
                                                        <br />
                                                        <p style="color: #fff;">
                                                            <b>Note:-</b>This mail is regards with your email verification. Kindly click below button to verify.
                                                        </p>
                                                        <br />
                                                        <p style="text-align: center;">
                                                            <a href="'.$base_url.'profile/success?code='.$email_key.'&uId='.base64_encode($user_id).'" target="_blank" style="font-size:12px;border: 1px solid #4D901A; color: #4D901A; background-color: transparent;padding: 10px 15px;text-decoration: none; cursor: pointer;">
                                                                Click Here to verify
                                                            </a>
                                                        </p>
                                                        <br />
                                                        <p style="color: #fff;">
                                                            If you are unable to click on the above button, kindly click on below given url to verify your email address
                                                        </p>
                                                        <br />
                                                        <p style="color: #fff;">
                                                            URL : <a style="color: blue;" href="'.$base_url.'profile/success?code='.$email_key.'&uId='.base64_encode($user_id).'" target="_blank">'.base64_encode($base_url.'profile/success?code='.$email_key).'&uId='.base64_encode($user_id).'</a>
                                                        </p>
                                                        <p> </p>
                                                        <p style="color: #fff;">Thank you & regards <br>
                                                            HMD INDIA Team
                                                        </p>
                                                        <!-- /Callout Panel -->
                                                        <!-- FOOTER -->
                                                    </td>
                                                </tr>
                                                <tr> 
                                                    <td>
                                                        <div align="left" style="font-size:12px; margin: 10px 0; padding:10px 0; width:100%; background: #4D901A;">
                                                            <span style="float:center; margin-right: 10px;">
                                                                <ul style="    list-style: none;margin: 0;padding: 0;">
                                                                    <li style="display: inline-block;margin-right: 10px;vertical-align: top;margin-top: 5px;">
                                                                        <span style="color: #fff;">Follow us:</span>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.facebook.com/hmdpureorganic" target="_blank" title="Facebook">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/3.png" alt="Facebook">
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.instagram.com/hmd___india/" target="_blank"  title="Instagram">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/2.png" alt="Instagram">
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                    <td>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            This mail was sent  to 
                                                                '.$emailid.'
                                                        </small>   <br>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            Copyright &copy; '.date('Y').' <a target="_blank" href="https://hmdindia.in"> HMD INDIA </a>. All rights reserved.
                                                        </small>
                                                    </td>
                                                </tr>
                                            </table>   
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </body>
                </html> ';

    }

    


    public function forgotEmailTemplate($param) {
        $name       = $param['name'];
        $emailid    = $param['email_id'];
        $code       = $param['otp'];
        

        return 
         '<html>
            <body>
            <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
                            <table style="width: 100%;">
                                <tr>
                                    <td bgcolor="#FFFFFF ">
                                        <div style="padding: 15px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid #4D901A;">
                                            <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td rowspan="2" style="text-align:center;padding:10px;">
                                                                        <img style="float:left;" width="150" src="https://hmdindia.in/assets/logo192.png" alt="HMD INDIA" /> 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <table style="padding: 10px;font-size:14px; width:100%; background-color: #000;">
                                                <tr>
                                                    <td style="padding:10px;font-size:14px; width:100%;">
                                                        <p style="color: #fff;">
                                                            Hi '.$name.',
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Welcome to HMD INDIA, This email is in regards with your forgot password request. 
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Please find below your six digit verification code for your account
                                                        </p>

                                                        <p style="color: #fff;">
                                                            <span>
                                                                6 Digit Code:-
                                                            </span>
                                                            <h1><span style="color: #fff;">'.$code.'</span></h1>
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Please enter your six digit verification code to verify your account.
                                                        </p>


                                                        <br />
                                                        
                                                        <p> </p>
                                                        <p style="color: #fff;">Thank you & regards <br>
                                                            HMD INDIA Team
                                                        </p>
                                                        <!-- /Callout Panel -->
                                                        <!-- FOOTER -->
                                                    </td>
                                                </tr>
                                                
                                                <tr style="text-align: center;">
                                                    <td>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            This mail was sent  to 
                                                                '.$emailid.'
                                                        </small>   <br>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            Copyright &copy; '.date('Y').' <a target="_blank" href="https://hmdindia.in"> HMD INDIA </a>. All rights reserved.
                                                        </small>
                                                    </td>
                                                </tr>
                                            </table>   
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </body>
                </html> ';

    }


    public function changeOrderStatusTemplate($param) {
        $name       = $param['name'];
        $emailid    = $param['email_id'];
        $status       = $param['status'];
        
        

        return 
         '<html>
            <body>
            <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
                            <table style="width: 100%;">
                                <tr>
                                    <td bgcolor="#FFFFFF ">
                                        <div style="padding: 15px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid #4D901A;">
                                            <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td rowspan="2" style="text-align:center;padding:10px;">
                                                                        <img style="float:left;" width="150" src="https://hmdindia.in/assets/logo192.png" alt="HMD INDIA" /> 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <table style="padding: 10px;font-size:14px; width:100%; background-color: #000;">
                                                <tr>
                                                    <td style="padding:10px;font-size:14px; width:100%;">
                                                        <p style="color: #fff;">
                                                            Hi '.$name.',
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Welcome to HMD INDIA, This email is in regards with your status update of your order. 
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Please find below your current status of your order
                                                        </p>

                                                        <p style="color: #fff;">
                                                            <span>
                                                                <h1 style="color: #4D901A; text-align:center; background:#7e080c">'.$status.'</h1>
                                                            </span>                                                            
                                                        </p>
                                                        
                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Order No
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['order_id'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Date
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['date'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Payment Mode
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['pay_mode'].'</b>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        
                                                        


                                                        <br />
                                                        
                                                        <p> </p>
                                                        <p style="color: #fff;">Thank you & regards <br>
                                                            HMD INDIA Team
                                                        </p>
                                                        <!-- /Callout Panel -->
                                                        <!-- FOOTER -->
                                                    </td>
                                                </tr>

                                                <tr> 
                                                    <td>
                                                        <div align="left" style="font-size:12px; margin: 10px 0; padding:10px 0; width:100%; background: #4D901A;">
                                                            <span style="float:center; margin-right: 10px;">
                                                                <ul style="    list-style: none;margin: 0;padding: 0;">
                                                                    <li style="display: inline-block;margin-right: 10px;vertical-align: top;margin-top: 5px;">
                                                                        <span style="color: #fff;">Follow us:</span>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.facebook.com/hmdpureorganic" target="_blank" title="Facebook">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/3.png" alt="Facebook">
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.instagram.com/hmd___india/" target="_blank"  title="Instagram">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/2.png" alt="Instagram">
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="text-align: center;">
                                                    <td>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            This mail was sent  to 
                                                                '.$emailid.'
                                                        </small>   <br>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            Copyright &copy; '.date('Y').' <a target="_blank" href="https://hmdindia.in"> HMD INDIA </a>. All rights reserved.
                                                        </small>
                                                    </td>
                                                </tr>
                                            </table>   
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </body>
                </html> ';

    }

    public function changeOrderConfirmationTemplate($param) {
        $name       = $param['name'];
        $emailid    = $param['email_id'];
        $status       = $param['status'];
        
        $annas = $coupon = "";

        $item = 
                '
                <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                    <tr>
                        <th style="text-align:left;padding:10px;color: #fff;">
                            Item Name
                        </th>
                        <th style="text-align:right;padding:10px;color: #4D901A;">
                            Qnty
                        </th>
                        <th style="text-align:right;padding:10px;color: #4D901A;">
                            Amount
                        </th>
                        <th style="text-align:right;padding:10px;color: #4D901A;">
                            Total
                        </th>
                    </tr>';

            foreach($param['orderDetails'] as $key => $val)
            {
                $item .= 
                '
                
                    <tr>
                        <td style="text-align:left;padding:10px;color: #fff;">
                            '.substr($val['name'], 0, 50) . '...'.' | <b>'.$val['sku_name'].'</b>
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            '.$val['count'].'
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            '.$val['amount'].'
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            '.$val['total_amount'].'
                        </td>
                    </tr>'
                
                ;
         
            }
            $item .= 
                
                '</table>'
                ;


            if($param['is_annas_used'])
            {
                $annas = '
                <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                    <tr>
                        <td style="text-align:left;padding:10px;color: #fff;">
                            Annas Used
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            <b>'.$param['annas_amount'].'</b>
                        </td>
                    </tr>                                                      
                </table>
                ';
            }

            if($param['is_coupon'])
            {
                $coupon = '
                <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                    <tr>
                        <td style="text-align:left;padding:10px;color: #fff;">
                            Coupon Code
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            <b>'.$param['coupon']['coupon_code'].'</b>
                        </td>
                    </tr>                                                      
                </table>
                ';
            }


            if($param['pay_mode']  == 'cod')
            {
                $amountText = 'Need to pay ';
            }
            else {
                $amountText = 'Paid Amount';
            }
        return 
         '<html>
            <body>
            <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
                            <table style="width: 100%;">
                                <tr>
                                    <td bgcolor="#FFFFFF ">
                                        <div style="padding: 15px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid #4D901A;">
                                            <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td rowspan="2" style="text-align:center;padding:10px;">
                                                                        <img style="float:left;" width="150" src="https://hmdindia.in/assets/logo192.png" alt="HMD INDIA" /> 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <table style="padding: 10px;font-size:14px; width:100%; background-color: #000;">
                                                <tr>
                                                    <td style="padding:10px;font-size:14px; width:100%;">
                                                        <p style="color: #fff;">
                                                            Hi '.$name.',
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Welcome to HMD INDIA, This email is in regards with your status update of your order. 
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Please find below your current status of your order
                                                        </p>

                                                        <p style="color: #fff;">
                                                            <span>
                                                                <h1 style="color: #4D901A; text-align:center; background:#7e080c">'.$status.'</h1>
                                                            </span>                                                            
                                                        </p>
                                                        
                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Order No
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['order_id'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Date
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['date'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Payment Mode
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['pay_mode'].'</b>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        '.$item.'
                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Sub Total
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['sub_total'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Discount
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['discount'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Tax
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['tax'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Total Amount
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['total_amount'].'</b>
                                                                </td>
                                                            </tr>
                                                            
                                                        </table>
                                                        '.$annas.'
                                                        '.$coupon.'
                                                    
                                                        <p> </p>

                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                '.$amountText.'
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['paid_amount'].'</b>
                                                                </td>
                                                            </tr>                                                            
                                                        </table>


                                                        <br />
                                                        
                                                        <p> </p>
                                                        <p style="color: #fff;">Thank you & regards <br>
                                                            HMD INDIA Team
                                                        </p>
                                                        <!-- /Callout Panel -->
                                                        <!-- FOOTER -->
                                                    </td>
                                                </tr>

                                                <tr> 
                                                    <td>
                                                        <div align="left" style="font-size:12px; margin: 10px 0; padding:10px 0; width:100%; background: #4D901A;">
                                                            <span style="float:center; margin-right: 10px;">
                                                                <ul style="    list-style: none;margin: 0;padding: 0;">
                                                                    <li style="display: inline-block;margin-right: 10px;vertical-align: top;margin-top: 5px;">
                                                                        <span style="color: #fff;">Follow us:</span>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.facebook.com/hmdpureorganic" target="_blank" title="Facebook">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/3.png" alt="Facebook">
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.instagram.com/hmd___india/" target="_blank"  title="Instagram">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/2.png" alt="Instagram">
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="text-align: center;">
                                                    <td>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            This mail was sent  to 
                                                                '.$emailid.'
                                                        </small>   <br>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            Copyright &copy; '.date('Y').' <a target="_blank" href="https://hmdindia.in"> HMD INDIA </a>. All rights reserved.
                                                        </small>
                                                    </td>
                                                </tr>
                                            </table>   
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </body>
                </html> ';

    }


    
    public function changeOrderDeliverTemplate($param) {
        $name       = $param['name'];
        $emailid    = $param['email_id'];
        $status       = $param['status'];
        
        $annas = $coupon = "";

        $item = 
                '
                <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                    <tr>
                        <th style="text-align:left;padding:10px;color: #fff;">
                            Item Name
                        </th>
                        <th style="text-align:right;padding:10px;color: #4D901A;">
                            Qnty
                        </th>
                        <th style="text-align:right;padding:10px;color: #4D901A;">
                            Amount
                        </th>
                        <th style="text-align:right;padding:10px;color: #4D901A;">
                            Total
                        </th>
                    </tr>';

            foreach($param['orderDetails'] as $key => $val)
            {
                $item .= 
                '
                
                    <tr>
                        <td style="text-align:left;padding:10px;color: #fff;">
                            '.substr($val['name'], 0, 50) . '...'.' | <b>'.$val['sku_name'].'</b>
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            '.$val['count'].'
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            '.$val['amount'].'
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            '.$val['total_amount'].'
                        </td>
                    </tr>'
                
                ;
         
            }
            $item .= 
                
                '</table>'
                ;


            if($param['is_annas_used'])
            {
                $annas = '
                <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                    <tr>
                        <td style="text-align:left;padding:10px;color: #fff;">
                            Annas Used
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            <b>'.$param['annas_amount'].'</b>
                        </td>
                    </tr>                                                      
                </table>
                ';
            }

            if($param['is_coupon'])
            {
                $coupon = '
                <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                    <tr>
                        <td style="text-align:left;padding:10px;color: #fff;">
                            Coupon Code
                        </td>
                        <td style="text-align:right;padding:10px;color: #4D901A;">
                            <b>'.$param['coupon']['coupon_code'].'</b>
                        </td>
                    </tr>                                                      
                </table>
                ';
            }

        return 
         '<html>
            <body>
            <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
                            <table style="width: 100%;">
                                <tr>
                                    <td bgcolor="#FFFFFF ">
                                        <div style="padding: 15px; max-width: 800px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid #4D901A;">
                                            <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td rowspan="2" style="text-align:center;padding:10px;">
                                                                        <img style="float:left;" width="150" src="https://hmdindia.in/assets/logo192.png" alt="HMD INDIA" /> 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <table style="padding: 10px;font-size:14px; width:100%; background-color: #000;">
                                                <tr>
                                                    <td style="padding:10px;font-size:14px; width:100%;">
                                                        <p style="color: #fff;">
                                                            Hi '.$name.',
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Welcome to HMD INDIA, This email is in regards with your status update of your order. 
                                                        </p>
                                                        <p style="color: #fff;"><br />
                                                             Please find below your current status of your order
                                                        </p>

                                                        <p style="color: #fff;">
                                                            <span>
                                                                <h1 style="color: #4D901A; text-align:center; background:#7e080c">'.$status.'</h1>
                                                            </span>                                                            
                                                        </p>
                                                        
                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Order No
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['order_id'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Date
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['date'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Payment Mode
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['pay_mode'].'</b>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        '.$item.'
                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Sub Total
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['sub_total'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Discount
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['discount'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Tax
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['tax'].'</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Total Amount
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['total_amount'].'</b>
                                                                </td>
                                                            </tr>
                                                            
                                                        </table>
                                                        '.$annas.'
                                                        '.$coupon.'
                                                    
                                                        <p> </p>

                                                        <table style="width: 100%;background: #000;border-bottom: 1px solid #4D901A;">
                                                            <tr>
                                                                <td style="text-align:left;padding:10px;color: #fff;">
                                                                    Paid Amount
                                                                </td>
                                                                <td style="text-align:right;padding:10px;color: #4D901A;">
                                                                    <b>'.$param['paid_amount'].'</b>
                                                                </td>
                                                            </tr>                                                            
                                                        </table>


                                                        <br />
                                                        
                                                        <p> </p>
                                                        <p style="color: #fff;">Thank you & regards <br>
                                                            HMD INDIA Team
                                                        </p>
                                                        <!-- /Callout Panel -->
                                                        <!-- FOOTER -->
                                                    </td>
                                                </tr>

                                                <tr> 
                                                    <td>
                                                        <div align="left" style="font-size:12px; margin: 10px 0; padding:10px 0; width:100%; background: #4D901A;">
                                                            <span style="float:center; margin-right: 10px;">
                                                                <ul style="    list-style: none;margin: 0;padding: 0;">
                                                                    <li style="display: inline-block;margin-right: 10px;vertical-align: top;margin-top: 5px;">
                                                                        <span style="color: #fff;">Follow us:</span>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.facebook.com/hmdpureorganic" target="_blank" title="Facebook">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/3.png" alt="Facebook">
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: inline-block;margin-right: 10px;">
                                                                        <a href="https://www.instagram.com/hmd___india/" target="_blank"  title="Instagram">
                                                                            <img width="25" height="25" src="http://secure.moviflex.in/secure-images/social/2.png" alt="Instagram">
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="text-align: center;">
                                                    <td>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            This mail was sent  to 
                                                                '.$emailid.'
                                                        </small>   <br>
                                                        <small style="color: #4D901A; text-align: left;">
                                                            Copyright &copy; '.date('Y').' <a target="_blank" href="https://hmdindia.in"> HMD INDIA </a>. All rights reserved.
                                                        </small>
                                                    </td>
                                                </tr>
                                            </table>   
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </body>
                </html> ';

    }


    
    










}
