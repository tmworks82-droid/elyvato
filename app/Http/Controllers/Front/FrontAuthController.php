<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Admin;
use App\Models\State;
use App\Models\City;
use App\Models\Role;
use App\Models\RoleDesignation;
use App\Models\UserProfile;
use Validator;
use Hash;
use Session;
use Str;

class FrontAuthController extends Controller
{
    public function UserLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }


        $previousUrl = url()->previous();

        // Only store previous URL if it's not the register page and from elyvato.com domain
        if (
            $previousUrl !== url('/register') &&
            str_contains($previousUrl, 'https://elyvato.com')
        ) {
            session(['custom_redirect_url' => $previousUrl]);
        }
      
        if($previousUrl==null){
            session(['custom_redirect_url' => 'https://elyvato.com']);

        }
        $data['title'] = "User Login";
        
        
          $mobile='+919956398635';


        // here send registration template  
     
        $registemplateData = [
            'name' => 'registration',
            'language' => ['code' => 'en'],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => "*Login Credentials:*\n\nEmail: user@example.com\nPassword: abc12345"
                        ]
                    ]
                ]
            ]
        ];




        // $response=sendWhatsAppTemplate($mobile, $registemplateData);

        // $response=sendWhatsAppTemplate($mobile, $registemplateData);
        
        $message = "*Elyvato | Registration Success*\n\n🙌 *You’re One of Us Now!*\n\n🚀 We’re pumped to have you! Jump in and unlock powerful, streamlined content services that just make sense.\n\n🔐 *Your Login Credentials:*\n👤 Email: email\n🔑 Password: password\n\nLogin here: https://elyvato.com/login";

        
        // sendWhatsAppMessage($mobile, $message);
        
        // dd($response);
        
        return view('front.login', $data);
    }


    public function Register(){
        // dd('run');

       $data['country']=Country::get();
       $data['title']="Elyvato | SignUp";
       $data['roles']=Role::whereIn('id',[5,6,7])->get();
       $data['role_designation']=RoleDesignation::where('is_active',1)->get();
       $data['State']=State::where('is_live',1)->get();
        return view('front.register',$data);
    }

    public function getCities(Request $request)
    {
        // dd($request->all());                             
        $cities = City::where('state_id', $request->state_id)
                    ->where('is_live', 1)
                    ->orderBy('name', 'asc')
                    ->get(['id', 'name']);
        return response()->json($cities);
    }


    public function RegisterNow(Request $request)
    {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email:rfc,dns|max:255',
                'mobile' => 'required|digits:10',
            ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

      
                // Check if email exists
                $emailExists = Admin::where('email', $request->email)->first();

                // Check if mobile exists
                $mobileExists = Admin::where('mobile', $request->mobile)->first();

                if ($emailExists || $mobileExists) {
                    $errorMessage = '';

                    if ($emailExists && $mobileExists) {
                        $errorMessage = 'Email and mobile number are already registered. Please log in.';
                    } elseif ($emailExists) {
                        $errorMessage = 'The email has already been used.';
                    } else {
                        $errorMessage = 'The contact number has already been used.';
                    }

                    return response()->json([
                        'success' => false,
                        'message' => $errorMessage,
                        'data' => [
                            'user_id' => ($emailExists ?? $mobileExists)->id
                        ]
                    ]);
                }

        $password = Str::random(8);

        // Create the user
        $user = new Admin();
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($password);
        $user->username=generateUniqueUsername($request->email);
        $user->type = 'customer';
        $user->save(); 

        // Create profile
        $profile = new UserProfile();
        $profile->user_id = $user->id;
        $profile->save();

        // Send email
        
        sendEmail(
            $user->email,
            "ELYVATO | Welcome to the Content Fast Lane!",
            'emails.welcome',
            
        );
        
        sendEmail(
            $user->email,
            "You're In! Let the Magic Begins with Elyvato",
            'emails.registration',
            [
                'user' => $user->name,
                'email' => $user->email,
                'password' => $password
            ]
        );


        


        $welcometemplateData = [
                'name' => 'welcome_template',
                'language' => ['code' => 'en']
            ];

            
         $message = "🎉 *You're In! Welcome to Elyvato*\n\n✅ You're officially on board! Dive into Elyvato and explore a world of premium content solutions crafted just for you.";
        
        $mobile=$user->mobile;
        // $mobile='+919956398635';
         $response=sendWhatsAppMessage($mobile, $message);

        $response=sendWhatsAppTemplate($mobile, $welcometemplateData);

        // here send registration template  
          $registemplateData = [
                'name' => 'registration_success',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => "*Login Credentials:*\n\nEmail: {$user->email}\nPassword: {$password}"
                            ]
                        ]
                    ],
                    [
                        'type' => 'button',
                        'sub_type' => 'url',
                        'index' => 0
                        // No 'parameters' needed because it's a static button
                    ]
                ]
            ];

        $response=sendWhatsAppTemplate($mobile, $registemplateData);


     

        $message = "*Elyvato | Registration Success*\n\n🙌 *You’re One of Us Now!*\n\n🚀 We’re pumped to have you! Jump in and unlock powerful, streamlined content services that just make sense.\n\n🔐 *Your Login Credentials:*\n👤 Email: {$user->email}\n🔑 Password: {$password}\n\nLogin here: https://elyvato.com/login";

        // $mobile=$user->mobile;
        sendWhatsAppMessage($mobile, $message);
        


        // if (isset($response['error'])) {
        //     dd("Error sending message: " . $response['error']);
        // }

        return response()->json([
            'success' => true,
            'message' => '✅ You’re in! We’ve sent your login details to your inbox — check it out and let’s get started.',
            'data' => [
                'user_id' => $user->id
            ]
        ]);
    }


    public function RegisterNow_old(Request $request)
    {
        dd($request->all());
        // Validate the incoming data
        $validator = Validator::make($request->all(), [

            'email'          => 'required|email|max:255|unique:admins,email',
            'mobile'          => 'required|max:11|unique:admins,mobile',
        ]);
       

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors()
            ], 422);
        }
      
         $password = Str::random(8);
        // Create the user
        $user = new Admin();
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($password);
        // $user->role_id=$request->role;
        $user->type='customer';
        $user_id=$user->save();

        $profile=new UserProfile();
        $profile->user_id = $user_id;
        
        $profile->save();

        if($profile->save()){
            $subject="Registration successful";
            $to=$user->email;

            $check= sendEmail(
                    $to,
                    'Registration Success',
                    'emails.registration',
                    [
                        'user' => $user->name,
                        'email' => $user->email,
                        'password' => $password
                    ]
                );
        }
        return response()->json([
            'success' => true,
            'message' => 'You have successfully registered! We’ve sent your login details to your email. Please check your inbox and log in to get started.'

        ]);
    }


   public function loginUser_old(Request $request)
    {
        // dd($url);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->where('type', 'customer')->first();

        if (!empty($admin) && \Hash::check($request->password, $admin->password)) {

            Auth::login($admin, $request->remember);

            $url = session()->pull('custom_redirect_url');
            
            if($url==null){
                $url=url('/');
            }

            return response()->json([
                'success' => true,
                'message' => '🎉 Logged in. Let the magic begin!',
                'url'=>$url,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password.'
        ], 401);
    }



    public function loginUser(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $maxAttempts = config('auth.throttle.max_attempts');
    $decaySeconds = config('auth.throttle.decay_seconds');

    $key = Str::lower($request->input('email').'|'.$request->ip());

    if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
        return response()->json([
            'success' => false,
            'message' => 'Too many login attempts. Please try again in ' .
                RateLimiter::availableIn($key) . ' seconds.'
        ], 429);
    }

    // $admin = Admin::where('email', $request->email)
    //               ->where('type', 'customer')
    //               ->where('type', 'user')
    //               ->where('is_hired', 'yes')
    //               ->first();

    $admin = Admin::where('email', $request->email)
              ->where(function ($query) {
                  $query->where('type', 'customer')
                        ->orWhere(function ($subQuery) {
                            $subQuery->where('type', 'user')    
                                     ->where('is_hired', 'yes');
                        });
              })->first();
              

    if (!empty($admin) && \Hash::check($request->password, $admin->password)) {
        Auth::login($admin, $request->remember);

        RateLimiter::clear($key);

        $url = session()->pull('custom_redirect_url') ?? url('/');

        return response()->json([
            'success' => true,
            'message' => '🎉 Logged in. Let the magic begin!',
            'url'     => $url,
        ]);
    }

    RateLimiter::hit($key, $decaySeconds);

    return response()->json([
        'success' => false,
        'message' => 'Invalid email or password.'
    ], 401);
}

    public function ForgetPassword(){
        $data['title']="Forgot Password";
        return view('front.forget_password',$data);
    }

    public function sendOtp(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ]);

        $user=Admin::where('email',$request->email)->first();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Email not found.'], 404);
        }

        Session::put('reset_email', $request->email);
      
         $token = Str::random(64); 
        $resetLink = url("/password/reset/{$token}?email=" . urlencode($user->email));


             sendEmail(
                $user->email,
                'ELYVATO | Password Trouble? Let’s Fix That Fast ',
                'emails.forgot_password',
                [
                    'user' => $user,
                    'resetLink' => $resetLink
                ]
            );

            
            $message = "🔐 *No Worries — Let’s Reset It.*\n\n🔐 Need to reset your password? Tap below and you’ll be back in faster than you can say *Elyvato.*";

            $mobile=$user->mobile;
            // $mobile='+919956398635';
            // dd($mobile);

       $response= sendWhatsAppMessage($mobile, $message);
    //    dd($response);
 
        $forgettemplateData = [
            'name' => 'forget_password',
            'language' => ['code' => 'en']
        ];

        sendWhatsAppTemplate($mobile, $forgettemplateData);


        return response()->json([
            'status' => true,
            'message' => '🔐 Password reset link sent. Head to your inbox and set things right.'
        ]);
    }

    public function showResetForm($token, Request $request)
    {
        $email = $request->query('email');
        $title="Rest Password";
        
        return view('front.password_reset', compact('token', 'email','title'));
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Admin::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Optional: Verify token here if you're storing them
        // Check against session or DB if you want to verify

        // Reset password
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        sendEmail(
                $user->email,
                'ELYVATO | Heads-Up! Your Password Just Changed',
                'emails.password_changed_success',
                
            );

            $message = "*Elyvato | Password Changed*\n\n🔐 *⚠️ Just Checking — You Changed Your Password?*\n\n🚨 Heads up! Your password just changed. Didn’t do it? Ping us right away.";
            
            $mobile=$user->mobile;
        sendWhatsAppMessage($mobile, $message);

        return redirect()->route('user_login_form')->with('success', '✅ All set! Your password has been updated.');
    }

}
