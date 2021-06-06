<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

        protected function redirectTo(){
            if (Auth()->user()->role == 1) {
                return route('admin.dashboard');
            }elseif(Auth()->user()->role == 2){
                return route('user.dashboard');
            }
               
        }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $rules = [
            'email' => 'required|max:255',
            'password' => 'required|min:8',

        ];
        $messages = [
            'email.required' => 'Vous veuillez écrire l\'email',
            'password.required' => 'Vous veuillez écrire le mot de passe',
            'password.min' => 'le mot de passe doit comporter 8 caractères au minimum',

        ];
        $validator = Validator::make($request->all(),$rules,$messages);
    
          if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

           $input = $request->all();
          /* $this->validate($request,[
               'email'=>'required|email',
               'password'=>'required|min:8'
           ]);*/

           if( auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password'])) ){
               if (auth()->user()->role == 1){ return redirect()->route('admin.dashboard'); }

               elseif(auth()->user()->role == 2){return redirect()->route('user.dashboard'); }

           }else{ return redirect()->route('login')->with('error', 'Vérifiez votre email et mot de passe'); }
    }
}
