<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Auth;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
       

    	 // dd($user);
        $data = [
        	'email' => $user->email,
        	'password' => $user->token,
        	'google_id' => $user->id,
        	'name' => $user->name,
        	'image' => $user->avatar,
        	'gender' => $user->user['kind'],
        	'username' => $user->user['displayName']
    	];
    	// $data->save();
        $u = User::where('email', $data['email'])->first();

        if(isset($u)){
            Auth::login($u);
        }else{
            $u = User::create($data);
        }

    	

    	// auth()->login($a);
    	
    	return redirect()->route('dashboard');
    }
}
