<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'title',
        'description',
        'list_executors',
        'manager',
        'deadline',
        'priority',
        'task_group_id',
        'file',
        'status'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public $sortable =
        [
            'title',
            'list_executors',
            'deadline',
            'priority'
        ];

}
