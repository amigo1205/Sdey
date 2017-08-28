<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Jrean\UserVerification\Facades\UserVerification as UserVerificationFacade;
use App\Mail\OrderShipped;
use PragmaRX\Countries\Facade as Countries;
use Propaganistas\LaravelIntl\Facades\Country;
use Propaganistas\LaravelPhone\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use SimpleSoftwareIO\SMS\Facades\SMS;
use Mail;

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
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/create-new-application';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    public function showRegistrationForm()
    {
      $countrylists = Country::all();
      return view('auth.register',['countries' => $countrylists]);
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
            'fname' => 'required',
            'lname' => 'required',
            'company_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'phone_number' => $data['phonenumber'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function register(Request $request)
    {
      $this->validator($request->all())->validate();
        $data = $this->create($request->all());

        $user = User::find($data['id']);

        UserVerification::generate($user);

        UserVerification::send($user, 'please verify your email');

        return $this->registered($request, $user)
                        ? : redirect(url('login-page'))->with('status','Confirmation email has been send. please check your email.');
    }

    public function getVerification(Request $request, $token)
    {
        if (! $this->validateRequest($request)) {
            return redirect($this->redirectIfVerificationFails());
        }

        try {
            $user = UserVerificationFacade::process($request->input('email'), $token, $this->userTable());
        } catch (UserNotFoundException $e) {
            return redirect($this->redirectIfVerificationFails());
        } catch (UserIsVerifiedException $e) {
            return redirect(url('create-new-application'));
        } catch (TokenMismatchException $e) {
            return redirect($this->redirectIfVerificationFails());
        }

        if (config('user-verification.auto-login') === true) {
            auth()->loginUsingId($user->id);
        }

        return redirect(url('login-page'))->with('status','congratulations Your email Verified.');
    }
}
