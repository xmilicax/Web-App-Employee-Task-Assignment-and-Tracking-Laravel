<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'content',
    ];

    public function show($id)
    {
        $task = Task::with('comments')->findOrFail($id);

        return view('task-detail', compact('task'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function returnTaskName($id)
    {
        $task = Task::find($id);

        return $task->title;
    }

    public static function returnUserName($id)
    {
        $user = User::find($id);

        return $user->name;
    }

}
