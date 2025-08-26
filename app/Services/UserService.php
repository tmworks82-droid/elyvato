<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Api\V1\BaseController;
use Log;
use Validator;
use App\Models\Admin;
use App\Exceptions;
use Illuminate\Support\Facades\Hash;


class UserService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';
       

    }
    
   



    /**
        * User Code
        * method fetchAllAdminUser()
        * 
        * @param[]
        * NA
        * 
        * @condition
        * is_active = 1
        * status = 1
        * 
        * 
        * 
        * @return 
        * 200
        * 
        * @error
        * 404
        * 
    **/
    
    
    public static function fetchAllAdminUser()
    {
        return Admin::where('is_active', 1)
            ->where('status', 1)
            ->get();
    }
    
    public static function fetchAdminUserNameById($id)
    {
        return Admin::where('is_active', 1)
            ->where('id', $id)
            ->where('status', 1)
            ->first();
    }


    public function fetchOneAllTelicaller()
    {
        $result = Admin::where('is_active', 1)
            ->where('role_id', 7)
            ->where('status', 1)
            ->first();

        return $result;
    }







}
