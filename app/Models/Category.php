<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['name', 'description', 'teacher', 'number_video',
    'rate', 'number_registered', 'price', 'status', 'path'];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_category');
    }
}
