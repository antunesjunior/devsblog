<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'uri',
        'views',
        'description',
        'cover',
        'content',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getByStatus(User $user, string $status)
    {
        return $user->posts()->where('status', $status)->orderBy('id', 'DESC')->get();
    }
}
