<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'name',
        'user_type_id',
        'phone',
        'birthday',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public static function returnName($id)
    {
        $user = User::find($id);

        if ($user) {
            return $user->name;
        }

        return "greška";
    }

    public static function returnNameList($ids)
    {
        $list = explode(',', $ids);
        $userNames = [];

        foreach ($list as $id) {
            $user = User::find(trim($id));
            if ($user) {
                $userNames[] = $user->name;
            } else {
                $userNames[] = "greška";
            }
        }
        return implode(', ', $userNames);
    }


    public static function returnStatus($status)
    {
        if ($status)
            return 'Verifikovan';

        return "Nije verifikovan";
    }

}
