<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Flash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],[], User::attributes());
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $validator->validate();
        $confirmation_code = str_random(30);
        $input = $request->all();
        $input['confirmation_code'] = $confirmation_code;
        $this->create($input);
        Mail::send('email.verify', ['confirmation_code'=>$confirmation_code], function($message) use ($input) {
            $message->to($input['email'], $input['name'])
                ->subject('Xác nhận địa chỉ email');
        });

//        Flash::success('Cảm ơn bạn đã đăng ký. Hãy kiểm tra email để có thể đăng ký thành công.');
        return redirect('/');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $data['confirmation_code'],
            'group_id' => 2, //Nhóm người dùng
        ]);
    }

    public function confirm($confirmation_code)
    {
//        if( ! $confirmation_code)
//        {
//            throw new InvalidConfirmationCodeException;
//        }

        $user = User::whereConfirmationCode($confirmation_code);
//        if ( ! $user)
//        {
//            throw new InvalidConfirmationCodeException;
//        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

//        Flash::message('Bạn đã xác nhận đăng ký tài khoản thành công!');

        return redirect(route('home'));
    }
}
