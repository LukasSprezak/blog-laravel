<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        session()->flash('message', "Hello {$user->name}, you are logged");
    }

    protected function loggedOut(Request $request)
    {
        session()->flash('message', "Hello, you are logout");

        return $this->redirectTo('home');
    }


    /**
     * Create a redirect method to facebook api.
     *
     * @return RedirectResponse
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('facebook')->user();
        $user = $this->firstOrCreateUser($socialiteUser, 'facebook');

        Auth::login($user);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * @param  $socialiteUser
     * @param  $provider
     * @return User
     */
    protected function firstOrCreateUser($socialiteUser, $provider)
    {
        if ($user = User::where("facebook_id", $socialiteUser->getId())->first()) {
            return $user;
        }

        if (!is_null($socialiteUser->getEmail()) && $user = User::where('email', $socialiteUser->getEmail())->first()) {
            $user->update(["facebook_id" => $socialiteUser->getId()]);

            return $user;
        }

        return User::create([
            "facebook_id" => $socialiteUser->getId(),
            'password' => md5(rand(1,10000)),
            'email' => $socialiteUser->getEmail(),
            'name' => $socialiteUser->getName(),
        ]);
    }
}
