<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rating;
use App\Models\UserFavorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'rating',
        'description'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function average_rating() {
        return $this->ratings->sum('rating') / $this->ratings->count();
    }

    public function favorited_by() {
        return $this->hasMany(UserFavorite::class);
    }

    public function getFacebookShareLink()
    {
        // Generate the URL to your image, assuming it's stored in the 'images' directory
        $imageUrl = asset('/images/' . $this->image);

        // URL encode the image URL
        $encodedImageUrl = rawurlencode($imageUrl);

        // Create the Facebook share link with the image URL
        $facebookShareLink = "https://www.facebook.com/sharer/sharer.php?u={$encodedImageUrl}";

        return $facebookShareLink;
    }

}
