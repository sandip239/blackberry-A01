<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;


class registercontroller extends Controller
{

    public function registerView()
    {

        return view('register');
    }
    public function register(request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect()->route('loginview');
    }

    public function loginView()
    {
        return view('login');
    }

    public function login(request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        // dd($email);
        $user = DB::table('users')->where('email', $email)->first();


        if ($user && Hash::check($password, $user->password)) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->route('deshboard');
            }
        } else {
            return redirect()->route('loginview')->withErrors(['msg' => 'User Not Found']);
        }
    }

   public function forgetView()
    {
       return view('forget');
    }

    public function forget(Request $request)
    {
        $useremail = $request->input('email');

        $user = DB::table('users')->where('email', $useremail)->first();

        if ($user) {
            $forgetLink = Str::random(16);
            // dd($forgetLink);
            // Store email and forget link in the "forget" table
            DB::table('forget_tables')->insert([
                'email' => $useremail,
                'forget_link' => $forgetLink,
            ]);
            $url = route('newpassword', ['newpassword' => $forgetLink]);

            $data = [
                'email' => $useremail,
                'forgetLink' => $url,

            ];

            Mail::send('forgetmail', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject('Your Server Expired Mail');
            });

        } else {
           return redirect()->route('forgetView')->withErrors(['msg' => 'Email Not Found']);
        }
    }

    public function newpassword($newpassword)
    {
       return view('newpassword');
    }
}
