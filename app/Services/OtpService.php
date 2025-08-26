<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Log;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Services\CurlService;




class OtpService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->curlSer                      = new CurlService();
    }
    
    /*
        @param name
        @param mobile
        @param otp
    */

    
    public function generateOtp($param)
    {
        $return[$this->status]              = false;
        $return[$this->message]             = 'Oops, something went wrong...';
        $return[$this->code]                = 201;
        $return[$this->data]                = [];

        $mobile_key                         = $param['otp'];
        $phone                              = $param['mobile'];
        $name                               = 'welcome to HMD INDIA';
        $config                             = config('constants.otp_message');
        $username                           = $config['sms_user_name'];
        $password                           = $config['sms_password'];
        $senderId                           = $config['sms_sender_id'];
        $authKey                            = $config['auth_key'];
        $templateId                         = $config['template_id'];
        $url1                               = $config['sms_url'];

        $header                             = array();
        $result                             = array();
        
        $message                            = 'Hi '.$name.', Your OTP is '.$mobile_key.'. Please use this OTP to verify your mobile number '.$phone.'.';
        // $message                            = 'Hi, Your HMD INDIA 6 digit verification code is '.$mobile_key.'. Please use this to register your mobile number '.$phone.'.CHRISTOMEDIA';
        $data                               = 'authentic-key='.$authKey.'&senderid='.$senderId.'&route=1&number='.$phone.'&message='.$message.'&templateid='.$templateId;
        $curlResponse                       = $this->curlSer->curlReuqest($url1, 'POST', $header, $data);

        if($curlResponse[$this->status])
        {
            $return[$this->status]          = true;
            $return[$this->message]         = 'Successfully otp sent to your number '.$phone;
            $return[$this->code]            = 200;
            $return[$this->data]            = $curlResponse;
        }
        else
        {
            $return[$this->status]          = true;
            $return[$this->message]         = 'Oops, problem in sending otp...';
            $return[$this->code]            = 200;
            $return[$this->data]            = $curlResponse;
        }

        return $return;
    }





}
