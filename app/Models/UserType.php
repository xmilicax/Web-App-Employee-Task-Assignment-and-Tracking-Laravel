<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type',
    ];

    public static function returnType($id)
    {
        $type = UserType::find($id);

        return $type->user_type;
    }

}
