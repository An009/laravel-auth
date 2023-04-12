<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //return the home page 
    public function index()
    {
        return view('auth.login');
    }
    public function registration()
    {
        return view('auth.registration');
    }
    //lgin user
    public function postLogin(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
        $messages = [
            'email.email' => 'email not valid'
        ];
        $validateForm = Validator::make($request->all(), $rules, $messages);
        if ($validateForm->fails())
            return redirect()->back()->withErrors($validateForm)->onlyInput('email');
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password), $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('cars');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid 
credentials')->onlyInput('email');
    }
    public function postRegistration(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ];
        $validateData = Validator::make($request->all(), $rules);
        if ($validateData->fails())
            return redirect()->back()->withErrors($validateData)->withInput();
        $data = [
            "name" => $request->name,
            "password" => $request->password,
            "email" => $request->email,
        ];
        $user = $this->create($data);
        Auth::attempt(array('email' => $data['email'], 'password' => $data['password']));
        return redirect("/cars")->withSuccess('Great! You have Successfully 
loggedin');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
