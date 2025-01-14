<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "is_completed",
        "date_limit",
    ];

    protected function casts()
    {
        return [
            "is_completed" => "boolean",
            "date_limit" => "date",
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
