<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'description'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function scopeSecure($query){
        return $query->where('user_id', \Auth::user()->id);
    }
}
