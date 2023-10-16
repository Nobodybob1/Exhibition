<?php

namespace App\Models;

use App\Models\Exhibition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exhibition_id'
    ];

    public function art() {
        return $this->belongsTo(Exhibition::class, 'exhibition_id');
    }
}
