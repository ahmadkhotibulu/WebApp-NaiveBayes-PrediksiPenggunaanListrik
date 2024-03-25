<?php

namespace App\Http\Controllers;

use App\Enums\TipeUser;
use App\Models\TrainingData;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $auth = User::authenticated();
        if ($auth['tipe_user'] === TipeUser::USER->value) {
            return view('user/home/index', [
                'page_title' => 'Beranda',
            ]);
        }
    }

    public function data($limit = 10, $offset = 0)
    {
        $auth = User::authenticated();
        if ($auth['tipe_user'] === TipeUser::USER->value) {
            if ($limit < 0) {
                $limit = 0;
            } elseif ($limit > 25) {
                $limit = 25;
            }
            if ($offset < 0) {
                $offset = 0;
            }
            $data = TrainingData::getTrainingData($limit, $offset);
            return view('user/data/index', [
                'page_title' => 'Data Training',
                'data' => $data,
            ]);
        }
    }

    public function predicts()
    {
        $auth = User::authenticated();
        if ($auth['tipe_user'] === TipeUser::USER->value) {
            return view('user/predicts/index', [
                'page_title' => 'Buat Prediksi',
                'default_value' => [
                    'jumlah_tanggungan' => 6,
                    'luas_rumah' => 20,
                    'pendapatan' => 1000000,
                    'daya_listrik' => 900,
                    'perlengkapan' => 7,
                ],
            ]);
        }
    }

    public function doPrediction(Request $req)
    {
        $auth = User::authenticated();
        if ($auth['tipe_user'] === TipeUser::USER->value) {
            $validated = $req->validate([
                'jumlah_tanggungan' => 'required|numeric',
                'luas_rumah' => 'required|numeric',
                'pendapatan' => 'required|numeric',
                'daya_listrik' => 'required|numeric',
                'perlengkapan' => 'required|numeric',
            ]);

            if (!$validated) {
                return redirect('/predicts');
            }

            $result = null;
            try {
                $result = (new TrainingData($validated))->predict();
                if (!$result) {
                    return redirect('/predicts')->with('alert', [
                        'icon' => 'error',
                        'title' => 'Gagal!',
                        'text' => 'Inputan ilegal terdeteksi',
                    ]);
                }
            } catch (\Throwable $th) {
                return redirect('/predicts')->with('alert', [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => $th->getMessage(),
                ]);
            }

            return view('user/predicts/index', [
                'page_title' => 'Buat Prediksi',
                'default_value' => TrainingData::convert_back_value($validated),
                'profile' => User::getProfile(),
                'result' => $result,
            ]);
        }
    }

    public function profile()
    {
        $profile = User::getProfile();
        return view('user/profile/index', [
            'page_title' => 'Profil Saya',
            'profile' => $profile,
        ]);
    }

    public function saveProfile(Request $req)
    {
        if (!User::saveProfile($req)) {
            return redirect('/profile');
        }

        return redirect('/profile')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Profil anda berhasil diperbarui',
        ]);
    }

    public function savePassword(Request $req)
    {
        if (!User::savePassword($req)) {
            return redirect('/profile');
        }

        return redirect('/profile')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Password berhasil disimpan',
        ]);
    }

    public function saveAvatar(Request $req)
    {
        if (!User::saveAvatar($req)) {
            return redirect('/profile');
        }

        return redirect('/profile')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Foto profil berhasil diperbarui',
        ]);
    }

    public function logout()
    {
        User::deauthenticate();
        return redirect('/login')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Anda telah logout',
        ]);
    }
}
