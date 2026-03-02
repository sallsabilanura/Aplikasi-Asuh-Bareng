<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Mail\NewUserNotification;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
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
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kakak_asuh',
            'is_approved' => false,
        ]);

        \App\Models\KakakAsuh::create([
            'user_id' => $user->id,
            'NamaLengkap' => $user->name,
            'Email' => $user->email,
            'NomorHP' => '-',
            'Alamat' => '-',
            'StatusAktif' => 'nonaktif',
        ]);

        event(new Registered($user));

        // Notify admins
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NewUserNotification($user));
            }
        }
        catch (\Exception $e) {
        // Ignore email fail
        }

        // Prevent auto-login for new users, require admin approval
        // Auth::login($user);

        return redirect()->route('login')->with('status', 'Registrasi berhasil. Akun Anda sedang menunggu persetujuan Admin sebelum bisa digunakan.');
    }
}
