<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CitizenAuth extends Component
{
    public string $mode = 'login'; // 'login' or 'register'

    // Login fields
    public string $login_id = ''; // Email or phone

    public string $login_password = '';

    public bool $remember = false;

    // Register fields
    public string $name = '';

    public string $nik = '';

    public string $phone = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $agreement = false;

    public string $errorMessage = '';

    public function switchMode(string $mode): void
    {
        $this->mode = $mode;
        $this->errorMessage = '';
    }

    public function login(): void
    {
        $this->validate([
            'login_id' => 'required|string',
            'login_password' => 'required|string',
        ]);

        $this->errorMessage = '';

        $field = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$field => $this->login_id, 'password' => $this->login_password], $this->remember)) {
            session()->regenerate();

            $this->redirectIntended(route('akun-saya'), navigate: true);

            return;
        }

        $this->errorMessage = 'Email/Nomor HP atau password yang Anda masukkan tidak sesuai.';
    }

    public function register(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:users,nik',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'agreement' => 'accepted',
        ], [
            'nik.size' => 'NIK harus 16 digit sesuai e-KTP.',
            'nik.unique' => 'NIK ini telah terdaftar.',
            'phone.unique' => 'Nomor WhatsApp ini telah terdaftar.',
            'email.unique' => 'Email ini telah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'agreement.accepted' => 'Anda wajib menyetujui syarat & ketentuan.',
        ]);

        $user = User::create([
            'name' => $this->name,
            'nik' => $this->nik,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => true,
        ]);

        // Assign 'masyarakat' role if role exists
        if (Role::where('name', 'masyarakat')->exists()) {
            $user->assignRole('masyarakat');
        }

        Auth::login($user);

        $this->redirect(route('akun-saya'), navigate: true);
    }

    public function render()
    {
        return view('livewire.citizen-auth')
            ->layout('components.layouts.app', ['title' => 'Masuk & Pendaftaran Akun Warga — SAPA SOSIAL Blitar']);
    }
}
