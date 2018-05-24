<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;
use Auth;

class SocialAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['handleProviderCallback']);
    }

    public function handleLogin($provider)
    {
        session(['auth_type' => 'login']);

        return $this->redirectToProvider($provider);
    }

    // public function handleJoin($provider)
    // {
    //     session(['auth_type' => 'join']);
    //
    //     return $this->redirectToProvider($provider);
    // }

    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * @param $provider
     * @return mixed
     * @throws SocialAuthenticationException
     * @throws UserExistsException
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            dd($e);
        }

        $auth_type = session()->pull('auth_type');

        if ($auth_type == 'join') {
            return $this->handleJoinCallback($user, $provider);
        } elseif ($auth_type == 'login') {
            return $this->handleLoginCallback($user, $provider);
        }
    }

    /**
     * @param User $user
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     * @throws UserExistsException
     */
    // public function handleJoinCallback(User $user, $provider)
    // {
    //     if ($socialUser = $this->socialUserExists($user->getId(), $provider)) {
    //         Auth::login($user, true);
    //     } elseif ($plainUser = $this->userEmailExists($user->getEmail())) {
    //         Auth::login($plainUser, true);
    //     } else {
    //         $this->createUser($user, $provider);
    //     }
    //
    //     return redirect()->route('home');
    // }

    public function userEmailExists($email)
    {
        return \App\User::whereEmail($email)->first();
    }

    public function createUser(User $user, $provider)
    {
        if ($user->getName()) {
            $name = $user->getName();
        } else {
            $name = $user->nickname;
        }
        $newUser = \App\User::create([
            'name' => $name,
            'email' => $user->getEmail()
        ]);

        // $this->createSocialProvider($user, $newUser, $provider);

        Auth::login($newUser, true);
    }
    //
    // public function createSocialProvider(User $providerUser, \App\User $user, $provider)
    // {
    //     $user->socialProviders()->create([
    //         'provider_user_id' => $providerUser->getId(),
    //         'provider' => config("social-providers.$provider")
    //     ]);
    // }

    /**
     * @param User $user
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     * @throws SocialAuthenticationException
     */
    public function handleLoginCallback(User $user, $provider)
    {
        if ($plainUser = $this->userEmailExists($user->getEmail())) {
            Auth::login($plainUser, true);
        } else {
            $this->createUser($user, $provider);
        }

        return redirect()->route('feed');
    }
}
