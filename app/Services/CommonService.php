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
use App\Models\User;
use App\Models\Product;
use App\Models\ContactUs;
use App\Models\Teams;
use App\Models\ReturnOrder;
use App\Models\Payment;
use App\Exceptions;
use Illuminate\Support\Facades\Hash;
use App\Services\OrderService;



class CommonService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';
        
        
        
    }
    
    /*
    
        If inputValidators() @method is not properly working try to run composer dump auto load command

        composer dump-autoload;php artisan cache:clear;php artisan config:clear;php artisan route:clear;php artisan view:clear;php artisan config:cache;php artisan cache:clear;

    
    */
    
    public function inputValidators($apiValidationConfigName, $params) {
        $pageParams = config('validator-config.api_validations.' . $apiValidationConfigName);
        $validate['status'] = true;
        $rules = [];
        foreach ($pageParams as $pageKey => $pageParam) {
            if (count($pageParam)) {
                foreach ($pageParam as $value) {
                        $ruleConfigKey = $value;
                        if ($pageKey == "optional") {
                            $ruleConfigKey = $value . "_$pageKey";
                        }
                        $rules[$value] = config('validator-config.rules.' . $ruleConfigKey);
                    }
            }
        }
    //    print_r($rules);exit;
    //        echo "rules";
    //    echo "<pre>";
    //        print_r($rules);
    //    echo "</pre>";

    //    echo "params";
    //    echo "<pre>";
    //        print_r($params);
    //    echo "</pre>";


    //    die();
        
        $validator = Validator::make($params, $rules);
        if ($validator->fails()) {
            $validate['status'] = false;
            $validate['status_code'] = 422;
            $validate['error'][] = $validator->messages()->first();
            $validate['message'] = $validator->messages()->first();
            $exception = new BaseController();
            $exception = $exception->throwExceptionError($validate, 422);
        }
        
//        echo "Validators";
//        echo "<pre>";
//            print_r($validator);
//        echo "</pre>";
//        echo "validate";
//        echo "<pre>";
//            print_r($validate);
//        echo "</pre>";
//        
//        exit;
        
        return $validate;
    }
    
    
    /**
        * @param
        * amount
        *
        * @return 
        * GST
        * 
    **/
    
    public function calculateGst($amount)
    {
        $percent4Gst = 100;                                         //I want to get 18% of $amount.
        $percentInDecimal4Gst = $percent4Gst / 100;                 //Convert our percentage value into a decimal.
        return $percentInDecimal4Gst * $amount;                     // Get the result.
    }
    
    /**
        * @param
        * amount
        *
        * @return 
        * TxnCharge
        * 
    **/
    
    public function calculateTxnCharge($amount)
    {
        $percent4Txn = 5;                                           //  I want to get 3% of $amount.
        $percentInDecimal4Txn = $percent4Txn / 100;                 //  Convert our percentage value into a decimal.
        return $percentInDecimal4Txn * $amount;                     //  Get the result.
    }



    /**
        * @param
        * id
        *
        * @return 
        * decodeId
        * 
    **/
    
    public function decodeId($id)
    {
        $decodeId = base64_decode($id);        
        return $decodeId;
    }



      /**
        * @method getMrp
        * @param
        * amount
        *
        * @return 
        * TxnCharge
        * 
    **/
    
    public function getMrp($pro_discount, $discount_value, $type,  $amount)
    {
        $discount = $mrp = 0;        

        $discount = $discount_value;           

        if ($type == 'Percent') {
            $mrp = ($amount+($amount*$discount/100));
        } else {
            $mrp = $amount + $discount;
        }                    

        
        return $mrp;
    }

    /**
        * @method generateRandomString
        * @param
        * 
        *
        * @return 
        * randomeString
        * 
    **/
    
    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }





    /**
        * Profile Code
        * method getUserProfile()
        * 
        * @param[]
        * userId
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
    
    public function getUserProfile($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Profile not found...';
        $return[$this->code]                        = 404;
        $return[$this->data]                        = [];

        $result                                     = User::where('id',$param['user_id'])->first();
        
        if($result)
        {
            $result->makeVisible(['is_email_verify', 'is_mobile_verify', 'is_whatsapp_true']);
            $result                                 = $result->toArray();
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully Profile Get...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $result;
        }
        
        return $return;
    }







    /**
        * method changeUserPassword()
        * 
        * @param[]
        * user_id
        * current_password
        * new_password
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
    
    public function changeUserPassword($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Oops, something went wrong...';
        $return[$this->code]                        = 201;
        $return[$this->data]                        = [];

        
        $exist                                      = $this->getUserPasswordByUserId($param);

        if($exist[$this->status])
        {
            $return[$this->status]                  = false;
            $return[$this->message]                 = 'Current password is not being match...';
            $return[$this->code]                    = 401;
            $return[$this->data]                    = [];
            
            if (Hash::check($param['current_password'], $exist[$this->data]['password'])) 
            {

                $userMaster                                 = User::find($param['user_id']);
                $userMaster->password                       = bcrypt($param['new_password']);
                if($userMaster->save())
                {
                    $return[$this->status]                  = true;
                    $return[$this->message]                 = 'Successfully Password Changed...';
                    $return[$this->code]                    = 200;
                    $return[$this->data]                    = [];
                }                
            }
        }
        return $return;
    }



    public function getUserPasswordByUserId($param)
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'User not found...';
        $return[$this->code]                        = 404;
        $return[$this->data]                        = [];

        $result                                     = User::select('password','email')->where('id',$param['user_id'])->first();
              
        if($result)
        {
            $result->makeVisible('password');
            $result                                 = $result->toArray();
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully User Get...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $result;
        }
        
        return $return;
    }

    public function fetcheAllSuggestions()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'User not found...';
        $return[$this->code]                        = 404;
        $return[$this->data]                        = [];

        $result                                     = Product::with('discount','productSku.units')
                                                        ->where('is_live',1)
                                                        ->take(5)
                                                        ->get();
              
        if($result)
        {
            $result->each(function ($product) 
            {
                if (count($product->productSku)>0) {

                    foreach($product->productSku as $val)
                    {
                        if($val->quantity > 0)
                        {
                            $product->out_of_stock = false;
                        }
                        else {
                            $product->out_of_stock = true;
                        }
                    }
                } else {
                    $product->out_of_stock = true;
                }
                
            });
            $result->makeHidden([
                'category_id',
                'unit_id',
                'description',
                'highlight',
                'ingredient',
                'nutritional_information',
                'dietary_preference',
                'other_feature',
                'spice_level',
                'meta_title',
                'meta_description',
                'meta_keyword',
                'created_at'
            ]);
            $result                                 = $result->toArray();
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully Get...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $result;
        }
        
        return $return;
    }

    






    /**
        * Contact Code
        * method storeContactUs()
        * 
        * @param[]
        * name
        * email
        * mobile
        * message
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



    public function storeContactUs($param)
    {
        // Default response structure
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

    
        try {
            // Begin the database transaction
            \DB::beginTransaction();

            $create = ContactUs::create([
                'name' => $param['name'],
                'email' => $param['email_id'],
                'mobile' => $param['mobile_no'],
                'message' => $param['message'],
            ]);

            // Commit the transaction
            \DB::commit();

            $response = [
                $this->status => true,
                $this->message => 'Successfully message submitted...',
                $this->code => 200,
                $this->data => [],
            ];            

        } catch (\Exception $e) {
            \DB::rollBack();
            $response = [
                $this->status => false,
                $this->message => 'Exception raised...',
                $this->code => 500,
                'error' => 'Exception Error...',
                'exception' => $e->getMessage(),
            ];

            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($response, 500);
        }

        return $response;
    }






    public function fetcheAllTeams()
    {
        $return[$this->status]                      = false;
        $return[$this->message]                     = 'Data not found...';
        $return[$this->code]                        = 404;
        $return[$this->data]                        = [];

        $result                                     = Teams::where('is_live',1)
                                                        ->where('status',1)
                                                        ->get();
              
        if($result)
        {
            $result->makeHidden([
                'is_live',
                'created_at',
                'updated_at',
                'deleted_at',
                'status'
            ]);
            $result                                 = $result->toArray();
            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Successfully Get...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $result;
        }
        
        return $return;
    }








    /**
        * storeReplaceOrder Code
        * method storeReplaceOrder()
        * 
        * @param[]
        * name
        * email
        * mobile
        * description
        * order_number
        * packaging_intact
        * problem_facing
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



    public function storeReplaceOrder($param)
    {
        // Default response structure
        $response = [
            $this->status => false,
            $this->message => 'Oops, something went wrong...',
            $this->code => 500,
            $this->data => [],
        ];

    
        try {
            // Begin the database transaction
            \DB::beginTransaction();


            $this->orderSer                         = new OrderService();


            // Get order
            $order = $this->orderSer->fetchOrderByOrderNo($param['order_number']);

            if (!$order[$this->status]) {
                \DB::rollBack();
                return $order;
            }

            $create = ReturnOrder::create([
                'name' => $param['name'],
                'email' => $param['email_id'],
                'mobile' => $param['mobile_no'],
                'order_number' => strtoupper($param['order_number']),
                'packaging_intact' => $param['packaging_intact'],
                'problem_facing' => $param['problem_facing'],
                'other_message' => $param['other_message'] ?? null,
                'description' => $param['description'],
            ]);

            // Commit the transaction
            \DB::commit();

            $response = [
                $this->status => true,
                $this->message => 'Successfully replacement submitted...',
                $this->code => 200,
                $this->data => [],
            ];            

        } catch (\Exception $e) {
            \DB::rollBack();
            $response = [
                $this->status => false,
                $this->message => 'Exception raised...',
                $this->code => 500,
                'error' => 'Exception Error...',
                'exception' => $e->getMessage(),
            ];

            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($response, 500);
        }

        return $response;
    }





    public function checkPaymentStatus($param)
    {
        $response = [
            $this->status => false,
            $this->message => 'Payment not found...',
            $this->code => 404,
            $this->data => [],
        ];

        $result = Payment::where('user_id', $param['user_id'])
            ->where('transaction_id', $param['transaction_id'])
            ->orderBy('id', 'DESC')
            ->first();

        if ($result) {
            $result->makeHidden(['transaction_id', 'amount']);
            

            switch ($result->payment_status) {
                case 'success':
                    $response[$this->status] = true;
                    $response[$this->message] = 'Successfully Payment Received...';
                    $response[$this->code] = 200;
                    break;
                case 'initiated':
                    $response[$this->message] = 'Payment Initiated...';
                    $response[$this->code] = 201;
                    break;
                case 'pending':
                case 'inprocess':
                    $response[$this->message] = 'Payment ' . ucfirst($result->payment_status) . ', We are waiting for the confirmation, If your amount deducted it will be redirected to your bank account within 2-3 working days...';
                    $response[$this->code] = $result->payment_status == 'pending' ? 202 : 203;
                    break;
                case 'failure':
                    $response[$this->message] = 'Payment Failure, If your amount deducted it will be redirected to your bank account within 2-3 working days...';
                    $response[$this->code] = 205;
                    break;
                default:
                    $response[$this->message] = 'Payment created...';
                    $response[$this->code] = 201;
                    break;
            }
            $result = $result->toArray();
            $response[$this->data] = $result;
        }

        return $response;
    }



}
