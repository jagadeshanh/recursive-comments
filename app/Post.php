<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['user_id', 'content'];

	protected $with = ['user'];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function getThreadedComments(){
		return $this->comments()->with('user')->get()->threaded();
	}

	public function addComment($attributes)
	{
		$comment = (new Comment())->forceFill($attributes);
		$comment->user_id = auth()->id();
		return $this->comments()->save($comment);
	}
}
