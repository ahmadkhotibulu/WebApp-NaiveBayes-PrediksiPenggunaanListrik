<?php

namespace App\Http\Controllers;

use App\Enums\TipeUser;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (User::authenticated()) {
            return redirect('/home');
        }

        return view('auth/login', [
            'page_title' => 'Login',
        ]);
    }

    public function registerPage()
    {
        if (User::authenticated()) {
            return redirect('/home');
        }

        return view('auth/register', [
            'page_title' => 'Register',
        ]);
    }

    public function login(Request $req)
    {
        if (User::authenticated()) {
            return redirect('/home');
        }

        $validated = $req->validate([
            'username' => 'required|lowercase|between:5,18',
            'password' => 'required|between:6,24',
        ]);
        if (!$validated) {
            return redirect('/login');
        }

        $user = null;
        try {
            $user = User::authenticate($validated['username'], $validated['password']);
        } catch (\Exception $e) {
            return redirect('/login')->with('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => $e->getMessage(),
            ]);
        }

        return redirect('/home')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Hi, ' . $user->nama_depan . ' ' . $user->nama_belakang,
        ]);
    }

    public function register(Request $req)
    {
        if (User::authenticated()) {
            return redirect('/home');
        }

        $validated = $req->validate([
            'username' => 'required|alpha_dash|lowercase|between:5,18|unique:App\Models\User,username',
            'password' => 'required|confirmed|between:6,24',
            'nama_depan' => 'required|between:2,24',
            'nama_belakang' => 'between:1,64',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'max:128',
        ]);

        if (!$validated) {
            return redirect('/register');
        }

        $user = new User([
            'tipe_user' => TipeUser::USER,
            'username' => $validated['username'],
            'password' => password_hash($validated['password'], PASSWORD_ARGON2ID),
            'nama_depan' => $validated['nama_depan'],
            'nama_belakang' => $validated['nama_belakang'],
            'provinsi' => $validated['provinsi'],
            'kabupaten' => $validated['kabupaten'],
            'kecamatan' => $validated['kecamatan'],
            'kelurahan' => $validated['kelurahan'],
            'alamat' => $validated['alamat'],
        ]);

        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = $e->getMessage();
            if ($e->getCode() == 23000) {
                $msg = 'Username telah digunakan';
            }

            return redirect('/register')->with('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => $msg,
            ]);
        }

        return redirect('/login')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Akun sudah dapat digunakan untuk login',
        ]);
    }
}
