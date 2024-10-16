<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Mail\VerificationMail;
    use App\Models\User;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Validation\Rules;
    use Illuminate\Validation\ValidationException;
    use Illuminate\View\View;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Str;

    class RegisteredUserController extends Controller
    {
        /**
         * Display the registration view.
         */
        public function create(): View
        {
            return view('auth.register');
        }

        /**
         * Handle an incoming registration request.
         *
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request): RedirectResponse
        {
            // Validate the incoming request data
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['nullable', 'string'],
                'birthday' => ['nullable', 'date'],
            ]);

            $user = User::create([
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'name' => $request['name'],
                'user_type_id' => 3,  // Set default value for user_type_id
                'phone' => $request['phone'],
                'birthday' => $request['birthday']
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('verification.notice');
        }
    }
