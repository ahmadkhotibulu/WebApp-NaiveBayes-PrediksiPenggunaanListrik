<?php

namespace App\Models;

use App\Enums\TipeUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id_user';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'foto_user',
        'nama_depan',
        'nama_belakang',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat',
        'tipe_user',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'tipe_user' => TipeUser::class,
    ];

    public static function authenticate($username, $password)
    {
        $user = DB::table('users')->select(['id_user', 'username', 'password', 'foto_user', 'nama_depan', 'nama_belakang', 'tipe_user'])
            ->where('username', '=', $username)->limit(1)->first();
        if (empty($user)) {
            throw new \Exception ('Username tidak ditemukan, register terlebih dahulu jika belum memiliki akun', 404);
        }
        if (!password_verify($password, $user->password)) {
            throw new \Exception ('Password salah', 401);
        }

        session()->put('loggedIn', [
            'id_user' => $user->id_user,
            'tipe_user' => $user->tipe_user,
            'foto_user' => (empty($user->foto_user) ? asset('assets/images/user.png') : asset('uploads/images/' . $user->foto_user)),
            'username' => $user->username,
            'nama_depan' => $user->nama_depan,
            'nama_belakang' => $user->nama_belakang,
        ]);
        return $user;
    }

    public static function authenticated()
    {
        $auth = session('loggedIn');
        if (!$auth) {
            return false;
        }

        return $auth;
    }

    public static function deauthenticate()
    {
        return session()->remove('loggedIn');
    }

    public static function getProfile()
    {
        $auth = static::authenticated();
        $user = DB::table("users")->select(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'alamat'])->where('id_user', '=', $auth['id_user'])->first();
        return $user;
    }
    public static function saveProfile($request)
    {
        $auth = static::authenticated();
        $validated = $request->validate([
            'nama_depan' => 'required|between:2,24',
            'nama_belakang' => 'between:1,64',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'max:128',
        ]);
        if (!$validated) {
            return false;
        }
        $user = User::find($auth['id_user']);
        $user->nama_depan = $validated['nama_depan'];
        $user->nama_belakang = $validated['nama_belakang'];
        $user->provinsi = $validated['provinsi'];
        $user->kabupaten = $validated['kabupaten'];
        $user->kecamatan = $validated['kecamatan'];
        $user->kelurahan = $validated['kelurahan'];
        $user->alamat = $validated['alamat'];
        $user->save();

        static::deauthenticate();
        $auth['nama_depan'] = $user->nama_depan;
        $auth['nama_belakang'] = $user->nama_belakang;
        session()->put('loggedIn', $auth);
        return true;
    }

    public static function savePassword($request)
    {
        $auth = static::authenticated();
        $validated = $request->validate([
            'password_lama' => 'required|between:6,24',
            'password' => 'required|confirmed|between:6,24',
        ]);
        if (!$validated) {
            return false;
        }
        $user = User::find($auth['id_user']);
        if (!password_verify($validated['password_lama'], $user->password)) {
            session()->flash('alert', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Password lama salah',
            ]);
            return false;
        }

        $user->password = password_hash($validated['password'], PASSWORD_ARGON2ID);
        $user->save();
        return true;
    }

    public static function saveAvatar($request)
    {
        $auth = static::authenticated();
        $validated = $request->validate([
            'foto_user' => 'required|image|max:1536',
        ]);
        if (!$validated) {
            return false;
        }

        $user = User::find($auth['id_user']);
        File::delete(Str::replaceFirst('/public', '/public_html', public_path('uploads/images/' . $user->foto_user)));
        File::delete(Str::replaceFirst('/public', '/public_html', public_path('uploads/images/' . str_replace('.', '-128.', $user->foto_user))));
        File::delete(Str::replaceFirst('/public', '/public_html', public_path('uploads/images/' . str_replace('.', '-32.', $user->foto_user))));

        $file = $request->file('foto_user');
        $filePath = $file->getRealPath();
        $extension = $file->extension();
        $filename = static::getRandomName(12);
        $imageResize = ImageManagerStatic::make($filePath);
        $imageResize->resize(512, 512, function ($const) {
            $const->aspectRatio();
        });
        $imageResize->save(Str::replaceFirst('/public', '/public_html', public_path('uploads/images/' . $filename . '.' . $extension)));
        $imageResize = ImageManagerStatic::make($filePath);
        $imageResize->resize(128, 128, function ($const) {
            $const->aspectRatio();
        });
        $imageResize->save(Str::replaceFirst('/public', '/public_html', public_path('uploads/images/' . $filename . '-128.' . $extension)));
        $imageResize = ImageManagerStatic::make($filePath);
        $imageResize->resize(32, 32, function ($const) {
            $const->aspectRatio();
        });
        $imageResize->save(Str::replaceFirst('/public', '/public_html', public_path('uploads/images/' . $filename . '-32.' . $extension)));
        $user->foto_user = $filename . '.' . $extension;
        $user->save();

        static::deauthenticate();
        $auth['foto_user'] = asset('uploads/images/' . $filename . '.' . $extension);
        session()->put('loggedIn', $auth);

        return true;
    }

    public static function getRandomName($initialLength)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        $time = strval(time());
        for ($i = 0; $i < $initialLength; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
            if (isset($time[$i])) {
                $randomString .= $time[$i];
            }
        }

        return $randomString;
    }

}
