<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\UserProfile;

class SocialAuthController extends Controller
{
   public function redirect(string $provider)
    {
        $driver = Socialite::driver($provider)->stateless();

        if ($provider === 'facebook') { 
            $driver->scopes(['email', 'public_profile']);
        }

        // dd($driver);

        return $driver->redirect();
    }



    public function callback(string $provider)
    {
        
        try {
            
                $s = Socialite::driver($provider)->stateless()->user();
            } catch (\Throwable $e) {
                return redirect('/register')->with('error', 'Social login failed. Please try again.');
        }
    
        $providerId = (string) $s->getId();
        $email      = $s->getEmail();
        $name       = $s->getName();
        $avatar     = method_exists($s,'getAvatar') ? $s->getAvatar() : null;
    
        //  Already linked → login
        $byProvider = Admin::where('provider', $provider)
            ->where('provider_id', $providerId)
            ->where('type', 'customer')
            ->first();
    
        if ($byProvider) {
            Auth::login($byProvider);
            return $this->ok();
        }
    
        //  Email present? Try to link to existing account by email
        if ($email) {
            $byEmail = Admin::where('email', $email)
                ->where('type', 'customer')
                ->first();
    
            if ($byEmail) {
                // TO‑LINK to existing account (no duplicate)
                
                $byEmail->update([
                        'provider'    => $provider,
                        'provider_id' => $providerId,
                        'name'        => $byEmail->name ?: $name,
                        'avatar'      => $byEmail->avatar ?: $avatar,
                    ]);
                    
                Auth::login($byEmail);
                    
                return $this->ok();
            }
        } else {
            return redirect('/register')->with('error', 'Facebook did not return your email. Please log in once with email or sign up, then try linking.');
        }
    
        // 3) New user → auto sign‑up + profile
        $password=Str::random(32);
        $new = new Admin();
        $new->email       = $email;
        $new->mobile      = null; // (capture later if you want)
        $new->password    = Hash::make($password); // placeholder
        $new->type        = 'customer';
        $new->name        = $name;
        $new->avatar      = $avatar;
        $new->provider    = $provider;
        $new->provider_id = $providerId;
        $new->save();
    
        UserProfile::firstOrCreate(['user_id' => $new->id]);
    
    if(!empty($new)){
        $user=$new;
        
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



        sendEmail(
            $user->email,
            "ELYVATO | Welcome to the Content Fast Lane!",
            'emails.welcome',
            
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
        


    }
        Auth::login($new);
        return $this->ok(true);
    }


    private function ok(bool $first = false)
    {
           $url = session()->pull('url.intended', url('user/profiles'));
        if (request()->wantsJson()) {
            return response()->json([
                'success'=>true,
                'message'=>$first ? '🎉 Account created successfully.' : '🎉 Logged in.',
                'url'=>$url,
            ]);
        }
        return redirect($url)->with('success', $first ? 'Account created successfully.' : 'Logged in.');
    }
    
    
    

//   public function redirect(string $provider)
//     {
//         $driver = Socialite::driver($provider)->stateless();

//         if ($provider === 'facebook') {
//             $driver->scopes(['email', 'public_profile']);
//         }

//         return $driver->redirect();
//     }

//     /**
//      * Handle provider callback
//      */
//     public function callback(string $provider)
// {
//     try {
//         $socialUser = Socialite::driver($provider)->stateless()->user();

//         // First check if user already exists by email
//         $user = Admin::where('email', $socialUser->getEmail())->first();

//         $plainPassword = Str::random(12); // random 12-character password
//         $hashedPassword = Hash::make($plainPassword);

//         $username=generateUniqueUsername();

//         if ($user) {
//             // If user exists, update provider ID if not set
//             if (empty($user->{$provider . '_id'})) {
//                 $user->update([
//                     $provider . '_id' => $socialUser->getId(),
//                     'avatar' => $socialUser->getAvatar(),
//                 ]);
//             }
//         } else {
//             // If no user exists, create new one
//             $user = Admin::create([
//                 'name'   => $socialUser->getName(),
//                 'email'  => $socialUser->getEmail(),
//                 'password'=>$hashedPassword,
//                 'username'=>
//                 'avatar' => $socialUser->getAvatar(),
//                 $provider . '_id' => $socialUser->getId(),
//             ]);
//         }

//         // Login the user
//         Auth::login($user);

//         return redirect('/user/dashboard')->with('success', 'Logged in successfully!');

//     } catch (\Exception $e) {
//         \Log::error("{$provider} login error: " . $e->getMessage());
//         dd($e->getMessage());
//         return redirect('/login')->with('error', 'Unable to login with ' . ucfirst($provider));
//     }
// }



}

