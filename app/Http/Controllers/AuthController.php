<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_akun;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Halaman login
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Simpan ID pengguna di session
            session(['id' => Auth::id()]); 
            return redirect()->route('daftarbarang', ['id' => Auth::id()]); // Kirim ID pengguna
        }

        return back()->withErrors([
            'username' => 'Username or password is incorrect.',
        ]);
    }
}
