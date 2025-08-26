<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Models\User;
use App\Models\Admin;
use JWTAuth;



class JwtService
{

    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }
    

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    public function genarateToken($all)
    {
        $return[$this->status]                  = false;
        $return[$this->message]                 = 'Email id not found...';
        $return[$this->code]                    = 404;
        $return[$this->data]                    = [];

        $user                                   = Admin::where(
            [
                ["email", "=", $all['email_id']], 
            ])->first();

        if($user)
        {
            $return[$this->status]              = false;
            $return[$this->message]             = 'Incorrect Password...';
            $return[$this->code]                = 401;
            $return[$this->data]                = [];

            if (Hash::check($all['password'], $user->password)) 
            {
                
                $result                         = $this->respondWithToken($user);
                $return[$this->status]          = true;
                $return[$this->message]         = 'Successfully login..';
                $return[$this->code]            = 200;
                $return[$this->data]            = $result;
            }           
        }        

        return $return;        
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($user)
    {
        $userData['user_id']            = $user->id;
        $userData['name']               = $user->name;
        $userData['email']              = $user->email;
        $userData['department_id']       = $user->department_id;
        
        $token = JWTAuth::fromUser($user->first());
        $result = [
            'user_data'                 => $userData,
            'access_token'              => $token,
            'token_type'                => 'bearer',
            'expires_in'                => JWTAuth::factory()->getTTL()*60,
        ];
        
        return $result;
    }




}
