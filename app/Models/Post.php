<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = [
        'title',
        'text',
        'tags_id',
        'likes',
        'watch',
        'created_at',
        'updated_at'
    ];

    public function tags() {
        return $this->hasOne(Tag::class, 'id', 'tags_id');
    }
}
