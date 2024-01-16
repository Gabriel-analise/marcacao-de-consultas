<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controller responsible for managing the registration of new users.
 */
class RegisteredUserController extends Controller
{
    use RegistersUsers;

    /**
     * Creates a new instance of the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Displays the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validation of registration form data.
         *
         * @var \Illuminate\Validation\Validator $validator
         */
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cls_usuarios',
            'senha' => 'required|string|min:8',
            'confirmacao_senha' => 'required|string|min:8|same:senha',
        ], [
            'confirmacao_senha.same' => 'Password confirmation does not match',
            'senha.min' => 'Password field must be at least 8 characters',
        ]);

        /**
         * Redirects back to the registration form in case of validation failure.
         */
        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * Creation of the user in the database.
         *
         * @var \App\Models\User $user
         */
        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        /**
         * Fires the user registered event.
         *
         * @var \Illuminate\Auth\Events\Registered $event
         */
        event(new Registered($user));

        /**
         * Authenticates the newly created user.
         */
        Auth::login($user);

        /**
         * Redirects to the home page.
         */
        return redirect(RouteServiceProvider::HOME);
    }
}
