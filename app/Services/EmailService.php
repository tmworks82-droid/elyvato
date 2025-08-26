<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use App\Services\CurlService;
use App\Services\EmailTemplateService;
use App\Http\Controllers\Api\V1\BaseController;

use Barryvdh\DomPDF\Facade\Pdf;

use Exception;
use Log;

class EmailService {

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';

        $this->curlService                  = new CurlService();
        $this->templateSer                  = new EmailTemplateService();
       

    }

    
    public function generateInvoicePdf($param)
    {
        // echo "<pre>";
        // print_r($param);
        // echo "</pre>";
        // die();

        $pdf = Pdf::loadView('admin.email.invoice_template01', compact('param'));

        // $pdf->setPaper('L');
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(0.2);
        $logoWidth = 600; // Adjust as needed
        $logoHeight = 600; // Adjust as needed
        $logoX = $width / 2 - $logoWidth / 2;
        $logoY = $height / 2 - $logoHeight / 2;

        // Add the logo image to the PDF
        $canvas->Image('dist/img/hmd-watermark.png', $logoX, $logoY, $logoWidth, $logoHeight);

        return $canvas;
    }


    function amountToWords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
            $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
            while( $x < $count_length ) {
                $get_divider = ($x == 2) ? 10 : 100;
                $amount = floor($num % $get_divider);
                $num = floor($num / $get_divider);
                $x += $get_divider == 10 ? 1 : 2;
                if ($amount) {
                    $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                    $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                    $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
                    '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
                    '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
                        }
                else $string[] = null;
            }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
        " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';

        return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise." Only";
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


    






    /**
     * 
     * Method
     * 
     * 
     */
    public function sendVerificationEmail($param) {
       
        $constant = config('constants.EMAIL');

        $url            = $constant['email_url'];
        $key            = $constant['email_api_key'];
        $from           = $constant['email_from'];

        $post = array('from' => $from,
        'fromName' => 'HMD INDIA',
        'apikey' => $key,
        'subject' => 'Please complete your signup process...',
        'to' => $param['email_id'],
        'bodyHtml' => $this->emailVerificationTemplate($param),
        'isTransactional' => true);

        $curlReturn = $this->curlService->curlReuqest($url, 'POST', [], $post);

        if($curlReturn[$this->status])
        {
            $response = [
                $this->status => true,
                $this->message => 'Successfully email Sent...',
                $this->code => 200,
                $this->data => $curlReturn,
            ];
        }
        else
        {
            $response = [
                $this->status => true,
                $this->message => 'Problem While sending email...',
                $this->code => 201,
                $this->data => $curlReturn,
            ];
        }

        return $response;
    }

    public function sendForgorPasswordEmail($param) {
       
        $constant       = config('constants.EMAIL');

        $url            = $constant['email_url'];
        $key            = $constant['email_api_key'];
        $from           = $constant['email_from'];

        $post = array('from' => $from,
        'fromName' => 'HMD INDIA',
        'apikey' => $key,
        'subject' => 'Forgot password ...',
        'to' => $param['email_id'],
        'bodyHtml' => $this->forgotEmailTemplate($param),
        'isTransactional' => true);

        $curlReturn = $this->curlService->curlReuqest($url, 'POST', [], $post);

        if($curlReturn[$this->status])
        {
            $response = [
                $this->status => true,
                $this->message => 'Successfully email Sent...',
                $this->code => 200,
                $this->data => $curlReturn,
            ];
        }
        else
        {
            $response = [
                $this->status => true,
                $this->message => 'Problem While sending email...',
                $this->code => 201,
                $this->data => $curlReturn,
            ];
        }
        
        

        return $response;
    }

