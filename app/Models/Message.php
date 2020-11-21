<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['message'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $touches = ['room'];

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function canBeDeletedByUser(User $user)
    {
        return $user->is_admin || $this->user->id === $user->id;
    }

}
