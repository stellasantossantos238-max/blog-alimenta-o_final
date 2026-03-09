<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['nome', 'especialidade', 'bio', 'avatar'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
