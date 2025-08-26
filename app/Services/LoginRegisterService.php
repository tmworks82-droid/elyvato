<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Log;
use DB;
use App\Services\JwtService;
use App\Models\User;
use App\Models\ForgotData;
use Illuminate\Support\Facades\Hash;
use App\Services\CommonService;
use App\Services\OtpService;
use App\Services\EmailService;

use Exception;




class LoginRegisterService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->commonSer                    = new CommonService();
        $this->emailService                 = new EmailService();
        $this->otpService                   = new OtpService();
        
    }
    


    



    public function loginUser($param)
    {
        $jwtServ = new JwtService();
        $result = $jwtServ->genarateToken($param);
        return $result;
    }





    public function fetchUserDetails($param)
    {
        $details  = User::where('id',$param['user_id'])->first();
        
        if($details)
        {
            $details->makeVisible(['email_key', 'is_email_verify', 'email_verified_at']);
            $details                        = $details->toArray();

            
            $return[$this->status]          = true;
            $return[$this->message]         = 'Successfully user found...';
            $return[$this->code]            = 200;
            $return[$this->data]            = $details;
            
        }
        else
        {
            $return[$this->status]          = false;
            $return[$this->message]         = 'User not found...';
            $return[$this->code]            = 404;
            $return[$this->data]            = [];
        }

        return $return;
    }





}
