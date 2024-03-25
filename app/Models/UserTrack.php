<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrack extends Model
{
    use HasFactory;

    protected $table = 'users_tracks';

    protected $primaryKey = 'id_user_track';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'address_type',
        'address',
        'method',
        'prompt',
    ];
}