/**
 * sendOrderConfirmationEmail
 * 
 */

    public function sendOrderConfirmationEmail($param) {      
        
        $constant       = config('constants.EMAIL');

        $url            = $constant['email_url'];
        $key            = $constant['email_api_key'];
        $from           = $constant['email_from'];

        $config = \ElasticEmail\Configuration::getDefaultConfiguration()->setApiKey('X-ElasticEmail-ApiKey', $key);
 
        $apiInstance = new \ElasticEmail\Api\EmailsApi(
            new \GuzzleHttp\Client(), $config
        );

        $email = new \ElasticEmail\Model\EmailMessageData(array(
            "recipients" => array(
                new \ElasticEmail\Model\EmailRecipient(array("email" => $param['email_id']))
            ),
            "content" => new \ElasticEmail\Model\EmailContent(array(
                "body" => array(
                    new \ElasticEmail\Model\BodyPart(array(
                        "content_type" => "HTML",
                        "content" => $this->templateSer->changeOrderConfirmationTemplate($param),
                    ))
                ),
                'fromName' => 'HMD INDIA',
                'name' => 'HMD IND',
                "from" => $from,
                "subject" => 'HMD INDIA - Status Update for Your Order Id #' . $param['order_id'],
                'isTransactional' => true,
            ))
        ));
         
        try {
            $sent = $apiInstance->emailsPost($email);            
            
            $response = [
                $this->status => true,
                $this->message => 'Successfully email Sent...',
                $this->code => 200,
                $this->data => [],
            ];
        
            
        } catch (Exception $e) {
            // echo 'Exception when calling EE API: ', $e->getMessage(), PHP_EOL;

            $response = [
                $this->status => true,
                $this->message => 'Problem While sending email...',
                $this->code => 201,
                $this->data => $e->getMessage(),
            ];

        }
        

        return $response;
    }


    /*
        sendOrderStatusEmail
    */
    public function sendOrderStatusEmail($param) {      
        
        $constant       = config('constants.EMAIL');

        $url            = $constant['email_url'];
        $key            = $constant['email_api_key'];
        $from           = $constant['email_from'];

        $config = \ElasticEmail\Configuration::getDefaultConfiguration()->setApiKey('X-ElasticEmail-ApiKey', $key);
 
        $apiInstance = new \ElasticEmail\Api\EmailsApi(
            new \GuzzleHttp\Client(), $config
        );

        $email = new \ElasticEmail\Model\EmailMessageData(array(
            "recipients" => array(
                new \ElasticEmail\Model\EmailRecipient(array("email" => $param['email_id']))
            ),
            "content" => new \ElasticEmail\Model\EmailContent(array(
                "body" => array(
                    new \ElasticEmail\Model\BodyPart(array(
                        "content_type" => "HTML",
                        "content" => $this->templateSer->changeOrderStatusTemplate($param),
                    ))
                ),
                'fromName' => 'HMD INDIA',
                'name' => 'HMD IND',
                "from" => $from,
                "subject" => 'HMD INDIA - Status Update for Your Order Id #' . $param['order_id'],
                'isTransactional' => true
            ))
        ));
         
        try {
            $sent = $apiInstance->emailsPost($email);            
            
            $response = [
                $this->status => true,
                $this->message => 'Successfully email Sent...',
                $this->code => 200,
                $this->data => [],
            ];
        
            
        } catch (Exception $e) {
            $response = [
                $this->status => true,
                $this->message => 'Problem While sending email...',
                $this->code => 201,
                $this->data => $e->getMessage(),
            ];

        }
        

        return $response;
    }


    /*
        sendOrderDeliverEmail
    */
    public function sendOrderDeliverEmail($param) {      
        
        $constant       = config('constants.EMAIL');

        $url            = $constant['email_url'];
        $key            = $constant['email_api_key'];
        $from           = $constant['email_from'];

        $param['amount_in_word']    = $this->amountToWords($param['paid_amount']);
        // Generate invoice PDF
        $pdf = $this->generateInvoicePdf($param);
        $pdfBase64String = base64_encode($pdf->output());

        $config = \ElasticEmail\Configuration::getDefaultConfiguration()->setApiKey('X-ElasticEmail-ApiKey', $key);
 
        $apiInstance = new \ElasticEmail\Api\EmailsApi(
            new \GuzzleHttp\Client(), $config
        );

        $email = new \ElasticEmail\Model\EmailMessageData(array(
            "recipients" => array(
                new \ElasticEmail\Model\EmailRecipient(array("email" => $param['email_id']))
            ),
            "content" => new \ElasticEmail\Model\EmailContent(array(
                "body" => array(
                    new \ElasticEmail\Model\BodyPart(array(
                        "content_type" => "HTML",
                        "content" => $this->templateSer->changeOrderDeliverTemplate($param),
                    ))
                ),
                'fromName' => 'HMD INDIA',
                'name' => 'HMD IND',
                "from" => $from,
                "subject" => 'HMD INDIA - Status Update for Your Order Id #' . $param['order_id'],
                'isTransactional' => true,
                'attachments' => [
                    [
                        "BinaryContent"     => $pdfBase64String,
                        "Name"              => "Invoice".$param['order_id'].".pdf",
                        "ContentType"       => "application/pdf"
                    ]
                ],
            ))
        ));
         
        try {
            $sent = $apiInstance->emailsPost($email);            
            
            $response = [
                $this->status => true,
                $this->message => 'Successfully email Sent...',
                $this->code => 200,
                $this->data => [],
            ];
        
            
        } catch (Exception $e) {
            // echo 'Exception when calling EE API: ', $e->getMessage(), PHP_EOL;

            $response = [
                $this->status => true,
                $this->message => 'Problem While sending email...',
                $this->code => 201,
                $this->data => $e->getMessage(),
            ];

        }
        

        return $response;
    }








}
