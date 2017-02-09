<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }
}
