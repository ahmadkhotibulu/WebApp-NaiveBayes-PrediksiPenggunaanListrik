<?php

namespace App\Http\Controllers;

use App\Models\User;

class MiscController extends Controller
{
    public function guidePage()
    {
        if (User::authenticated()) {
            return redirect('/home');
        }

        return view('misc/guide', [
            'page_title' => 'Petunjuk Penggunaan',
        ]);
    }

    public function developerPage()
    {
        if (User::authenticated()) {
            return redirect('/home');
        }

        return view('misc/developer', [
            'page_title' => 'Pengembang Aplikasi',
        ]);
    }
}
