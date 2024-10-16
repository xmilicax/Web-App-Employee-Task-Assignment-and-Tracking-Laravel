<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function returnGroupName($id)
    {
        $group = TaskGroup::find($id);

        return $group->name;
    }


}
