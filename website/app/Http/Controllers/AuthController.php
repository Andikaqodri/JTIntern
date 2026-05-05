<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\AuthModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! session()->has('admin_id') && request()->hasCookie('admin_remember')) {
            $remember = explode('|', (string) request()->cookie('admin_remember'), 2);

            if (count($remember) === 2) {
                [$adminId, $signature] = $remember;
                $admin = AdminModel::find($adminId);

                if ($admin && hash_equals($this->rememberSignature($admin), $signature)) {
                    session()->regenerate();
                    session()->put('admin_id', $admin->id);
                    session()->put('admin_nama', $admin->nama_lengkap);

                    return redirect()->route('admin.dashboard');
                }
            }

            Cookie::queue(Cookie::forget('admin_remember'));
        }

        return view('auth.login', [
            'title' => 'Login Page',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $admin = AdminModel::where('email', $credentials['username'])->first();

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return back()
                ->withErrors(['username' => 'Email atau password salah.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_nama', $admin->nama_lengkap);

        if ($request->boolean('remember')) {
            Cookie::queue(cookie(
                'admin_remember',
                $admin->id.'|'.$this->rememberSignature($admin),
                43200,
                null,
                null,
                $request->isSecure(),
                true,
                false,
                'lax'
            ));
        } else {
            Cookie::queue(Cookie::forget('admin_remember'));
        }

        return redirect()->route('admin.dashboard');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password', [
            'title' => 'Lupa Password',
        ]);
    }

    public function sendResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = AdminModel::where('email', $validated['email'])->first();

        if ($admin) {
            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $admin->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => now(),
                ]
            );

            Mail::send('emails.admin-password-reset', [
                'admin' => $admin,
                'resetUrl' => route('password.reset', [
                    'token' => $token,
                    'email' => $admin->email,
                ]),
            ], function ($message) use ($admin) {
                $message->to($admin->email)
                    ->subject('Reset Password Admin JTIntern');
            });
        }

        return back()->with('status', 'Jika email admin terdaftar, link reset password sudah dikirim.');
    }

    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $reset = DB::table('password_reset_tokens')->where('email', $validated['email'])->first();

        if (! $reset || ! Hash::check($validated['token'], $reset->token)) {
            return back()
                ->withErrors(['email' => 'Token reset password tidak valid.'])
                ->onlyInput('email');
        }

        if (now()->diffInMinutes($reset->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

            return back()
                ->withErrors(['email' => 'Token reset password sudah kedaluwarsa. Silakan minta link baru.'])
                ->onlyInput('email');
        }

        $admin = AdminModel::where('email', $validated['email'])->first();

        if (! $admin) {
            return back()
                ->withErrors(['email' => 'Email admin tidak ditemukan.'])
                ->onlyInput('email');
        }

        $admin->password = Hash::make($validated['password']);
        $admin->save();

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();
        Cookie::queue(Cookie::forget('admin_remember'));

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_nama']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget('admin_remember'));

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(AuthModel $authModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuthModel $authModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuthModel $authModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuthModel $authModel)
    {
        //
    }

    private function rememberSignature(AdminModel $admin): string
    {
        return hash_hmac('sha256', $admin->id.'|'.$admin->email.'|'.$admin->password, (string) config('app.key'));
    }
}
