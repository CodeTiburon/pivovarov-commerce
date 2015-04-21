<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function postLogin(Request $request)
    {
//       $validator = $this->validate($request, [
//            'email' => 'required|email', 'password' => 'required',
//        ]);
        $validator = $this->registrar->validlogin($request->all());

        if ($validator->fails())
        {
            $messages = $validator->messages();
            $jsonarr = array('errors' => $messages);

            return response()->json($jsonarr);
        }
        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            $validuser = $this->redirectPath();
                $jsonarr = array('redirect' => $validuser);
            return response()->json($jsonarr);

        }
//
//        return redirect($this->loginPath())
//            ->withInput($request->only('email', 'remember'))
//            ->withErrors([
//                'email' => $this->getFailedLoginMessage(),
//            ]);
    }




/**
 * Handle a registration request for the application.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            $messages = $validator->messages();
            $jsonarr = array('errors' => $messages);
            json_encode($jsonarr);
            return $jsonarr;
        }

        $this->auth->login($this->registrar->create($request->all()));

        $newredirect = $this->redirectPath();

        $jsonarr = array('redirect' => $newredirect);
        return response()->json($jsonarr);

    }
    }